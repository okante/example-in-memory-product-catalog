<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory;

use Ibexa\Contracts\ProductCatalog\AttributeDefinitionServiceInterface;
use Ibexa\Contracts\ProductCatalog\Values\AttributeDefinition\AttributeDefinitionListInterface;
use Ibexa\Contracts\ProductCatalog\Values\AttributeDefinition\AttributeDefinitionQuery;
use Ibexa\Contracts\ProductCatalog\Values\AttributeDefinitionInterface;
use Ibexa\Core\Base\Exceptions\NotFoundException;
use Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Data\DataProvider;
use Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value\AttributeDefinitionList;

final class AttributeDefinitionService implements AttributeDefinitionServiceInterface
{
    public function __construct(
        private readonly DataProvider $data
    ) {
    }

    public function getAttributeDefinition(
        string $identifier,
        ?iterable $prioritizedLanguages = null
    ): AttributeDefinitionInterface {
        if (!$this->data->getAttributeDefinitions()->has($identifier)) {
            throw new NotFoundException(AttributeDefinitionInterface::class, $identifier);
        }

        return $this->data->getAttributeDefinitions()->get($identifier);
    }

    public function findAttributesDefinitions(
        ?AttributeDefinitionQuery $query = null
    ): AttributeDefinitionListInterface {
        return new AttributeDefinitionList(
            $this->data->getAttributeDefinitions()->toArray(),
            $this->data->getAttributeDefinitions()->count()
        );
    }
}
