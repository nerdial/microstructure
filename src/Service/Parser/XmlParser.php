<?php

namespace App\Service\Parser;

use App\Contract\FileParserInterface;

class XmlParser implements FileParserInterface
{
    public function parse($data, string $schemaPath): bool
    {
        return true;
    }
}
