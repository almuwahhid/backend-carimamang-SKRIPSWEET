<?php
/**
 * Edit on 14/06/2017
 */
class AuthPedagang
{
  private $con;
  function __construct($connection)
  {
    $this->con = $connection;
  }

  public function isLogin($username){
    $stmt = $this->con->prepare("SELECT username_pedagang FROM pedagang WHERE username_pedagang = ?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt->store_result();
    $num_rows = $stmt->num_rows;
    $stmt->close();
    return $num_rows > 0;
  }
}

?>
