<?php
header('Access-Control-Allow-Origin: *');
header('content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET, POST, PUT');

$result=[];

require_once('../../config/db.php');
if(isset($_REQUEST['id']) && $_REQUEST['id']!='' ){

      $res= $db->prepare("SELECT nome_familia, name, email, description, address from employeurs where MD5(id)=? limit 1");
      $res->bind_param('s',$_REQUEST['id']);
      $res->execute();
      $r = $res->get_result();
      $num_r=$res->num_rows();


          $res->bind_result($res_nomefamilia, $res_name,$res_email,$res_description, $res_address);

              while ($row = $r->fetch_assoc()) {
                   $result[]=$row;
              }

      $res->close();

}else{
}
echo json_encode($result);


?>

