<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleRemoteProductCatalog\PIM\InMemory\Value;

use Ibexa\Contracts\ProductCatalog\Values\AttributeDefinitionInterface;
use Ibexa\Contracts\ProductCatalog\Values\AttributeInterface;
use Stringable;

final class Attribute implements AttributeInterface, Stringable
{
    public function __construct(
        private readonly AttributeDefinitionInterface $attributeDefinition,
        private readonly mixed $value
    ) {
    }

    public function getIdentifier(): string
    {
        return $this->attributeDefinition->getIdentifier();
    }

    public function getAttributeDefinition(): AttributeDefinitionInterface
    {
        return $this->attributeDefinition;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}
