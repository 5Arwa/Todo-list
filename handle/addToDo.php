<?php

require_once '../App.php';

if($request->hasPost('submit')){
   $title=$request->filter('title');

   $validation->validate('title',$title,['Required','Str']);

   $errors=$validation->getError();
if(empty($errors)){
  $stm=  $conn->prepare("INSERT INTO todo(`title`) values(:title)");
  $stm->bindparam(":title",$title);
 $is_inserted= $stm->execute();
 if($is_inserted){
     $session->set('success',"inserted successfuly");
    $request->header('../index.php');

 }else{
     $session->set('errors',"error while add");
    $request->header('../index.php');
 }

}else{
    $session->set('errors',$errors);
    $request->header('../index.php');

}
}else{
   $request->header('../index.php');
}