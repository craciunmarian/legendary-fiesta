<?php

class Validator
{

    static function validateData($data)
    {
        if (!isset($data["start-date"]))
            return "Start date must be specified!";

        if (!isset($data["categories"]) || count($data["categories"]) == 0)
            $data["categories"] = ["total"];
        else if (!in_array("total", $data["categories"]))
            array_push($data["categories"], "total");


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
}
