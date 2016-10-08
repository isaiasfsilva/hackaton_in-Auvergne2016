<?php
require_once('../utils/class.phpmailer.php');
require_once('../utils/utils.php');
require_once('../config/db.php');
if(isset($_REQUEST['user']) && validarEMAIL($_REQUEST['user']) ){
    $newpass = gerarSenha(5);


      $res= $db->prepare("SELECT name from employeurs where email=? limit 1");
      $res->bind_param('s',$_REQUEST['user']);
      $res->execute();
      $res->store_result();
      $res->bind_result($res_name);
      $res->fetch();
      $res->close();



      $email="Bonjour ".$res_name.", <br> son nouveau mot de passe est: <b>".$newpass."</b>. <br><br>Ce mot de passe est provisoire.<br><br><br>Cordialement, SoGreen.";
      if(smtpmailer($_REQUEST['user'],$res_name, 'Redefinition de mot de passe - SoGreen',$email)){
        echo 'ok';
        $res= $db->prepare("UPDATE employeurs SET pass=? where email=? limit 1");
          $res->bind_param('ss',md5($newpass),$_REQUEST['user']);
          $res->execute();
          $res->store_result();
          $res->bind_result($res_name);
          $res->fetch();
          $res->close();


      }else{
        echo 'error';
      }


}else{
    echo 'error';
}


?>