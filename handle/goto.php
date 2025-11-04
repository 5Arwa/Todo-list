<?php

require_once "../App.php";

if($request->hasGet('name')&&$request->hasGet('id')){

    $status=$request->get('name');
    $id=$request->get('id');

    $stm=$conn->prepare('SELECT * from todo where id=(:id)');
    $stm->bindParam(':id',$id);
    $out=$stm->execute();
     
    if($out){
        $stm=$conn->prepare('UPDATE todo set `status`=(:status) where id=(:id)');
        $stm->bindParam(":status",$status);
        $stm->bindParam(":id",$id);
        $is_updated=$stm->execute();

        if( $is_updated){
                $session->set("success","updated successfuly");
                $request->header("../index.php"); 

        }else{
                $session->set("errors","error while updating");
                  $request->header("../index.php"); 
  
        }
       

    }else{
       $session->set("errors","todo not found");
    $request->header("../index.php");  
    }

}else{

    $session->set("errors","error at status");
    $request->header("../index.php");

}