<?php


require_once('../../utils/utils.php');
require_once('../../config/db.php');
if(isset($_REQUEST['myid']) && $_REQUEST['myid']!='' && isset($_REQUEST['prenom']) && $_REQUEST['prenom']!='' && isset($_REQUEST['nom']) && $_REQUEST['nom']!=''  && isset($_REQUEST['adresse']) && $_REQUEST['adresse']!='' && isset($_REQUEST['description']) && $_REQUEST['description']!='' ){

      $res= $db->prepare("UPDATE employeurs set name=?, description=?,  address=?, nome_familia=? where MD5(id)=? limit 1");
      $res->bind_param('sssss',$_REQUEST['prenom'],$_REQUEST['description'],$_REQUEST['adresse'],$_REQUEST['nom'],$_REQUEST['myid']);
      $res->execute();
      $res->close();
      echo 'ok';


}else{
    echo 'error';
}

