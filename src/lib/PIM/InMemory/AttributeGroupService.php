<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleRemoteProductCatalog\PIM\InMemory;

use Ibexa\Contracts\ProductCatalog\AttributeGroupServiceInterface;
use Ibexa\Contracts\ProductCatalog\Values\AttributeGroup\AttributeGroupListInterface;
use Ibexa\Contracts\ProductCatalog\Values\AttributeGroup\AttributeGroupQuery;
use Ibexa\Contracts\ProductCatalog\Values\AttributeGroupInterface;
use Ibexa\Core\Base\Exceptions\NotFoundException;
use Ibexa\ExampleRemoteProductCatalog\PIM\InMemory\Value\AttributeGroup;
use Ibexa\ExampleRemoteProductCatalog\PIM\InMemory\Value\AttributeGroupList;

final class AttributeGroupService implements AttributeGroupServiceInterface
{
    public function getAttributeGroup(
        string $identifier,
        ?iterable $prioritizedLanguages = null
    ): AttributeGroupInterface {
        $group = AttributeGroup::tryFrom($identifier);
        if ($group === null) {
            throw new NotFoundException(AttributeGroupInterface::class, $identifier);
        }

        return $group;
    }

    public function findAttributeGroups(?AttributeGroupQuery $query = null): AttributeGroupListInterface
    {
        return new AttributeGroupList(AttributeGroup::cases());
    }
}
