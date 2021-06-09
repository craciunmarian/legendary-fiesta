<?php

require_once('../app/models/utils.php');

class Api extends Controller
{
    public function index()
    {
        http_response_code(404);
        header("Content-type: text/plain");
        echo "invalid api call";
    }

    public function refreshdb()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        try {
            $db = $this->model('Db');

            $headers = getallheaders();

            if (!isset($headers["Authorization"]) || (isset($headers["Authorization"]) && !$db->checkToken($headers["Authorization"]))) {
                http_response_code(401);
                header("Content-type: text/plain");
                echo "You are not allowed to do that! Get a token from /signup first";
                return;
            }

            // re-create table
            $db->createDb();

            // import data from website
            $importer = $this->model('Importer', [$db]);
            $importer->importData();

            // success
            http_response_code(200);
            header("Content-type: text/plain");
            echo "DB refreshed successfully";
        } catch (Exception $ex) {
            http_response_code(500);
            header("Content-type: text/plain");
            error_log($ex->getMessage());
            echo "DB error";
        }
    }

    public function query()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->index();
            return;
        }

        try {
            $db = $this->model('Db');

            if (isset($_GET["from-json"]) && $_GET["from-json"] == "true") {
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);
                if (!isset($data))
                    $data = "JSON improperly formatted or has reached recursion limit";
                else
                    $data = Utils::validateRequestData($data);
            } else {
                $data = Utils::validateRequestData(array_slice($_GET, 1));
            }

            if (is_string($data)) {
                http_response_code(400);
                header("Content-type: text/plain");
                // error_log($validatorResponse);
                echo $data;
                return;
            }

            $maxDbDate = $db->getMaxDate();

            if (strtotime($data["start-date"]) > strtotime($maxDbDate)) {
                http_response_code(400);
                header("Content-type: text/plain");
                echo "start date can't be later than the most recent date from DB (" . $maxDbDate . ")";
                return;
            }

            $result = $db->select($data);

            http_response_code(200);
            header("Content-type: application/json");
            echo json_encode($result);
        } catch (Exception $ex) {
            http_response_code(500);
            header("Content-type: text/plain");
            error_log($ex->getMessage());
            echo "DB error";
        }
    }

    public function resetTokens()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        $headers = getallheaders();

        if (!isset($headers["Authorization"]) || (isset($headers["Authorization"]) && $headers["Authorization"] !== "super-secret-token-woo")) {
            http_response_code(401);
            header("Content-type: text/plain");
            echo "You are not allowed to do that!";
            return;
        }

        try {
            $db = $this->model('Db');

            $db->createTokensTable();

            // success
            http_response_code(200);
            header("Content-type: text/plain");
            echo "Reset successful";
        } catch (Exception $ex) {
            http_response_code(500);
            header("Content-type: text/plain");
            error_log($ex->getMessage());
            echo "DB error";
        }
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->index();
            return;
        }

        http_response_code(200);
        header("Content-type: text/plain");
        $token = Utils::random_str(32);

        try {
            $db = $this->model('Db');

            $db->insertToken($token);

            // success
            http_response_code(200);
            header("Content-type: text/plain");
            echo $token;
        } catch (Exception $ex) {
            http_response_code(500);
            header("Content-type: text/plain");
            error_log($ex->getMessage());
            echo "DB error";
        }
    }
}
