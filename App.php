<?php

require_once 'inc/connection.php';

require_once 'classes/request.php';

require_once 'classes/session.php';

require_once 'classes/validation/Required.php';
require_once 'classes/validation/Str.php';
require_once 'classes/validation/validation.php';

$request= new Request;
$session= new Session;

$validation= new validation;
