<?php

require 'vendor/autoload.php';

use Idevels\Package\TestRail;
use Idevels\Package\User;

$testrail = new TestRail();
$user = new User($testrail);
//$all_user = $user->getUsers();
//print_r(json_decode($all_user));
//$all_user = $user->getUserByEmail('example@example.com');
//print_r(json_decode($all_user));
$all_user = $user->getUser(1);
print_r(json_decode($all_user));
