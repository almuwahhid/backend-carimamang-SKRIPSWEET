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
        return $this->addReply($id_req, $message);
      }else{
        return 0;
      }
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

  function ambilTokenByUsername($username){
    $stmt = $this->con->prepare("SELECT token_konsumen FROM konsumen WHERE username_konsumen = ?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return array($result['token_konsumen']);
  }

  function ambilNamaPedagang($username_pedagang){
    $stmt = $this->con->prepare("SELECT nama_pedagang FROM pedagang WHERE username_pedagang = ?");
    $stmt->bind_param("s",$username_pedagang);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['nama_pedagang'];
  }
}
?>
