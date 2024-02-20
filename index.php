<?php

require_once('config/cli-config.php');
global $entityManager;

use ActionManager\ActionManager;
use Response\ErrorResponse;
use Tools\Processor;
use Tools\Validator;

$response = new ErrorResponse("No validated");

try {
    $data = Processor::run($_GET);
    switch ($data['action']) {
        case 'in':
            $response = (new Validator())->validate($data['user'], $data['zone']);
            break;
        case 'out':
            $response = ActionManager::createExit($data['user'], $data['zone']);
            break;
    }
} catch (Exception $e) {
    $response = new ErrorResponse("Runtime error: " . $e->getMessage());
}

echo json_encode($response->toArray());
die();

?>
