<?php
class Database
{
  private static $host = "db";
  private static $dbname = "webshop";
  private static $user = "root";
  private static $pass = "root";

  private static $dbConnection = null;
  private static $dbStatement = null;

  private static function connect(): bool
  {
    if(!is_null(self::$dbConnection)) {
      return true;
    }

    $pdo = null;
    
    try {
      $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname.";charset=utf8", self::$user, self::$pass);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $error) {
      echo $error;
    }

    self::$dbConnection = $pdo;
    return true;
  }


  public static function query(string $query, array $params = []): bool
  {
    if(!self::connect())
    {
      echo "Hallo allemaal ik moet helaas mededelen dat de dbconn niet goed is gegaan";
      return false;
    }

    try {
      self::$dbStatement = self::$dbConnection->prepare($query);
      self::$dbStatement->execute($params);
    } catch (PDOException $e) {
      return false;
    }

    return true;
  }

  public static function get($return_type = PDO::FETCH_OBJ): bool|Object|array
  {
    if (!self::connect())
      return false;

    return self::$dbStatement->fetch($return_type);
  }


  public static function getAll($return_type = PDO::FETCH_OBJ): bool|array
  {
    if (!self::connect())
       return false;

    return self::$dbStatement->fetchAll($return_type);
  }
}
