<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value;

use Ibexa\Contracts\ProductCatalog\Values\VatCategoryInterface;

final class VatCategory implements VatCategoryInterface
{
    public function __construct(
        private readonly string $region,
        private readonly string $identifier,
        private readonly ?float $vatValue
    ) {
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getVatValue(): ?float
    {
        return $this->vatValue;
    }
}
