<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value;

use Ibexa\Contracts\ProductCatalog\Values\AttributeTypeInterface;

enum AttributeType: string implements AttributeTypeInterface
{
    case INTEGER = 'int';
    case STRING = 'str';

    public function getIdentifier(): string
    {
        return $this->value;
    }

    public function getName(): string
    {
        return match ($this) {
            self::INTEGER => 'Integer',
            self::STRING => 'String',
        };
    }
}
