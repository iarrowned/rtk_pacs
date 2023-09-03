<?php

require_once('config/cli-config.php');
global $entityManager;

use ActionManager\ActionManager;
use Entity\Rule,
    Entity\User,
    Entity\Action,
    Entity\Zone;

use Tools\Validator;




/* Создать экшен
$user = $entityManager->getRepository(User::class)->find(1);
$zone = $entityManager->getRepository(\Main\Zone::class)->find(1);
$action = new \Main\Action();
$action->setUser($user);
$action->setZone($zone);
$entityManager->persist($action);
$entityManager->flush();

dump($action);
*/

/* Получить временной интервал между зонами
$user = $entityManager->getRepository(User::class)->find(1);
$userActions = $user->getActions();
foreach ($userActions as $action) {

    $timeId = $action->getTimeIn();
    $now = new DateTime("1 day");
    $diff = $now->getTimestamp() - $timeId->getTimestamp();

    dump((int)($diff / 3600));
}
*/

/* TODO: root

$user = $entityManager->getRepository(User::class)->find(1);

// Все про зону (зона и правила, которые на входе в нее должны быть проверены).
$zone = $entityManager->getRepository(\Entity\Zone::class)->find(4);
$rules = $zone->getRules();
//dump($zone);

$userActions = $user->getActions();

foreach ($rules as $rule) {
    dump($rule);


    foreach ($userActions as $action) {
        //dump($action);
        if($action->getZone() === $rule->getZoneA()) {
            //dump($action->getInterval() >= $rule->getHourInterval());
            //dump($action->getInterval());
        }
    }
}


$user = $entityManager->getRepository(User::class)->find(1);
$zone = $entityManager->getRepository(Zone::class)->find(2);
if($user && $zone) {
    ActionManager::createEntry($user, $zone);
}*/

$userId = $_GET['user_id'];
$zoneId = $_GET['zone_id'];

$user = $entityManager->getRepository(User::class)->find($userId);
$zone = $entityManager->getRepository(Zone::class)->find($zoneId);

dump($user);
dump($zone);
dump((new Validator())->validate($user, $zone));


