<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\AssetNotification\Communication\Plugin\SspAssetManagement;

use Generated\Shared\Transfer\SspAssetCollectionTransfer;
use Generated\Shared\Transfer\SspAssetCriteriaTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use SprykerFeature\Zed\SelfServicePortal\Dependency\Plugin\SspAssetManagementExpanderPluginInterface;

/**
 * @method \SprykerCommunity\Zed\AssetNotification\Business\AssetNotificationBusinessFactory getBusinessFactory()
 */
class SspAssetNotificationSspAssetManagementExpanderPlugin extends AbstractPlugin implements SspAssetManagementExpanderPluginInterface
{
    /**
     * @inheritDoc
     */
    public function expand(
        SspAssetCollectionTransfer $sspAssetCollectionTransfer,
        SspAssetCriteriaTransfer $sspAssetCriteriaTransfer,
    ): SspAssetCollectionTransfer {
        return $this->getBusinessFactory()->createSspAssetExpander()->expand($sspAssetCollectionTransfer);
    }
}
