<?php

namespace App\Controller;

use App\Facade\FileImport;
use App\Repository\CatalogRepository;
use App\Service\Parser\JsonParser;
use App\Service\Test\DatabaseHandler;

class ImportController extends BaseController
{
    private CatalogRepository $catalogRepository;

    public function __construct()
    {
        $this->catalogRepository = new CatalogRepository();
    }

    public function index()
    {
        $products = FileImport::loadJson('catalog/catalog.json', false);
        $parser = new JsonParser();
        $schemaPath = 'catalog/schema.json';
        foreach ($products as $product) {
            if ($parser->parse($product, $schemaPath)) {
                $this->catalogRepository->save($product);
            }
        }
        return json_encode([
            'success' => true
        ]);
    }


}
