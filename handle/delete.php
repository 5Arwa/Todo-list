<?php

require_once "../App.php";

if($request->hasGet("id")){

    $id=$request->get("id");

   $stm= $conn->prepare("SELECT * from todo where id=(:id)");
   $stm->bindParam(":id",$id);
   $out=$stm->execute();

   if($out){
          $stm=$conn->prepare("DELETE from todo where id=(:id)");
          $stm->bindParam(":id",$id);
          $is_deleted= $stm->execute();

          if($is_deleted){
                 $session->set("success","todo deleted successfuly");
                 $request->header("../index.php");
          }else{
             $session->set("error","error while deleting");
             $request->header("../index.php");

          }



   }else{

        $session->set("error","todo not found");
        $request->header("../index.php");

   }


}else{
    $request->header("../index.php");
}