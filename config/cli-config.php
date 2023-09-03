<?php

require 'config/bootstrap.php';
global $entityManager;

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);