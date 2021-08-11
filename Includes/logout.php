<?php

require_once('objects/init.php');
global $session;

$session->logout();
header('Location: login.php');
