<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\AssetNotification\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerCommunity\Zed\AssetNotification\Business\Expander\SspAssetExpander;

/**
 * @method \SprykerCommunity\Zed\AssetNotification\Persistence\AssetNotificationRepository getRepository()
 * @method \SprykerCommunity\Zed\AssetNotification\Persistence\AssetNotificationPersistenceFactory getPersistenceFactory()
 */
class AssetNotificationBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerCommunity\Zed\AssetNotification\Business\Expander\SspAssetExpander
     */
    public function createSspAssetExpander(): SspAssetExpander
    {
        return new SspAssetExpander($this->getRepository());
    }
}
