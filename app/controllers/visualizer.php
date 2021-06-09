<?php

class Visualizer extends Controller
{

    const JUDETE = array("ALBA", "ARAD", "ARGEŞ", "BACĂU", "BIHOR", "BISTRIŢA NĂSĂUD", "BOTOŞANI", "BRĂILA", "BRAŞOV", "BUZĂU", "CĂLĂRAȘI", "CARAŞ-SEVERIN", "CLUJ", "CONSTANŢA", "COVASNA", "DÂMBOVIŢA", "DOLJ", "GALAŢI", "GIURGIU", "GORJ", "HARGHITA", "HUNEDOARA", "IALOMIŢA", "IAŞI", "ILFOV", "MARAMUREŞ", "MEHEDINŢI", "MUN. BUCUREȘTI", "MUREŞ", "NEAMŢ", "OLT", "PRAHOVA", "SĂLAJ", "SATU MARE", "SIBIU", "SUCEAVA", "TELEORMAN", "TIMIŞ", "TULCEA", "VÂLCEA", "VASLUI", "VRANCEA");

    public function index()
    {
        $this->view('visualizer/index', self::JUDETE);
    }

    public function generated()
    {
        $this->view('visualizer/generated');


        // echo var_dump($_GET);
    }
}
