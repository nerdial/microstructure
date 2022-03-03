<?php

namespace App\Repository;

use App\Service\Container\Container;
use NilPortugues\Sql\QueryBuilder\Builder\BuilderInterface;
use \PDO;
use NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder;

class BaseRepository
{

    protected PDO $connection;
    protected BuilderInterface $builder;

    public function __construct()
    {
        $this->setupPdo();
        $this->setupQueryBUilder();
    }

    private function setupPdo()
    {
        try {

            if($_ENV['APP_ENV'] === 'testing'){
                $this->connection = Container::get('db');
            }
            else {
                $dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};charset=UTF8";
                $this->connection = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            }

        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    private function setupQueryBuilder()
    {
        $this->builder = new GenericBuilder();
    }


}
