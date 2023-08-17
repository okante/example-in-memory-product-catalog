<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleRemoteProductCatalog\PIM\InMemory\Value;

use ArrayIterator;
use Ibexa\Contracts\ProductCatalog\Values\AttributeDefinition\AttributeDefinitionListInterface;
use Traversable;

final class AttributeDefinitionList implements AttributeDefinitionListInterface
{
    public function __construct(
        private readonly array $definitions = [],
        private readonly int $totalCount = 0
    ) {
    }

    public function getAttributeDefinitions(): array
    {
        return $this->definitions;
    }

    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->definitions);
    }
}
