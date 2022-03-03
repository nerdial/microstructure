<?php

namespace App\Dto;

use App\Contract\DtoInterface;

class Warehouse implements DtoInterface
{
    public function __construct(
        private string $name,
        private int    $inventoryCount,
        private int    $itemId
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getInventoryCount(): int
    {
        return $this->inventoryCount;
    }

    /**
     * @return int
     */
    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function toArray(): array
    {
        return [
            'item_id' => $this->getItemId(),
            'name' => $this->getName(),
            'inventory_count' => $this->getInventoryCount()
        ];
    }
}
