<?php

class Db
{
    // private const cleardb_url = parse_url("mysql://b5f3fd35c0ee8c:760ad60e@eu-cdbr-west-01.cleardb.com/heroku_5fa867a10f7faee?reconnect=true");
    // private const servername = "eu-cdbr-west-01.cleardb.com";
    // private const username = "b5f3fd35c0ee8c";
    // private const password = "760ad60e";
    // private const dbname = "heroku_5fa867a10f7faee";

    private const servername = "localhost";
    private const username = "tw";
    private const password = "tw";
    private const dbname = "unwe";
    private const unemploymentCreateStatement = "CREATE OR REPLACE TABLE unemployment_data (
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
    private const unemploymentInsertStatement = "INSERT INTO unemployment_data 
        VALUES (?,STR_TO_DATE(?, '%Y-%m-%d'),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";  // insert statement sql

    private const tokensCreateStatement = "CREATE OR REPLACE TABLE tokens (
        id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        token CHAR(32)
        )";

    private const tokensInsertStatement = "INSERT INTO tokens(token) VALUES(?)";

    private $conn;  // database connection
    private $unemploymentInsertStmt;  // prepared insert statement
    private $tokenInsertStmt;
    private $tokenLookupStmt;

    public function __construct()
    {
        $this->conn = new mysqli(self::servername, self::username, self::password, self::dbname);

        if ($this->conn->connect_error)
            throw new Exception("Can't connect to DB!");

        $this->unemploymentInsertStmt = $this->conn->prepare(self::unemploymentInsertStatement);
        $this->tokenInsertStmt = $this->conn->prepare(self::tokensInsertStatement);
        if ($this->tokenInsertStmt === FALSE) {
            $this->createTokensTable();
            $this->tokenInsertStmt = $this->conn->prepare(self::tokensInsertStatement);
        }

        $this->tokenLookupStmt = $this->conn->prepare("SELECT token FROM tokens WHERE token=?");
    }

    public function __destruct()
    {
        $this->conn->close();
        $this->unemploymentInsertStmt->close();
        $this->tokenInsertStmt->close();
        $this->tokenLookupStmt->close();
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function createDb()
    {
        if ($this->conn->query(self::unemploymentCreateStatement) === FALSE)
            throw new Exception("Error creating table: " . $this->conn->error);
    }

    public function insertRow($params)
    {
        if (count($params) != 29) {
            error_log("Invalid no. of params for insert row method");
            return;
        }

        array_unshift($params, 0);
        $this->unemploymentInsertStmt->bind_param('issiidddiiiiiiiiiiiiiiiiiiiiii', ...$params);
        $this->unemploymentInsertStmt->execute();
    }

    public function getMaxDate()
    {
        $result = $this->conn->query("SELECT MAX(luna) FROM unemployment_data");
        if ($result === FALSE || $result->num_rows != 1)
            throw new Exception("Couldn't get max date from db");

        return $result->fetch_row()[0];
    }

    public function select($data)
    {
        $sql = 'SELECT luna, judet, ' . implode(",", $data["columns"]) . ' FROM unemployment_data WHERE luna >= ? AND judet IN (?' . str_repeat(',?', count($data["counties"]) - 1) . ') ORDER BY luna ASC, judet ASC';

        $statement = $this->conn->prepare($sql);
        $statement->bind_param(str_repeat('s', count($data["counties"]) + 1), $data["start-date"], ...$data["counties"]);

        $statement->execute();
        $result = $statement->get_result();

        $ret = [];
        for ($i = 0; $i < $result->num_rows; $i++) {
            array_push($ret, $result->fetch_array(MYSQLI_ASSOC));
        }

        $statement->close();

        return $ret;
    }

    public function createTokensTable()
    {
        if ($this->conn->query(self::tokensCreateStatement) === FALSE)
            throw new Exception("Error creating table: " . $this->conn->error);
    }

    public function insertToken($token)
    {
        $this->tokenInsertStmt->bind_param('s', $token);
        $this->tokenInsertStmt->execute();
    }

    public function checkToken($token)
    {
        $this->tokenLookupStmt->bind_param('s', $token);
        $this->tokenLookupStmt->execute();
        $result = $this->tokenLookupStmt->get_result();

        return $result->num_rows >= 1;
    }
}
