<?php

require_once('../app/models/utils.php');

class Importer
{
    private const CSV_LOCATION = "../../public/temp/data.csv"; // general idea succes ada
    private $db;
    private const start = 'https://data.gov.ro/dataset?q=somaj&sort=metadata_modified+desc&res_format=.csv';
    private const gov = 'https://data.gov.ro';
    private $judete = [];
    private $addToDB = array();

    public function __construct($datasource)
    {
        $this->db = $datasource;
    }

    public function follow_main_links($url)
    {
        $page = file_get_contents($url);
        @$doc = new DOMDocument();
        @$doc->loadHTML($page);

        $xpath = new DomXPath($doc);

        $nodeList = $xpath->query("//h3[@class='dataset-heading']/a");

        $i = 0;

        foreach ($nodeList as $node) {
            $append = $node->getAttribute("href");
            $this->format_date($append);
            $this->follow_CSV_links(self::gov . $append);

            var_dump($this->addToDB);
            $this->addToDB = array();
            die();
        }
    }

    public function follow_CSV_links($url)
    {
        $page = file_get_contents($url);
        @$doc = new DOMDocument();
        @$doc->loadHTML($page);

        $xpath = new DomXPath($doc);

        $nodeList = $xpath->query("//li[@class='resource-item']/a");

        foreach ($nodeList as $node) {
            $append = $node->getAttribute("href");
            $this->download_CSV(self::gov . $append);
        }
    }

    public function download_CSV($url)
    {
        $page = file_get_contents($url);
        @$doc = new DOMDocument();
        @$doc->loadHTML($page);


        $xpath = new DomXPath($doc);

        $nodeList = $xpath->query("//div[@class='archiver link-cached']/a");

        $i = 0;

        foreach ($nodeList as $node) {
            $file =  fopen($node->getAttribute("href"), "r");
            $line = fgetcsv($file, 0, ",",);
            $next = fgetcsv($file, 0, ",",);
            while ($next !== false) {
                if ($next[0] == "")
                    break;

                $name = $next[0];
                $name = Utils::format_city_names($name);

                array_push($this->judete, $name);

                $this->addToDB[$i] = array_merge($this->addToDB[$i], array_slice($next, 1));
                $i++;

                //var_dump($next);
                //echo ($next[0]);
                //echo "<br>";

                $next = fgetcsv($file, 0, ",",);
            }
        }
    }



    public function format_date($whole)
    {
        $luni = array("ianuarie", "februarie", "martie", "aprilie", "mai", "iunie", "iulie", "august", "septembrie", "octombrie", "noiembrie", "decembrie");
        $replace_luni = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");

        $splitLink = explode("-", $whole);
        $month = $splitLink[count($splitLink) - 2];
        $year = $splitLink[count($splitLink) - 1];

        $month = str_replace($luni, $replace_luni, $month);
        $date = $year . '-' . $month . '-' . '01';

        if ($date == 'mai2020-inregistrat-01')
            $date = '2020-05-01';
        if ($date == '2019-sepembrie-01')
            $date = '2019-09-01';

        for ($i = 0; $i < 43; $i++)
            $this->addToDB[$i][0] = $date;
    }



    // public function crawl()
    // {
    // }

    public function importData()
    {
        $this->follow_main_links(self::start);
        $this->judete = array_unique($this->judete);
        //var_dump($this->judete);
        // web crawling etc.
        // $this->db->insertRow(array(
        //     '2012-08-06', 'judet1', 1, 4, 5, 1.12, 1.13, 1.14,
        //     19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
        //     36, 37, 38, 39
        // ));

        // $this->db->insertRow(array(
        //     '2012-07-06', 'judet2', 1, 4, 5, 1.12, 1.13, 1.14,
        //     19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
        //     36, 37, 38, 39
        // ));

        // $this->db->insertRow(array(
        //     '2012-06-06', 'judet3', 1, 4, 5, 1.12, 1.13, 1.14,
        //     19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
        //     36, 37, 38, 39
        // ));
    }
}
