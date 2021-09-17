<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductRelationStorage\Dependency\Client;

class ProductRelationStorageToProductStorageClientAdapter implements ProductRelationStorageToProductStorageClientInterface
{
    /**
     * @var \Spryker\Client\ProductStorage\ProductStorageClientInterface
     */
    protected $productStorageClient;

    /**
     * @param \Spryker\Client\ProductStorage\ProductStorageClientInterface $productStorageClient
     */
    public function __construct($productStorageClient)
    {
        $this->productStorageClient = $productStorageClient;
    }

    /**
     * @param int $idProductAbstract
     * @param string $localeName
     *
     * @return array
     */
    public function getProductAbstractStorageData($idProductAbstract, $localeName)
    {
        return $this->productStorageClient->getProductAbstractStorageData($idProductAbstract, $localeName);
    }

    /**
     * The method check for `method_exists` is for BC for supporting old majors of `ProductStorage` module.
     *
     * @param array<int> $productAbstractIds
     * @param string $localeName
     *
     * @return array
     */
    public function getBulkProductAbstractStorageDataByProductAbstractIdsAndLocaleName(array $productAbstractIds, string $localeName): array
    {
        if (!method_exists($this->productStorageClient, 'getBulkProductAbstractStorageDataByProductAbstractIdsAndLocaleName')) {
            return $this->getProductAbstractStorageDataByProductAbstractIdsAndLocaleName($productAbstractIds, $localeName);
        }

        return $this->productStorageClient->getBulkProductAbstractStorageDataByProductAbstractIdsAndLocaleName($productAbstractIds, $localeName);
    }

    /**
     * @deprecated Use {@link \Spryker\Client\ProductRelationStorage\Dependency\Client\ProductRelationStorageToProductStorageClientAdapter::getBulkProductAbstractStorageDataByProductAbstractIdsForLocaleNameAndStore()} instead.
     *
     * @see \Spryker\Client\ProductRelationStorage\Dependency\Client\ProductRelationStorageToProductStorageClientAdapter::getBulkProductAbstractStorageDataByProductAbstractIdsForLocaleNameAndStore()
     *
     * @param array<int> $productAbstractIds
     * @param string $localeName
     *
     * @return array
     */
    protected function getProductAbstractStorageDataByProductAbstractIdsAndLocaleName(array $productAbstractIds, string $localeName): array
    {
        $productAbstractStorageData = [];
        foreach ($productAbstractIds as $productAbstractId) {
            $productAbstractStorageData[] = $this->productStorageClient->getProductAbstractStorageData($productAbstractId, $localeName);
        }

        return $productAbstractStorageData;
    }

    /**
     * @param array<int> $productAbstractIds
     * @param string $localeName
     * @param string $storeName
     *
     * @return array
     */
    public function getBulkProductAbstractStorageDataByProductAbstractIdsForLocaleNameAndStore(
        array $productAbstractIds,
        string $localeName,
        string $storeName
    ): array {
        if (method_exists($this->productStorageClient, 'getBulkProductAbstractStorageDataByProductAbstractIdsForLocaleNameAndStore')) {
            return $this->productStorageClient->getBulkProductAbstractStorageDataByProductAbstractIdsForLocaleNameAndStore($productAbstractIds, $localeName, $storeName);
        }

        return $this->getBulkProductAbstractStorageDataByProductAbstractIdsAndLocaleName($productAbstractIds, $localeName);
    }
}
