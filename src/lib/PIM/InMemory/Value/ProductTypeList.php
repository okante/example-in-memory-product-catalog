<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value;

use ArrayIterator;
use Ibexa\Contracts\ProductCatalog\Values\ProductType\ProductTypeListInterface;
use Traversable;

final class ProductTypeList implements ProductTypeListInterface
{
    /**
     * @param \Ibexa\Contracts\ProductCatalog\Values\ProductTypeInterface[] $types
     */
    public function __construct(
        private readonly array $types = [],
        private readonly int $totalCount = 0,
    ) {
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->types);
    }

    public function getProductTypes(): array
    {
        return $this->types;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }
}
