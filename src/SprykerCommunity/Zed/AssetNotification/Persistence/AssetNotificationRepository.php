<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\AssetNotification\Persistence;

use Generated\Shared\Transfer\SspAssetTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerCommunity\Zed\AssetNotification\Persistence\AssetNotificationPersistenceFactory getFactory()
 */
class AssetNotificationRepository extends AbstractRepository
{
    /**
     * @param \Generated\Shared\Transfer\SspAssetTransfer $assetTransfer
     *
     * @return \Propel\Runtime\Collection\ObjectCollection
     */
    public function getAssetNotificationsByAsset(SspAssetTransfer $assetTransfer): ObjectCollection
    {
        return $this->getFactory()->createSspAssetNotificationQuery()
            ->filterByFkSspAsset($assetTransfer->getIdSspAsset())
            ->find();
    }
}
