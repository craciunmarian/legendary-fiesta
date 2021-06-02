<?php

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
}
