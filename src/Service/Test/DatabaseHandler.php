<?php

namespace App\Service\Test;

use App\Migration\TestMigration;
use App\Service\Container\Container;

class DatabaseHandler
{

    public static function up()
    {

        if (!Container::exist('db')) {
            $db = new \PDO('sqlite::memory:');
            Container::bind('db', $db);
        } else {

            $db = Container::get('db');
        }

        $upQueries = TestMigration::up();

        foreach ($upQueries as $query) {

            $db->query($query)->execute();
        }

    }

    public static function down()
    {
        $db = Container::get('db');

        $upQueries = TestMigration::down();
        foreach ($upQueries as $query) {
            $db->query($query)->execute();
        }
    }

}