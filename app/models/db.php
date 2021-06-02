<?php

class Db
{
    private const servername = "localhost";
    private const username = "tw";
    private const password = "tw";
    private const dbname = "unwe";
    private const createStatement = "CREATE OR REPLACE TABLE unemployment_data (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        luna DATE,
        judet VARCHAR(25),
        nr_total INT(10),
        nr_femei INT(10),
        nr_barbati INT(10),
        rata_total DECIMAL(3,2),
        rata_femei DECIMAL(3,2),
        rata_barbati DECIMAL(3,2),
        nr_indemnizati INT(10),
        nr_neindemnizati INT(10),
        nr_urban_total INT(10),
        nr_femei_urban INT(10),
        nr_barbati_urban INT(10),
        nr_rural_total INT(10),
        nr_femei_rural INT(10),
        nr_barbati_rural INT(10),
        nr_fara_studii INT(10),
        nr_primar INT(10),
        nr_gimnazial INT(10),
        nr_liceal INT(10),
        nr_postliceal INT(10),
        nr_profesional INT(10),
        nr_universitar INT(10),
        nr_sub_25 INT(10),
        nr_25_29 INT(10),
        nr_30_39 INT(10),
        nr_40_49 INT(10),
        nr_50_55 INT(10),
        nr_peste_55 INT(10)
        )";
    private const insertStatement = "INSERT INTO unemployment_data 
        VALUES (?,STR_TO_DATE(?, '%Y-%m-%d'),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";  // insert statement sql
    private $conn;  // database connection
    private $insertStmt;  // prepared insert statement

    public function __construct()
    {
        $this->conn = new mysqli(self::servername, self::username, self::password, self::dbname);

        if ($this->conn->connect_error)
            throw new Exception("Can't connect to DB!");

        $this->insertStmt = $this->conn->prepare(self::insertStatement);
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function createDb()
    {
        if ($this->conn->query(self::createStatement) === FALSE)
            throw new Exception("Error creating table: " . $this->conn->error);
    }

    public function insertRow($params)
    {
        if (count($params) != 29) {
            error_log("Invalid no. of params for insert row method");
            return;
        }

        array_unshift($params, 0);
        $this->insertStmt->bind_param('isiiidddiiiiiiiiiiiiiiiiiiiiii', ...$params);
        $this->insertStmt->execute();
    }
}
