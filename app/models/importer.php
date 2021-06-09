<?php

require_once('../app/models/utils.php');

class Importer
{
    private const judete_filepath = "./assets/common/judete.txt";
    private $db;
    private const start = 'https://data.gov.ro/dataset?q=somaj&sort=metadata_modified+desc&res_format=.csv';
    private const gov = 'https://data.gov.ro';
    private $judete = [];
    private $addToDB = array();

    public function __construct($datasource)
    {
        $this->db = $datasource;
    }
    private function init_array($date, $counties)
    {
        for ($i = 0; $i < 43; $i++) {
            $this->addToDB[$i][0] = $date;
            $this->addToDB[$i][1] = $counties[$i];
        }
    }
    private function follow_pages($url)
    {
        $page = file_get_contents($url);
        @$doc = new DOMDocument();
        @$doc->loadHTML($page);

        $xpath = new DomXPath($doc);

        $nodeList = $xpath->query("//ul[@class='pagination']/a");
    }

    private function follow_main_links($url)
    {
        $page = file_get_contents($url);
        @$doc = new DOMDocument();
        @$doc->loadHTML($page);

        $xpath = new DomXPath($doc);

        $nodeList = $xpath->query("//h3[@class='dataset-heading']/a");

        foreach ($nodeList as $node) {
            $append = $node->getAttribute("href");
            $date = $this->format_date($append);

            $this->init_array($date, $this->judete);
            $this->follow_CSV_links(self::gov . $append);


            $this->addToDB = array();
        }
    }

    private function follow_CSV_links($url)
    {
        error_log("test");
        $page = file_get_contents($url);
        @$doc = new DOMDocument();
        @$doc->loadHTML($page);

        $xpath = new DomXPath($doc);

        $nodeList = $xpath->query("//li[@class='resource-item']/a");

        $count = 0;
        foreach ($nodeList as $node) {
            $append = $node->getAttribute("href");
            $this->download_CSV(self::gov . $append, $count);
            $count++;
        }

        $this->judete = array_unique($this->judete);
        for ($i = 0; $i < 43; $i++) {
            //array_splice($this->addToDB[$i], 1, 0, $this->judete[$i]);
            $this->addToDB[$i] = $this->format_DB_import($this->addToDB[$i]);
            $this->db->insertRow($this->addToDB[$i]);


            //var_dump($this->addToDB[$i]);

        }
    }

    private function download_CSV($url, $count)
    {
        $page = file_get_contents($url);
        @$doc = new DOMDocument();
        @$doc->loadHTML($page);


        $xpath = new DomXPath($doc);

        $nodeList = $xpath->query("//a[@class='resource-url-analytics']");


        foreach ($nodeList as $node) {
            $file =  fopen($node->getAttribute("href"), "r");
            $line = fgetcsv($file, 0, ",",);
            $next = fgetcsv($file, 0, ",",);
            while ($next !== false) {
                if ($next[0] == "")
                    break;

                $name = $next[0];
                $name = Utils::format_city_names($name);

                if (count($this->judete) != 43)
                    array_push($this->judete, $name);

                for ($i = 0; $i < 43; $i++) {
                    if ($this->addToDB[$i][1] == $name) {
                        if ($count == 0)
                            $this->addToDB[$i] = array_merge($this->addToDB[$i], array_slice($next, 1));
                        else if ($count == 1)
                            $this->addToDB[$i] = array_merge($this->addToDB[$i], array_slice($next, 4));
                        else if ($count == 2 || $count == 3)
                            $this->addToDB[$i] = array_merge($this->addToDB[$i], array_slice($next, 2));
                        break;
                    }
                }

                $next = fgetcsv($file, 0, ",",);
            }
        }
    }

    private function format_DB_import($DBimport)
    {

        $characters = [" ", ","];
        for ($j = 2; $j < count($DBimport); $j++) {

            $DBimport = str_replace($characters, "", $DBimport);
            if ($DBimport[$j] == "") {
                unset($DBimport[$j]);
                continue;
            }

            if (strpos($DBimport[$j], ".") == false)

                $DBimport[$j] = (int)$DBimport[$j];
            else

                $DBimport[$j] = (float)$DBimport[$j];
        }

        $DBimport = array_values($DBimport);


        return $DBimport;
    }



    private function format_date($whole)
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

        return $date;
    }

    private function import_counties()
    {
        if (count($this->judete) == 0) {
            $lista_judete = fopen(self::judete_filepath, 'r');
            while ($line = fgets($lista_judete)) {
                $line = str_replace("\n", "", $line);
                array_push($this->judete, $line);
            }
            fclose($lista_judete);
        }
    }

    private function export_counties()
    {
        if (0 == filesize(self::judete_filepath)) {
            //var_dump($this->judete);
            file_put_contents(self::judete_filepath, implode("\n", $this->judete));
        }
    }

    public function importData()
    {
        if (filesize(self::judete_filepath)) {
            $this->import_counties();
            $check = true;
        } else
            $check = false;

        $this->follow_main_links(self::start);
        if (!$check)
            $this->export_counties();

        //var_dump($this->judete);




        //var_dump($this->judete);

        // web crawling etc.
        // $this->db->insertRow(array(
        //     '2012-08-06', 'iasi', 1, 4, 5, 1.12, 1.13, 1.14,
        //     19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
        //     36, 37, 38, 39
        // ));

        // $this->db->insertRow(array(
        //     '2012-07-06', 'botosani', 1, 4, 5, 1.12, 1.13, 1.14,
        //     19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
        //     36, 37, 38, 39
        // ));

        // $this->db->insertRow(array(
        //     '2012-06-06', 'iasi', 1, 4, 5, 1.12, 1.13, 1.14,
        //     19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35,
        //     36, 37, 38, 39
        // ));
    }
}
