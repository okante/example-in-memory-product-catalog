<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleRemoteProductCatalog\PIM\InMemory\Value;

use Ibexa\Contracts\ProductCatalog\Values\AttributeGroupInterface;

enum AttributeGroup: string implements AttributeGroupInterface
{
    case DEFAULT = 'default';

    public function getName(): string
    {
        return $this->value;
    }

    public function getIdentifier(): string
    {
        return $this->value;
    }

    public function getPosition(): int
    {
        return 0;
    }
}
