<?php

class CreateDb {
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    //Get Heroku ClearDB connection information
    public $cleardb_url;
    public $cleardb_server;
    public $cleardb_username;
    public $cleardb_password;
    public $cleardb_db;
    public $active_group;
    public $query_builder;
    // Connect to DB
    public function __construct($dbname = "NewDb", $tablename = "AccountDb", $servername = "localhost", $username = "root", $password ="")
    {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->password = $password;

        $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $cleardb_server = $cleardb_url["host"];
        $cleardb_username = $cleardb_url["user"];
        $cleardb_password = $cleardb_url["pass"];
        $cleardb_db = substr($cleardb_url["path"],1);
        $active_group = 'default';
        $query_builder = TRUE;

        // create connection
        // $this->con = mysqli_connect($servername, $username, $password); // local connection
        $this->con = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

        // check connection
        if (!$this->con) {
            die("Connection failed:" . mysqli_connect_error());
        }

        // query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // execute query
        if (mysqli_query($this->con, $sql)) {
            $this->con = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
            // sql to create new table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename
                    (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    product_name VARCHAR (25) NOT NULL,
                    product_price FLOAT,
                    product_image VARCHAR (100)
                    );";

            if (!mysqli_query($this->con, $sql)) {
                echo "Error creating table :" . mysqli_error($this->con);
            }
            
        } else {
            return false;
        }

    }

    // get product from database
    public function getData() {
        $sql = "SELECT * FROM $this->tablename";
        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    // retrieve account info from database
    public function retrieve($sql) {
        $result = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}