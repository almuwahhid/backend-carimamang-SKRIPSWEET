<?php
  class KonsumenAntreanDetail{
    private $con;
    function __construct()
    {
        require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
        //require_once 'carimamang.tutorial-sourcecode.com/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }

    public function ambilData($id_request){
      $stmt = $this->con->prepare("SELECT pesan_reply FROM reply
        JOIN request ON request.id_request = reply.id_request
        WHERE request.id_request = ?");
        $stmt->bind_param("i",$id_request);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows>0){
          while($row = $result->fetch_assoc()){
            $this->respon["pesan_reply"] = $row["pesan_reply"];
          }
          $this->respon["status"] = 1;
        }else{
          $this->respon["status"] = 2;
        }
        $stmt->close();
        return $this->respon;
    }
  }
?>
