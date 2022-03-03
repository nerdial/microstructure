<?php

namespace App\Repository;

use App\Dto\Item;
use App\Dto\Product;
use App\Dto\Warehouse;

class CatalogRepository extends BaseRepository
{

    public function resetDatabase(): \PDOStatement
    {
        // order is important here

        $query = $this->builder->delete()
            ->setTable('warehouse');
        $sql = $this->builder->write($query);
        $this->connection->query($sql);

        $query = $this->builder->delete()
            ->setTable('item');
        $sql = $this->builder->write($query);
        $this->connection->query($sql);

        $query = $this->builder->delete()
            ->setTable('product');
        $sql = $this->builder->write($query);
        $this->connection->query($sql);

        return $this->connection->query($sql);

    }

    public function saveProduct(Product $product): int
    {
        $query = $this->builder->insert()
            ->setTable('product')
            ->setValues($product->toArray());

        $sql = $this->builder->writeFormatted($query);
        $values = $this->builder->getValues();

        $this->connection->prepare($sql)->execute($values);
        return $this->connection->lastInsertId();
    }

    public function saveItem(Item $item): int
    {
        $query = $this->builder->insert()
            ->setTable('item')
            ->setValues($item->toArray());

        $sql = $this->builder->writeFormatted($query);
        $values = $this->builder->getValues();

        $this->connection->prepare($sql)->execute($values);
        return $this->connection->lastInsertId();
    }


    public function saveWarehouse(Warehouse $warehouse)
    {

        $query = $this->builder->insert()
            ->setTable('warehouse')
            ->setValues($warehouse->toArray());

        $sql = $this->builder->writeFormatted($query);
        $values = $this->builder->getValues();

        $this->connection->prepare($sql)->execute($values);
        return $this->connection->lastInsertId();

    }

    public function save($data)
    {
        $product = $this->makePrdocut($data);
        $productId = $this->saveProduct($product);

        if (isset($data->Items) and count($data->Items)) {
            foreach ($data->Items as $i) {
                $item = $this->makeItem($i, $productId);
                $itemId = $this->saveItem($item);

                if (isset($i->Warehouse)) {
                    foreach ($i->Warehouse as $index => $value) {
                        $warehouse = $this->makeWarehouse($value, $itemId, $index);
                        $this->saveWarehouse($warehouse);
                    }
                }
            }
        }
    }


    private function makePrdocut($product): Product
    {
        return new Product(
            productId: $product->Product_ID,
            nr: $product->NR,
            name: $product->Name,
            productUrl: $product->Product_URL,
            searchKeyword: $product->Search_Keywords,
            description: $product->Description,
            category: $product->Category,
            categoryId: $product->Category_ID,
            subCategory: $product->SubCategory,
            subCategoryId: $product->SubCategory_ID,
            brand: $product->Brand
        );
    }

    private function makeWarehouse($warehouse, int $itemId, string $name): Warehouse
    {
        return new Warehouse(
            name: $name,
            inventoryCount: $warehouse->Inventory_Count,
            itemId: $itemId
        );
    }

    private function makeItem(object $item, int $productId): Item
    {
        return new Item(
            productId: $productId,
            sku: $item->SKU,
            price: $item->Price,
            retailPrice: $item->Retail_Price,
            thumbnailUrl: $item->Thumbnail_URL,
            color: $item->Color,
            colorFamily: $item->Color_Family,
            size: $item->Size,
            sizeFamily: $item->Size_Family,
            occassion: $item->Occassion,
            season: $item->Season,
            ratingAvg: $item->Rating_Avg,
            ratingCount: $item->Rating_Count,
            active: $item->Active ?? 0
        );
    }
}
