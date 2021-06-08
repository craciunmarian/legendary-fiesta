<?php

class Importer
{
    private const CSV_LOCATION = "../../public/temp/data.csv"; // general idea succes ada
    private $db;
    private const start = 'https://data.gov.ro/dataset?q=somaj&sort=metadata_modified+desc&res_format=.csv';
    private const gov = 'https://data.gov.ro';
    private $judete = [];

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
            $this->follow_CSV_links(self::gov . $append);
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

        foreach ($nodeList as $node) {
            $file =  fopen($node->getAttribute("href"), "r");
            $line = fgetcsv($file, 0, ",",);
            $next = fgetcsv($file, 0, ",",);
            while ($next !== false) {
                if ($next[0] == "")
                    break;

                $name = $next[0];
                $name = $this->format_city_names($name);

                array_push($this->judete, $name);


                //var_dump($next);
                //echo ($next[0]);
                //echo "<br>";

                $next = fgetcsv($file, 0, ",",);
            }
        }
    }

    public function format_city_names($name)
    {

        $diacritice = array("ă", "â", "î", "ș", "ț", "?");
        $replace_diacritice = array("a", "a", "i", "s", "t", "s");

        $name = strtolower($name);
        $name = str_replace($diacritice, $replace_diacritice, $name);
        $name = str_replace(" ", "", $name);

        if ($name == "mun.buc." || $name == "municipiulbucuresti")
            $name = "bucuresti";

        if ($name == "satum." || $name == "satumare")
            $name = "satu-mare";

        if ($name == "totalgeneral" || $name == "totaltara")
            $name = "total";

        if ($name == "bistritanasaud" || $name == "bistrita")
            $name = "bistrita-nasaud";

        if ($name == "caras")
            $name = "caras-severin";

        return $name;
    }



    // public function crawl()
    // {
    // }

    public function importData()
    {
        $this->follow_main_links(self::start);
        $this->judete = array_unique($this->judete);
        var_dump($this->judete);
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
