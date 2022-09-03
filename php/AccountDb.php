<?php

class AccountDb {
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    public function __construct($dbname = "NewDb", $tablename = "AccountDb", $servername = "localhost", $username = "root", $password ="")
    {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->password = $password;

        // create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // check connection
        if (!$this->con) {
            die("Connection failed:" . mysqli_connect_error());
        }

        // query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // execute query
        if (mysqli_query($this->con, $sql)) {
            $this->con = mysqli_connect($servername, $username, $password, $dbname);
            // sql to create new table
            $sql = "CREATE TABLE IF NOT EXISTS $tablename
                    (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR (25) NOT NULL,
                    user_password VARCHAR (100),
                    email VARCHAR(50),
                    logged_in TINYINT(1)
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

    // insert new account data into database
    public function insert($sql) {
        if (mysqli_query($this->con, $sql)) {
            echo "<script>alert('Successfully registered!')</script>";
            echo "<script>window.location = 'account.php'</script>";
        } else {
            echo "<script>alert('Error registering!')</script>";
            echo "<script>window.location = 'account.php'</script>";            
        }
    }

    public function validate() {

    }
}