<?php
  class KonsumenAntreanHapus{
    private $con;
    function __construct()
    {
        require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
        //require_once 'carimamang.tutorial-sourcecode.com/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

      public function hapusRequest($id_request){
      $stmt = $this->con->prepare("DELETE FROM request WHERE id_request = ?");
      $stmt->bind_param("i", $id_request);
      if($stmt->execute()){
        $stmt->close();
         return 1;
      }else{
        $stmt->close();
        return 0; //gagal
      }
    }
  }
?>
