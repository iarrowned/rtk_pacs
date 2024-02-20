<?php

namespace ActionManager;

use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Entity\Action;
use Entity\Zone;
use Entity\User;
use Interface\ResponseInterface;
use Response\ErrorResponse;
use Response\SuccessResponse;

class ActionManager
{
    /**
     * @throws ORMException
     */
    public static function createEntry(User $user, Zone $zone): void
    {
        global $entityManager;

        $action = new Action();
        $action->setUser($user);
        $action->setZone($zone);

        $entityManager->persist($action);

        $entityManager->flush();
    }

    /**
     * @throws OptimisticLockException
     * @throws NotSupported
     * @throws ORMException
     */
    public static function createExit(User $user, Zone $zone): ResponseInterface
    {
        global $entityManager;
        $actionRepository = $entityManager->getRepository(Action::class);

        /**
         * @var Action $action
         */
        $action = $actionRepository->findOneBy([
            'user' => $user,
            'zone' => $zone
        ], ['id' => 'DESC']);

        if(!$action) {
            return new ErrorResponse('Invalid zone');
        }

        if($action->getTimeOut()) {
            return new ErrorResponse("Registered last exit, but not register new entry");
        }

        $action->setTimeOut(new \DateTime());
        $entityManager->flush();

        return new SuccessResponse("Exit registered");
    }
}