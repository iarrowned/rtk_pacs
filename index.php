<?php

require_once('config/cli-config.php');
global $entityManager;

use ActionManager\ActionManager;

use Tools\Processor;
use Tools\Validator;

$result = ['status' => false];

try {
    $data = Processor::run($_GET);
    switch ($data['action']) {
        case 'in':
            $result['status'] = (new Validator())->validate($data['user'], $data['zone']);
            break;
        case 'out':
            $result['status'] = ActionManager::createExit($data['user'], $data['zone']);
            break;
    }
} catch (Exception $e) {
    dump($e->getMessage());
}

echo json_encode($result);
die();

?>
