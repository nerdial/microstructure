<?php

namespace App\Contract;

interface FileParserInterface
{

    public function parse($data, string $schemaPath): bool;

}
