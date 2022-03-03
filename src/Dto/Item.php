<?php

namespace App\Dto;

use App\Contract\DtoInterface;

class Item implements DtoInterface
{
    public function __construct(
        private int    $productId,
        private string $sku,
        private float  $price,
        private float  $retailPrice,
        private string $thumbnailUrl,
        private string $color,
        private string $colorFamily,
        private string $size,
        private string $sizeFamily,
        private array  $occassion,
        private array  $season,
        private float  $ratingAvg,
        private float  $ratingCount,
        private int    $active
    ) {
    }

    /**
     * @return float
     */
    public function getRetailPrice(): float
    {
        return $this->retailPrice;
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
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function getColorFamily(): string
    {
        return $this->colorFamily;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getSizeFamily(): string
    {
        return $this->sizeFamily;
    }

    /**
     * @return string
     */
    public function getOccassion(): array
    {
        return $this->occassion;
    }

    /**
     * @return string
     */
    public function getSeason(): array
    {
        return $this->season;
    }

    /**
     * @return float
     */
    public function getRatingAvg(): float
    {
        return $this->ratingAvg;
    }

    /**
     * @return float
     */
    public function getRatingCount(): float
    {
        return $this->ratingCount;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }


    public function toArray(): array
    {
        return [
            'product_id' => $this->getProductId(),
            'sku' => $this->getSku(),
            'price' => $this->getPrice(),
            'thumbnail_url' => $this->getThumbnailUrl(),
            'color' => $this->getColor(),
            'color_family' => $this->getColorFamily(),
            'size' => $this->getSize(),
            'size_family' => $this->getSizeFamily(),
            'occassion' => json_encode($this->getOccassion()),
            'season' => json_encode($this->getSeason()),
            'rating_avg' => $this->getRatingAvg(),
            'rating_count' => $this->getRatingCount(),
            'active' => $this->getActive()
        ];
    }
}
