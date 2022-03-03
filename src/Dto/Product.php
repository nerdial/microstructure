<?php

namespace App\Dto;

use App\Contract\DtoInterface;

class Product implements DtoInterface
{
    /**
     * @param int $productId
     * @param string $nr
     * @param string $name
     * @param string $productUrl
     * @param string $searchKeyword
     * @param string $description
     * @param string $category
     * @param int $categoryId
     * @param string $subCategory
     * @param int $subCategoryId
     * @param string $brand
     */
    public function __construct(
        private int $productId,
        private string $nr,
        private string $name,
        private string $productUrl,
        private string $searchKeyword,
        private string $description,
        private string $category,
        private int    $categoryId,
        private string $subCategory,
        private int    $subCategoryId,
        private string $brand
    ) {
    }


    public function toArray(): array
    {
        return [
            'product_id' => $this->getProductId(),
            'nr' => $this->getNr(),
            'name' => $this->getName(),
            'product_url' => $this->getProductUrl(),
            'search_keyword' => $this->getSearchKeyword(),
            'description' => $this->getDescription(),
            'category' => $this->getCategory(),
            'category_id' => $this->getCategoryId(),
            'sub_category' => $this->getSubCategory(),
            'sub_category_id' => $this->getSubCategoryId()
        ];
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getNr(): string
    {
        return $this->nr;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getProductUrl(): string
    {
        return $this->productUrl;
    }

    /**
     * @return string
     */
    public function getSearchKeyword(): string
    {
        return $this->searchKeyword;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getSubCategory(): string
    {
        return $this->subCategory;
    }

    /**
     * @return int
     */
    public function getSubCategoryId(): int
    {
        return $this->subCategoryId;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }
}
