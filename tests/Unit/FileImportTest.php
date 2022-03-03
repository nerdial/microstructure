<?php

use PHPUnit\Framework\TestCase;
use App\Facade\FileImport;

final class FileImportTest extends TestCase
{
    protected $filePath = 'catalog/catalog.json';

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getAbsolutePath(): string
    {
        return $_ENV['ROOT_DIRECTORY'] . '/' . $this->filePath;
    }

    public function testLoadAFile()
    {
        $expectedContent = file_get_contents($this->getAbsolutePath());
        $actualContent = FileImport::load($this->filePath);

        $this->assertNotEmpty($actualContent);
        $this->assertEquals($expectedContent, $actualContent);
    }

    public function testLoadAFileWithEmptyFilePath()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("File path can't be empty");
        FileImport::load('');
    }

    public function testLoadANonExistingFile()
    {
        $filePath = 'random.json';
        $message = "File  $filePath does not exist";
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);
        FileImport::load('random.json');
    }


    public function testLoadJsonFile()
    {
        $expectedContent = json_decode(file_get_contents($this->getAbsolutePath()), true);
        $actualContent = FileImport::loadJson($this->filePath);

        $this->assertNotEmpty($actualContent);
        $this->assertEquals($expectedContent, $actualContent);
    }

    public function testLoadJsonFileWithAssociativeFalse()
    {
        $expectedContent = json_decode(file_get_contents($this->getAbsolutePath()), false);
        $actualContent = FileImport::loadJson($this->filePath, false);

        $this->assertNotEmpty($actualContent);
        $this->assertEquals($expectedContent, $actualContent);
    }


    public function testGenerateAPath()
    {
        $expectedContent = $this->getAbsolutePath();
        $actualPath = FileImport::generatePath($this->filePath);

        $this->assertNotEmpty($actualPath);
        $this->assertEquals($expectedContent, $actualPath);
    }
}
