<?php

namespace App\Controller;

class RefactorController extends BaseController
{
    public function index()
    {
        $cityName = $_GET['city'] ??
            throw new \InvalidArgumentException('Location does not exists');

        $filePath = realpath('.') . $cityName;
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException('File does not exists');
        }

        require_once $cityName;

        $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};charset=UTF8";

        try {
            $pdo = new \PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }


        $stmt = $pdo->prepare('SELECT * FROM `users` WHERE `city` = :city');
        $stmt->execute(['city' => $cityName]);
        $users = $stmt->fetch(\PDO::FETCH_ASSOC);

        $usersFromOtherCities = [];

        foreach ($users as $user) {
            if (file_exists($user['user_dir'])) {
                echo $_REQUEST['message'] . ' ' . $user['name'] . "\n";
            } else {
                $usersFromOtherCities[$user['city']] = $user;
            }
        }

        echo 'Users from other cities:' . "\n";

        $cities = ['Nürnberg', 'Ansbach'];

        $citiesFiltered = array_filter(
            $usersFromOtherCities,
            fn ($item, $index) => in_array($index, $cities),
            ARRAY_FILTER_USE_BOTH
        );
        array_walk($citiesFiltered, function ($item, $city) {
            echo $city . ' (' . count($item) . ')' . "\n";
        });
    }
}
