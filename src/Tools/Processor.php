<?php

namespace Tools;

use Entity\User;
use Entity\Zone;

class Processor
{
    protected const ALLOWED_ACTION = ['in', 'out'];

    /**
     * @throws \Exception
     */
    public static function run(array $params) {
        global $entityManager;

        if(!$params['action']) {
            throw new \Exception("Action param not found (may be ?action=in/out)");
        }

        if(!in_array($params['action'], self::ALLOWED_ACTION)) {
            throw new \Exception("Action must be only \"in\" or \"out\"");
        }

        if (!$params['user_id']) {
            throw new \Exception("User id not found (example: ?user_id=1");
        }

        if (!$params['zone_id']) {
            throw new \Exception("Zone id not found (example: ?zone_id=1");
        }

        $user = $entityManager->getRepository(User::class)->find($params['user_id']);
        if(!$user) {
            throw new \Exception("User with id {$params['user_id']} not found");
        }

        $zone = $entityManager->getRepository(Zone::class)->find($params['zone_id']);
        if(!$zone) {
            throw new \Exception("Zone with id {$params['zone_id']} not found");
        }

        return [
            'user' => $user,
            'zone' => $zone,
            'action' => $params['action']
        ];
    }
}