<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Zed\AssetNotification\Persistence;

use Orm\Zed\AssetNotification\Persistence\SpySspAssetNotificationQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class AssetNotificationPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\AssetNotification\Persistence\SpySspAssetNotificationQuery
     */
    public function createSspAssetNotificationQuery(): SpySspAssetNotificationQuery
    {
        return SpySspAssetNotificationQuery::create();
    }
}
