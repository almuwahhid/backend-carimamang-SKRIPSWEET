<?php
  class KonsumenModel{
    private $con;
    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

    function registerPedagang($username, $password, $name, $caption, $idkategori){

    }
  }
?>
