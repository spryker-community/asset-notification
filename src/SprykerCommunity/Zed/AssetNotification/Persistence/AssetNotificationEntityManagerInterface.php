<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\AssetNotification\Persistence;

use Generated\Shared\Transfer\SspAssetNotificationTransfer;

interface AssetNotificationEntityManagerInterface
{
    /**
     * Specification:
     * - Creates an asset notification
     *
     * @param \Generated\Shared\Transfer\SspAssetNotificationTransfer $assetNotificationTransfer
     *
     * @return \Generated\Shared\Transfer\SspAssetNotificationTransfer
     */
    public function saveAssetNotification(SspAssetNotificationTransfer $assetNotificationTransfer): SspAssetNotificationTransfer;
}


