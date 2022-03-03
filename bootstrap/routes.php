<?php

use Pecee\SimpleRouter\SimpleRouter;

use App\Controller\HomeController;
use App\Controller\ImportController;
use App\Controller\MigrationController;
use App\Controller\FamilyController;
use App\Controller\AddressController;

SimpleRouter::get('/', [HomeController::class, 'index']);

SimpleRouter::get('/import', [ImportController::class, 'index']);

SimpleRouter::get('/migrate', [MigrationController::class, 'migrate']);

SimpleRouter::get('/rollback', [MigrationController::class, 'rollback']);

SimpleRouter::get('/family', [FamilyController::class, 'index']);

SimpleRouter::get('/address', [AddressController::class, 'index']);

SimpleRouter::start();
