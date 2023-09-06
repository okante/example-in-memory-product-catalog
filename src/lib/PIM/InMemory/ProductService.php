<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory;

use Ibexa\Contracts\ProductCatalog\ProductServiceInterface;
use Ibexa\Contracts\ProductCatalog\Values\LanguageSettings;
use Ibexa\Contracts\ProductCatalog\Values\Product\ProductListInterface;
use Ibexa\Contracts\ProductCatalog\Values\Product\ProductQuery;
use Ibexa\Contracts\ProductCatalog\Values\Product\ProductVariantListInterface;
use Ibexa\Contracts\ProductCatalog\Values\Product\ProductVariantQuery;
use Ibexa\Contracts\ProductCatalog\Values\ProductInterface;
use Ibexa\Contracts\ProductCatalog\Values\ProductVariantInterface;
use Ibexa\Core\Base\Exceptions\NotFoundException;
use Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Data\DataProvider;
use Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value\ProductList;
use Ibexa\ExampleInMemoryProductCatalog\PIM\InMemory\Value\ProductVariantList;

final class ProductService implements ProductServiceInterface
{
    public function __construct(
        private readonly DataProvider $data,
        private readonly SortClauseMapper $sortClauseMapper
    ) {
    }

    public function getProduct(string $code, ?LanguageSettings $settings = null): ProductInterface
    {
        if (!$this->data->getProducts()->has($code)) {
            throw new NotFoundException(ProductInterface::class, $code);
        }

        return $this->data->getProducts()->get($code);
    }

    public function findProducts(ProductQuery $query, ?LanguageSettings $languageSettings = null): ProductListInterface
    {
        $products = $this->data->getProducts()->toArray();

        if ($query->hasFilter()) {
            $products = array_filter($products, new CriterionVisitor($query->getFilter()));
        }

        if ($query->hasQuery()) {
            $products = array_filter($products, new CriterionVisitor($query->getQuery()));
        }

        $sortClauses = $query->getSortClauses();
        if (!empty($sortClauses)) {
            $products = $this->applySorting($products, $sortClauses);
        }

        $products = array_slice(
            $products,
            $query->getOffset(),
            $query->getLimit()
        );

        return new ProductList(
            array_values($products),
            $this->data->getProducts()->count()
        );
    }

    public function getProductVariant(string $code, ?LanguageSettings $settings = null): ProductVariantInterface
    {
        throw new NotFoundException(ProductVariantInterface::class, $code);
    }

    public function findProductVariants(
        ProductInterface $product,
        ?ProductVariantQuery $query = null
    ): ProductVariantListInterface {
        return new ProductVariantList();
    }

    /**
     * @param \Ibexa\Contracts\ProductCatalog\Values\ProductInterface[] $products
     * @param \Ibexa\Contracts\ProductCatalog\Values\Product\Query\SortClause[] $sortClauses
     *
     * @return \Ibexa\Contracts\ProductCatalog\Values\ProductInterface[]
     */
    private function applySorting(array $products, array $sortClauses): array
    {
        usort(
            $products,
            function (ProductInterface $product1, ProductInterface $product2) use ($sortClauses): int {
                $sortClause = $sortClauses[0];
                $direction = $sortClause->getDirection();

                if ($direction === 'ascending') {
                    $product1Property = $this->sortClauseMapper->mapToProperty($sortClause, $product1);
                    $product2Property = $this->sortClauseMapper->mapToProperty($sortClause, $product2);
                } else {
                    $product1Property = $this->sortClauseMapper->mapToProperty($sortClause, $product2);
                    $product2Property = $this->sortClauseMapper->mapToProperty($sortClause, $product1);
                }

                return is_string($product1Property)
                    ? strcmp($product1Property, $product2Property)
                    : $product1Property <=> $product2Property;
            }
        );

        return $products;
    }
}
