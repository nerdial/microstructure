<?php

namespace App\Controller;


class MigrationController extends BaseController
{

    public function migrate()
    {
        $shell = [
            'cd ../  && ',
            './vendor/bin/doctrine-migrations migrate ',
            '--no-interaction 2>&1'
        ];

        $data = shell_exec(implode('', $shell));
        return json_encode([
            'success' => true,
            'message' => $data
        ]);
    }

    public function rollback()
    {
        $shell = [
            'cd ../  && ',
            './vendor/bin/doctrine-migrations execute ',
            'App\\\Migration\\\Version20220301124232 --down ',
            '--no-interaction 2>&1'
        ];
        $data = shell_exec(implode('', $shell));
        return json_encode([
            'message' => $data
        ]);

    }

}
