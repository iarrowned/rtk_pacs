<?php

namespace Tools;

use Entity\User;
use Entity\Zone;

class Validator
{
    public function validate(User $user, Zone $zone)
    {
        $result = [];
        $userActions = $user->getActions();
        $rules = $zone->getRules();

        foreach ($rules as $rule) {
            foreach ($userActions as $action) {
                if($action->getZone() === $rule->getZoneA()) {
                    $result[] = $action->getInterval() >= $rule->getHourInterval();
                    if($action->getInterval() < $rule->getHourInterval())
                    {
                        return $rule;
                    }
                }
            }
        }

        return !in_array(false, $result, true);
    }

}