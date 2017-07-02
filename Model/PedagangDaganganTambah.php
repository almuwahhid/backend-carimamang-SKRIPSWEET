<?php
  class PedagangDaganganTambah{
    private $con;
    private $auth;
    public $respon = array();

    function __construct()
    {
      require_once realpath(dirname(__FILE__). '/..') . '/DbConnect.php';
      require_once realpath(dirname(__FILE__)) . '/Auth/AuthPedagang.php';
      $db = new DbConnect();
      $this->con = $db->connect();
      $this->auth = new AuthPedagang($this->con);
    }

    public function tambahDagangan($username, $nama_dagangan, $harga_dagangan, $keterangan){
      if($this->auth->isLogin($username)){
        if($stmt = $this->con->prepare("INSERT INTO dagangan (username_pedagang, nama_dagangan,
                                      harga_dagangan, keterangan)
                                      VALUES (?,?,?,?)")){
            $stmt->bind_param("ssis",$username, $nama_dagangan, $harga_dagangan, $keterangan);
            if($stmt->execute()){
              $this->respon["status"] = 1;
            }else{
              $this->respon["status"] = 0;
            }
        }

      }else{
        $this->respon["status"] = 2;
      }
      return $this->respon;
    }

  }
?>
