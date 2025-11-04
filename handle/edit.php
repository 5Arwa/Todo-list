<?php
require_once '../App.php';


if($request->hasPost('submit') && $request->hasGet('id')){
 $id=$request->get('id');
 $title=$request->filter('title');

 $validation->validate('title',$title,['Required','Str']);

   $errors=$validation->getError();

 if(empty($errors)){

      $stm=$conn->prepare("SELECT * from todo where id=(:id)");
      $stm->bindParam(":id",$id);
      $out=$stm->execute();

      if($out){

        $stm=$conn->prepare("UPDATE todo set `title`=(:title) where id=(:id) ");
        $stm->bindParam(":title",$title);
        $stm->bindParam(":id",$id);
        $is_updated=$stm->execute();

        if($is_updated){
            $session->set('success',"todo updated sucsessfuly");
            $request->header("../index.php");
        }else{
            $session->set('errors',"error while update");
        $request->header("../index.php"); 
        }


         
      }else{
        $session->set('errors',"data not found");
        $request->header("../index.php");
      }



 }else{
     $session->set('errors',$errors);
     $request->header("update.php");

 }
}else{
    $request->header("../index.php");
}