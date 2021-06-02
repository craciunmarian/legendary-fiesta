<?php

class Importer
{
    private const CSV_LOCATION = "../../public/temp/data.csv"; // general idea succes ada
    private $db;

    public function __construct($datasource)
    {
        $this->db = $datasource;
    }

    public function importData()
    {
        // web crawling etc.
        $this->db->insertRow(array(
            '2012-08-06', '2', 1, 4, 5, 1.12, 1.13, 1.14,
            19, 29, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
            36, 37, 38, 39
        ));
    }
}
