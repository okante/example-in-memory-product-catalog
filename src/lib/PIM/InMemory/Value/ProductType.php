<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value;

use Ibexa\Contracts\ProductCatalog\Values\ProductTypeInterface;
use Ibexa\Contracts\ProductCatalog\Values\RegionInterface;
use Ibexa\Contracts\ProductCatalog\Values\VatCategoryInterface;

final class ProductType extends ValueObject implements ProductTypeInterface
{
    /**
     * @param \Ibexa\Contracts\ProductCatalog\Values\AttributeDefinitionAssignmentInterface[] $attributes
     */
    public function __construct(
        private readonly string $identifier,
        private readonly string $name,
        private readonly iterable $attributes,
        private readonly ?VatCategoryInterface $vatCategory = null
    ) {
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAttributesDefinitions(): iterable
    {
        return $this->attributes;
    }

    public function getVatCategory(RegionInterface $region): ?VatCategoryInterface
    {
        return $this->vatCategory;
    }

    public function isVirtual(): bool
    {
        return false;
    }
}
