<?php
require_once('vendor/autoload.php');
require_once('main/prolog.php');

use Helper\DB;
use Model\Action;
use Model\Rule;
use Model\User;
use Model\Zone;


use Framework\Ddd\Layers\Repository\UserRepository;

$r = new UserRepository();


/*
$currentZone = 4;
$user = User::getUserById(1);
$zone = Zone::getZoneById(2);
$action = Action::getActionById($user['last_action']);
$rule = Rule::getRuleByZoneIds($action['zone_id'], $currentZone);


//dump($action);
//dump($user);
//dump($zone);
//dump($rule);

//dump(Rule::getAllRulse());
//dump(Zone::getAllZones());

*/