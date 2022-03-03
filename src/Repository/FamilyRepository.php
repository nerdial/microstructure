<?php

namespace App\Repository;

use App\Facade\FileImport;

class FamilyRepository extends BaseRepository
{

    public function removeFamilyRecords() :\PDOStatement
    {
        $query = $this->builder->delete()
            ->setTable('family');

        $sql = $this->builder->write($query);

        return $this->connection->query($sql);
    }

    public function countFamilyRecords()
    {
        $query = $this->builder
            ->select()->setTable('family')
            ->count('id', 'count')->orderBy('id');
        $sql = $this->builder->write($query);
        $query = $this->connection->query($sql)->fetch();
        return $query['count'];
    }

    public function insertFamilyRecords()
    {
        $records = require_once FileImport::generatePath('resource/family.php');
        foreach ($records as $record) {
            $query = $this->builder->insert()
                ->setTable('family')
                ->setValues($record);
            $sql = $this->builder->writeFormatted($query);
            $values = $this->builder->getValues();
            $this->connection->prepare($sql)->execute($values);
        }
    }

    public function getFamilies(): array
    {
        $query = $this->builder
            ->select()
            ->setTable('family')
            ->setColumns([
                'surname' => 'surname'
            ])
            ->setFunctionAsColumn('COUNT', ['id'], 'members')
            ->setFunctionAsColumn('MAX', ['age'], 'max_age')
            ->setFunctionAsColumn(
                'GROUP_CONCAT',
                ['CASE WHEN legal_guardian = 0 THEN first_name END ORDER BY first_name'],
                'children'
            )
            ->setFunctionAsColumn(
                'GROUP_CONCAT',
                ['CASE WHEN legal_guardian = 1 and gender = 
                "male" THEN first_name END ORDER BY first_name'],
                'father'
            )->groupBy(['surname'])->orderBy('surname');

        $sql = $this->builder->write($query);
        $users = $this->connection->query($sql);
        return $users->fetchAll();
    }


    // converted the below sql to query builder
//    private function getFamilyQuery()
//    {
//        return " select
//surname ,
//max(age) as max_age ,
//count(id) as members  ,
//GROUP_CONCAT(
//    CASE WHEN legal_guardian = 0 THEN first_name END
//   		ORDER BY first_name
//            ) as children,
//
//GROUP_CONCAT(
//    CASE WHEN legal_guardian = 1 and gender = 'male' THEN first_name END
//   		ORDER BY first_name
//            ) as father
//
//
//from family GROUP by surname
//
//order by surname; ";
//    }
}
