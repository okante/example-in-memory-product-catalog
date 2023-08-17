<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleRemoteProductCatalog\PIM\InMemory\Value;

use Ibexa\Contracts\ProductCatalog\Values\AttributeDefinitionAssignmentInterface;
use Ibexa\Contracts\ProductCatalog\Values\AttributeDefinitionInterface;

final class AttributeDefinitionAssignment implements AttributeDefinitionAssignmentInterface
{
    public function __construct(
        private readonly AttributeDefinitionInterface $attributeDefinition,
        private readonly bool $required = false,
        private readonly bool $discriminator = false
    ) {
    }

    public function getAttributeDefinition(): AttributeDefinitionInterface
    {
        return $this->attributeDefinition;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function isDiscriminator(): bool
    {
        return $this->discriminator;
    }
}
