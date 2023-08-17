<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value;

use Ibexa\Contracts\Core\Collection\ArrayList;
use Ibexa\Contracts\ProductCatalog\Values\Asset\AssetCollectionInterface;

final class AssetCollection extends ArrayList implements AssetCollectionInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    public function withTag(string $tag, ?string $value = null): AssetCollectionInterface
    {
        return $this;
    }

    public function withTags(array $tags): AssetCollectionInterface
    {
        return $this;
    }
}
