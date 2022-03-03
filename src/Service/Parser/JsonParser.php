<?php

namespace App\Service\Parser;

use App\Contract\FileParserInterface;
use App\Facade\FileImport;
use App\Service\Container\Container;
use JsonSchema\Validator;

class JsonParser implements FileParserInterface
{
    public function parse($data, string $schemaPath): bool
    {
        $schemaPath = FileImport::generatePath($schemaPath);

        $validator = new Validator();

        $validator->validate($data, (object)['$ref' => 'file://' . $schemaPath]);

        if (!$validator->isValid()) {
            foreach ($validator->getErrors() as $error) {
                logger()->warning($error['property']);
                logger()->warning($error['message']);
            }
            return false;
        }
        return true;
    }
}
