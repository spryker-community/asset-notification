<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\AssetNotification\Business\Expander;

use Generated\Shared\Transfer\SspAssetCollectionTransfer;
use Generated\Shared\Transfer\SspAssetNotificationTransfer;
use SprykerCommunity\Zed\AssetNotification\Persistence\AssetNotificationRepository;

class SspAssetExpander
{
    /**
     * @param \SprykerCommunity\Zed\AssetNotification\Persistence\AssetNotificationRepository $assetNotificationRepository
     */
    public function __construct(protected AssetNotificationRepository $assetNotificationRepository)
    {
    }

    /**
     * @param \Generated\Shared\Transfer\SspAssetCollectionTransfer $sspAssetCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\SspAssetCollectionTransfer
     */
    public function expand(SspAssetCollectionTransfer $sspAssetCollectionTransfer): SspAssetCollectionTransfer
    {
        foreach ($sspAssetCollectionTransfer->getSspAssets() as $sspAssetTransfer) {
            $assetNotificationCollection = $this->assetNotificationRepository->getAssetNotificationsByAsset($sspAssetTransfer);
            foreach ($assetNotificationCollection as $assetNotificationCollectionItem) {
                $assetNotificationTransfer = (new SspAssetNotificationTransfer())
                    ->fromArray($assetNotificationCollectionItem->toArray(), true);

                $sspAssetTransfer->addSspAssetNotification($assetNotificationTransfer);
            }
        }

        return $sspAssetCollectionTransfer;
    }
}
