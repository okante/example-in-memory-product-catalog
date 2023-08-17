<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value;

use EmptyIterator;
use Ibexa\Contracts\ProductCatalog\Values\Product\ProductVariantListInterface;
use Traversable;

final class ProductVariantList implements ProductVariantListInterface
{
    public function getIterator(): Traversable
    {
        return new EmptyIterator();
    }

    public function count(): int
    {
        return 0;
    }

    public function getVariants(): array
    {
        return [];
    }

    public function getTotalCount(): int
    {
        return 0;
    }
}
