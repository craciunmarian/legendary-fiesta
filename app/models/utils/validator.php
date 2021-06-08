<?php

class Validator
{
    static function validateJsonData($data)
    {
        if (!isset($data))
            return "JSON improperly formatted or has reached recursion limit";

        if (!isset($data["start-date"]))
            return "Start date must be specified!";



        return TRUE;
    }
}
