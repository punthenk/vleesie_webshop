<?php
class dbconnection extends PDO
{
  private $host = "db";
  private $dbname = "webshop";
  private $user = "root";
  private $pass = "root";

  public function __construct()
  {
    try {
      parent::__construct("mysql:host=".$this->host.";dbname=".$this->dbname.";charset=utf8", $this->user, $this->pass);
      $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $error) {
      echo $error;
    }
  }
}
