<?php

require_once('config/cli-config.php');
global $entityManager;

use Main\Rule;
use Main\User;


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


$user = $entityManager->getRepository(User::class)->find(1);

// Все про зону (зона и правила, которые на входе в нее должны быть проверены).
$zone = $entityManager->getRepository(\Main\Zone::class)->find(4);
$rules = $zone->getRules();
dump($zone);

$userActions = $user->getActions();
/**
 * @var Rule[] $rules
 */
foreach ($rules as $rule) {
    dump($rule);

    /**
     * @var \Main\Action[] $userActions
     */
    foreach ($userActions as $action) {
        dump($action);
        if($action->getZone() === $rule->getZoneA()) {
            dump($action->getInterval() >= $rule->getHourInterval());
            dump($action->getInterval());
        }
    }
}



/* создать правило
$zoneA = $entityManager->getRepository(\Main\Zone::class)->find(1);
$zoneB = $entityManager->getRepository(\Main\Zone::class)->find(4);
$reglament = new \Main\Rule();
$reglament->setZoneA($zoneA);
$reglament->setZoneB($zoneB);
$reglament->setHourInterval(15);
$entityManager->persist($reglament);
$entityManager->flush();
*/