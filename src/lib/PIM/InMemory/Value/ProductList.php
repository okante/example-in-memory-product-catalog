<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value;

use ArrayIterator;
use Ibexa\Contracts\Core\Repository\Values\Content\Search\AggregationResultCollection;
use Ibexa\Contracts\ProductCatalog\Values\Product\ProductListInterface;
use Traversable;

final class ProductList implements ProductListInterface
{
    /**
     * @param \Ibexa\Contracts\ProductCatalog\Values\ProductInterface[] $products
     */
    public function __construct(
        private readonly array $products,
        private readonly int $totalCount,
    ) {
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->products);
    }

    public function count(): int
    {
        return count($this->products);
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function getAggregations(): ?AggregationResultCollection
    {
        return null;
    }
}
