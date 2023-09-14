<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory;

use Ibexa\Contracts\ProductCatalog\Values\Product\Query\Criterion;
use Ibexa\Contracts\ProductCatalog\Values\Product\Query\CriterionInterface;
use Ibexa\Contracts\ProductCatalog\Values\ProductInterface;

final class CriterionVisitor
{
    public function __construct(private readonly CriterionInterface $criterion)
    {
    }

    public function evaluate(ProductInterface $product, ?CriterionInterface $criterion = null): bool
    {
        $criterion ??= $this->criterion;

        return match (get_class($criterion)) {
            Criterion\ProductCode::class => $this->evaluateCode($criterion, $product),
            Criterion\ProductName::class => $this->evaluateName($criterion, $product),
            Criterion\ProductType::class => $this->evaluateType($criterion, $product),
            Criterion\ProductAvailability::class => $this->evaluateAvailability($criterion, $product),
            Criterion\LogicalAnd::class => $this->evaluateLogicalAnd($criterion, $product),
            Criterion\LogicalOr::class => $this->evaluateLogicalOr($criterion, $product),
            Criterion\ProductCategorySubtree::class => true,
            // Ignore unsupported criteria
            default => false
        };
    }

    private function evaluateCode(Criterion\ProductCode $criterion, ProductInterface $product): bool
    {
        return in_array($product->getCode(), $criterion->getCodes());
    }

    private function evaluateName(Criterion\ProductName $criterion, ProductInterface $product): bool
    {
        return str_contains($criterion->getName(), $product->getName());
    }

    private function evaluateType(Criterion\ProductType $criteria, ProductInterface $product): bool
    {
        return in_array($product->getProductType()->getIdentifier(), $criteria->getTypes());
    }

    private function evaluateAvailability(Criterion\ProductAvailability $criterion, ProductInterface $product): bool
    {
        return $product->isAvailable() === $criterion->isAvailable();
    }

    private function evaluateLogicalAnd(Criterion\LogicalAnd $criteria, ProductInterface $product): bool
    {
        foreach ($criteria->getCriteria() as $innerCriterion) {
            if (!$this->evaluate($product, $innerCriterion)) {
                return false;
            }
        }

        return true;
    }

    private function evaluateLogicalOr(Criterion\LogicalOr $criterion, ProductInterface $product): bool
    {
        foreach ($criterion->getCriteria() as $innerCriterion) {
            if ($this->evaluate($product, $innerCriterion)) {
                return true;
            }
        }

        return false;
    }

    public function __invoke(ProductInterface $product): bool
    {
        return $this->evaluate($product);
    }
}
