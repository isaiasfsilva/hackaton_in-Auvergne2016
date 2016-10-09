<?php


require_once('../../utils/utils.php');
require_once('../../config/db.php');
if(isset($_REQUEST['myid']) && $_REQUEST['myid']!='' && isset($_REQUEST['depart_bus']) && $_REQUEST['depart_bus']!='' && isset($_REQUEST['arrive_bus']) && $_REQUEST['arrive_bus']!=''  && isset($_REQUEST['distance_bus']) && $_REQUEST['distance_bus']!=''){

      $res= $db->prepare("SELECT id from employeurs where MD5(id)=? limit 1");

      $res->bind_param('s',$_REQUEST['myid']);
      $res->execute();
      $res->store_result();
      if($res->num_rows()==1){
        $res->bind_result($meuid);
        $res->fetch();

        $res->close();
        $res= $db->prepare("INSERT into voyages(id_emp,arrive,depart,distance) VALUES(?,?,?,?) ");
        $res->bind_param('iiss',$meuid,$_REQUEST['arrive_bus'],$_REQUEST['depart_bus'],$_REQUEST['distance_bus']);
        $res->execute();
        echo 'ok';
      }else{
        echo 'error';
      }
      $res->close();



}else{
    echo 'error';
}

