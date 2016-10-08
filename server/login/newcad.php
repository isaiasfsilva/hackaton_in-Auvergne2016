<?php

//           $.get( urlserver+"/server/login/cad.php?name="+name+"&pass="+pass+"&siret="+siret+"&email="+email, function( data ) {

require_once('../utils/class.phpmailer.php');
require_once('../utils/utils.php');
require_once('../config/db.php');
if(isset($_REQUEST['email']) && validarEMAIL($_REQUEST['email']) && isset($_REQUEST['pass']) && $_REQUEST['pass']!=''  && isset($_REQUEST['siret']) && $_REQUEST['siret']!='' && isset($_REQUEST['name']) && $_REQUEST['name']!='' ){



      $res= $db->prepare("SELECT id from enterprise where email=? limit 1");
      $res->bind_param('s',$_REQUEST['email']);
      $res->execute();
      $res->store_result();
      if($res->num_rows==0){
                $res->close();
                $res= $db->prepare("insert into enterprise (name,pass,email,siret,address,description) VALUES (?,?,?,?,' ',' ')");
                $res->bind_param('ssss',$_REQUEST['name'],md5($_REQUEST['pass']),$_REQUEST['email'],$_REQUEST['siret']);
                if($res->execute()){
                   $email="Bonjour ".$_REQUEST['name'].", <br> Inscrivez-vous dans notre système a été complété avec succès.. <br><br>Ce mot de passe est provisoire.<br><br><br>Cordialement, SoGreen.";
                   smtpmailer($_REQUEST['user'],$res_name, 'Confirmation d\'inscription - SoGreen',$email);

                  echo md5($res->insert_id);

                }else{
                  echo 'error';
                }


      }else{
        echo 'error';
      }
      $res->close();



}else{
    echo 'error';
}


?>