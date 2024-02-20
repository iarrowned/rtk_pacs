<?php

namespace Tools;

use ActionManager\ActionManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\NotSupported;
use Entity\Action;
use Entity\Rule;
use Entity\User;
use Entity\Zone;
use Exception;
use Interface\ResponseInterface;
use Response\ErrorResponse;
use Response\SuccessResponse;

class Validator
{

    /**
     * Проверяет возможность доступа пользователя в зону.
     *
     * @param User $user
     * @param Zone $zone
     * @return ResponseInterface Возвращает true, если доступ разрешен, иначе false.
     * @throws NotSupported
     */
    public function validate(User $user, Zone $zone): ResponseInterface
    {
        global $entityManager; // Предполагаем, что $entityManager уже определен в вашем приложении

        // Проверка последнего действия входа пользователя в зону
        $lastAction = $entityManager->getRepository(Action::class)->findOneBy([
            'user' => $user,
            'zone' => $zone
        ], ['id' => 'DESC']);

        if ($lastAction && !$lastAction->getTimeOut()) {
            // Пользователь все еще находится в зоне
            return new ErrorResponse('No last action time out');
        }

        // Здесь должна быть логика проверки правил доступа на основе сущности Rule,
        // которая не описана для краткости.
        if (!$this->checkAccessRules($user, $zone, $entityManager)) {
            return new ErrorResponse('No check'); // Доступ запрещен, не прошли проверку по правилам
        }

        // Предполагаем, что все проверки прошли успешно, и регистрируем вход
        try {
            ActionManager::createEntry($user, $zone);
        } catch (Exception $e) {
            // Обработка исключений, возникших при регистрации входа
            return new ErrorResponse($e->getMessage());
        }

        return new SuccessResponse("Success entry");
    }

    /**
     * Проверяет правила доступа между зонами для пользователя.
     *
     * @param User $user Объект пользователя.
     * @param Zone $targetZone Целевая зона для входа.
     * @param EntityManager $entityManager Менеджер сущностей.
     * @return bool Возвращает true, если переход разрешен согласно правилам, иначе false.
     * @throws NotSupported
     */
    public function checkAccessRules(User $user, Zone $targetZone, EntityManager $entityManager): bool
    {
        $lastAction = $entityManager->getRepository(Action::class)->findOneBy([
            'user' => $user
        ], ['timeOut' => 'DESC']);

        // Если у пользователя нет предыдущих действий, считаем, что доступ разрешен
        if (!$lastAction) {
            dump('No actions');
            return true;
        }

        // Получаем зону последнего действия пользователя
        $lastZone = $lastAction->getZone();

        // Находим правило, которое применяется к переходу из последней зоны в целевую
        $rule = $entityManager->getRepository(Rule::class)->findOneBy([
            'zoneA' => $lastZone,
            'zoneB' => $targetZone
        ]);

        // Если правило не найдено, доступ разрешен
        if (!$rule) {
            return true;
        }

        // Проверяем, достаточно ли времени прошло с момента последнего выхода из зоны
        $currentTime = new \DateTime();
        $lastExitTime = $lastAction->getTimeOut();
        $hourInterval = $rule->getHourInterval();

        if ($lastExitTime) {
            $timePassed = $currentTime->getTimestamp() - $lastExitTime->getTimestamp();
            $hoursPassed = $timePassed / 3600;

            // Если прошло меньше времени, чем требуется по правилу, доступ запрещен
            if ($hoursPassed < $hourInterval) {
                dump('No time');
                return false;
            }
        }

        // Все проверки пройдены, доступ разрешен
        return true;
    }

}