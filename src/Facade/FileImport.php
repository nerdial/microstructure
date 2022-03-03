<?php

namespace App\Facade;

use App\Contract\Facade;
use App\Contract\ServiceInterface;
use App\Service\Facade\FileImportService;

/**
 * @method static bool load($filePath)
 * @method static bool loadJson($filePath, bool $associative = true)
 * @method static bool generatePath($path)
 */
class FileImport extends Facade
{
    protected static function getAccessor(): ServiceInterface
    {
        return new FileImportService();
    }
}
