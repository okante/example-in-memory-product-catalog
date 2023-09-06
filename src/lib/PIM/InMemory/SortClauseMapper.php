<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory;

use Ibexa\Contracts\ProductCatalog\Values\Product\Query\SortClause;
use Ibexa\Contracts\ProductCatalog\Values\ProductInterface;

final class SortClauseMapper
{
    public function mapToProperty(SortClause $sortClause, ProductInterface $product): mixed
    {
        return match (get_class($sortClause)) {
            SortClause\ProductCode::class => $product->getCode(),
            SortClause\ProductName::class => $product->getName(),
            SortClause\CreatedAt::class => $product->getCreatedAt()->getTimestamp(),
            default => ''
        };
    }
}
