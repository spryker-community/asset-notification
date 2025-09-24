<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\AssetNotification\Persistence;

use Generated\Shared\Transfer\SspAssetNotificationTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method AssetNotificationPersistenceFactory getFactory()
 */
class AssetNotificationEntityManager extends AbstractEntityManager implements AssetNotificationEntityManagerInterface
{
    public function saveAssetNotification(SspAssetNotificationTransfer $assetNotificationTransfer): SspAssetNotificationTransfer
    {
        $assetNotification = $this->getFactory()
            ->createSspAssetNotificationQuery()
            ->filterByIdAssetNotification($assetNotificationTransfer->getIdSspAssetNotification())
            ->findOneOrCreate();

        $assetNotification->setName((string)$assetNotificationTransfer->getNameOrFail());
        $assetNotification->setNotificationInterval($assetNotificationTransfer->getIntervalOrFail());
        $assetNotification->setFkSspAsset($assetNotificationTransfer->getFkSspAsset());
        $assetNotification->save();

        $assetNotificationTransfer = new SspAssetNotificationTransfer();
        return $assetNotificationTransfer;
    }
}
