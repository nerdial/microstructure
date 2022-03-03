<?php

use App\Facade\FileImport;
use App\Service\Parser\JsonParser;
use PHPUnit\Framework\TestCase;

class JsonParserTest extends TestCase
{
    protected function setUp(): void
    {
        include "bootstrap/log.php";
        parent::setUp();
    }

    public function testParseJson()
    {
        $products = FileImport::loadJson('catalog/catalog.json', false);
        $firstItem = $products[0];

        $schemaPath = 'catalog/schema.json';

        $jsonParser = new JsonParser();
        $this->assertTrue($jsonParser->parse($firstItem, $schemaPath));
    }

    public function testParseJsonFails()
    {
        $products = FileImport::loadJson('catalog/catalog.json', false);
        $firstItem = $products[1];

        $schemaPath = 'catalog/schema.json';

        $jsonParser = new JsonParser();
        $this->assertFalse($jsonParser->parse($firstItem, $schemaPath));
    }


}
