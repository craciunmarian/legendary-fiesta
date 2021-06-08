<?php

require_once('../app/models/utils/validator.php');

class Api extends Controller
{
    public function refreshdb()
    {
        try {
            // re-create table
            $db = $this->model('Db');
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
        try {
            $db = $this->model('Db');

            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            $data = Validator::validateJsonData($data);
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
}
