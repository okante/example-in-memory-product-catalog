<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value;

use ArrayIterator;
use Ibexa\Contracts\ProductCatalog\Values\AttributeGroup\AttributeGroupListInterface;
use Traversable;

final class AttributeGroupList implements AttributeGroupListInterface
{
    public function __construct(
        private readonly array $groups = [],
    ) {
    }

    public function getAttributeGroups(): array
    {
        return $this->groups;
    }

    public function getTotalCount(): int
    {
        return count($this->groups);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->groups);
    }
}
