<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory;

use Ibexa\Contracts\ProductCatalog\ProductTypeServiceInterface;
use Ibexa\Contracts\ProductCatalog\Values\LanguageSettings;
use Ibexa\Contracts\ProductCatalog\Values\ProductType\ProductTypeListInterface;
use Ibexa\Contracts\ProductCatalog\Values\ProductType\ProductTypeQuery;
use Ibexa\Contracts\ProductCatalog\Values\ProductTypeInterface;
use Ibexa\Core\Base\Exceptions\NotFoundException;
use Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Data\DataProvider;
use Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value\ProductTypeList;

final class ProductTypeService implements ProductTypeServiceInterface
{
    public function __construct(
        private readonly DataProvider $data
    ) {
    }

    public function getProductType(
        string $identifier,
        ?LanguageSettings $languageSettings = null
    ): ProductTypeInterface {
        if (!$this->data->getProductTypes()->has($identifier)) {
            throw new NotFoundException(ProductTypeInterface::class, $identifier);
        }

        return $this->data->getProductTypes()->get($identifier);
    }

    public function findProductTypes(
        ?ProductTypeQuery $query = null,
        ?LanguageSettings $languageSettings = null
    ): ProductTypeListInterface {
        return new ProductTypeList(
            $this->data->getProductTypes()->toArray(),
            $this->data->getProductTypes()->count()
        );
    }
}
