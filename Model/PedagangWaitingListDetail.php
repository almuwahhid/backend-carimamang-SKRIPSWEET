<?php
/**
 * 14/06/2017
 */
class PedagangWaitingListDetail
{
  private $con;
  private $auth;

  function __construct()
  {
    require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
    require_once realpath(dirname(__FILE__)) . '/Auth/AuthPedagang.php';
    $db = new DbConnect();
    $this->con = $db->connect();
    $this->auth = new AuthPedagang($this->con);
  }

  public function updateRequest($id_req, $status, $message){
    $stmt = $this->con->prepare("UPDATE request SET
      status_req = ?
      WHERE id_request = ?");
      $stmt->bind_param("ii",$status, $id_req);
      if($stmt->execute()){
        $stmt->close();
        $this->respon["status"] = $this->addReply($id_req, $message);
      }else{
        $this->respon["status"] = 0;
      }
    return $this->respon;
  }

  public function addReply($id_req, $message){
    date_default_timezone_set('Asia/Jakarta');
    $t=time();
    $tanggal_now = date("Y-m-d", $t);
    $waktu_now = date("H:m", $t);

    if($stmt = $this->con->prepare("INSERT INTO reply (id_request, pesan_reply,
                                                       tanggal_reply, waktu_reply
                                                     ) VALUES (?,?,?,?)")){
       $stmt->bind_param("isss", $id_req, $message, $tanggal_now, $waktu_now);
       if($stmt->execute()){
         $stmt->close();
          return 1; //sukses
       }else{
         // printf("Errormessage: %s\n", $this->con->error);
         return 3; //gagal
       }
    }
  }
}
?>
