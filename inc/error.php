<?php
if($session->hasGet("errors")){
$errors=$session->get("errors");
    foreach($errors as $error){
        ?>
<div class="alert alert-danger"> <?php echo $error ?></div>
<?php
    }

    $session->unset("errors");
}