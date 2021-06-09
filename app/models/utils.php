<?php

class Utils
{

    static function validateRequestData($data)
    {
        if (!isset($data["start-date"]))
            return "Start date must be specified!";

        if (!isset($data["counties"]))
            return "At least one county must be specified!";

        if (!isset($data["categories"]) || count($data["categories"]) == 0)
            $data["categories"] = ["total"];
        else if (!in_array("total", $data["categories"]))
            array_push($data["categories"], "total");

        foreach ($data["counties"] as $county)
            $county = self::format_city_names($county);

        $data["columns"] = [];
        foreach ($data["categories"] as $category) {
            switch ($category) {
                case "total":
                    array_push($data["columns"], "nr_total");
                    break;
                case "sex":
                    array_push($data["columns"], "nr_femei", "nr_barbati");
                    break;
                case "rate":
                    array_push($data["columns"], "rata_total", "rata_barbati", "rata_femei");
                    break;
                case "compensation":
                    array_push($data["columns"], "nr_indemnizati", "nr_neindemnizati");
                    break;
                case "environment":
                    array_push($data["columns"], "nr_urban_total", "nr_rural_total");
                    break;
                case "education":
                    array_push($data["columns"], "nr_fara_studii", "nr_primar", "nr_gimnazial", "nr_liceal", "nr_postliceal", "nr_profesional", "nr_universitar");
                    break;
                case "age":
                    array_push($data["columns"], "nr_sub_25", "nr_25_29", "nr_30_39", "nr_40_49", "nr_50_55", "nr_peste_55");
                    break;
            }
        }

        return $data;
    }

    static function format_city_names($name)
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

    // found this on https://stackoverflow.com/questions/4356289/php-random-string-generator/31107425#31107425
    static function random_str(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces[] = $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }
}
