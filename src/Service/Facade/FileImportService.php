<?php

namespace App\Service\Facade;

use App\Contract\ServiceInterface;
use Exception;

class FileImportService implements ServiceInterface
{

    /**
     * @throws Exception
     */
    private function generateAbsolutePath(string $filePath): string
    {
        if (!isset($_ENV['ROOT_DIRECTORY'])) {
            throw new Exception('You need to define root directory first');
        }

        if (!str_starts_with($filePath, '/')) {
            return $_ENV['ROOT_DIRECTORY'] . '/' . $filePath;
        }
        return $_ENV['ROOT_DIRECTORY'] . $filePath;
    }

    /**
     * @throws Exception
     */
    public function load(string $filePath): string
    {
        if (empty($filePath)) {
            throw new \InvalidArgumentException("File path can't be empty");
        }

        $absolutePath = $this->generateAbsolutePath($filePath);


        if (!file_exists($absolutePath)) {
            throw new \InvalidArgumentException("File  $filePath does not exist");
        }
        return file_get_contents($absolutePath);
    }

    public function loadJson(string $filePath, bool $associative = true): array
    {
        return json_decode($this->load($filePath), $associative);
    }

    /**
     * @throws Exception
     */
    public function generatePath(string $path): string
    {
        return $this->generateAbsolutePath($path);
    }

}
