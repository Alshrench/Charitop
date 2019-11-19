<?php

  class Dbh {

    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function connect() {
      $this->servername = "localhost";
      $this->username = "root";
      $this->password = "";
      $this->dbname = "charitop";

      $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
      return $conn;
    }

  }

?>
