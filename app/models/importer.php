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
            '2012-08-06', 'judet1', 1, 4, 5, 1.12, 1.13, 1.14,
            19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
            36, 37, 38, 39
        ));

        $this->db->insertRow(array(
            '2012-07-06', 'judet2', 1, 4, 5, 1.12, 1.13, 1.14,
            19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
            36, 37, 38, 39
        ));

        $this->db->insertRow(array(
            '2012-06-06', 'judet3', 1, 4, 5, 1.12, 1.13, 1.14,
            19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
            36, 37, 38, 39
        ));
    }
}
