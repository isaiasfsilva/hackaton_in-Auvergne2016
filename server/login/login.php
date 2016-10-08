<?php
require_once('../utils/class.phpmailer.php');
require_once('../utils/utils.php');
require_once('../config/db.php');

if(isset($_REQUEST['user']) && validarEMAIL($_REQUEST['user']) && isset($_REQUEST['pass']) && $_REQUEST['pass']!=''  ){

      $res= $db->prepare("SELECT id from employeurs where email=? and pass=? limit 1");
      $res->bind_param('ss',$_REQUEST['user'],md5($_REQUEST['pass']));
      $res->execute();
      $res->store_result();
      $res->bind_result($res_id);

      if($res->num_rows()==1){
              $res->fetch();

          echo md5($res_id);
      }else{

          $res->close();
          $res= $db->prepare("SELECT id from enterprise where email=? and pass=? limit 1");
          $res->bind_param('ss',$_REQUEST['user'],md5($_REQUEST['pass']));
          $res->execute();
          $res->store_result();
          $res->bind_result($res_id);
          if($res->num_rows()==1){
              $res->fetch();

          echo md5($res_id);
          }else{
            echo 'error';
          }
      }
      $res->close();



}else{
    echo 'error';
}


?>