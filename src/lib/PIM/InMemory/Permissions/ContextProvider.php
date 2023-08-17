<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleRemoteProductCatalog\PIM\InMemory\Permissions;

use Ibexa\Contracts\ProductCatalog\Permission\ContextInterface;
use Ibexa\Contracts\ProductCatalog\Permission\ContextProvider\ContextProviderInterface;
use Ibexa\Contracts\ProductCatalog\Permission\Policy\PolicyInterface;
use Ibexa\ExampleRemoteProductCatalog\PIM\InMemory\Value\ValueObject;
use ProxyManager\Proxy\LazyLoadingInterface;
use ProxyManager\Proxy\ValueHolderInterface;

final class ContextProvider implements ContextProviderInterface
{
    public function accept(PolicyInterface $policy): bool
    {
        return $this->unwrap($policy->getObject()) instanceof ValueObject;
    }

    public function getPermissionContext(PolicyInterface $policy): ContextInterface
    {
        return new Context(
            $this->unwrap($policy->getObject()),
            $policy->getTargets()
        );
    }

    private function unwrap(?object $object): ?object
    {
        if ($object instanceof ValueHolderInterface) {
            if ($object instanceof LazyLoadingInterface) {
                $object->initializeProxy();
            }

            $object = $object->getWrappedValueHolderValue();
        }

        return $object;
    }
}
