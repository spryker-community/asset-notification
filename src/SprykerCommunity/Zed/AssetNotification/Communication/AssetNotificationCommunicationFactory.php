<?php

namespace SprykerCommunity\Zed\AssetNotification\Communication;

use Orm\Zed\AssetNotification\Persistence\SpySspAssetNotificationQuery;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use SprykerFeature\Zed\SelfServicePortal\Communication\Asset\Table\SspServiceTable;
use SspAssetNotificationTable;

class AssetNotificationCommunicationFactory extends AbstractCommunicationFactory
{
    public function createAssetSspServiceTable(string $assetReference): SspAssetNotificationTable
    {
        return new SspAssetNotificationTable(
            $this->createSspAssetNotificationQuery(),
        );
    }

    /**
     * @return \Orm\Zed\AssetNotification\Persistence\SpySspAssetNotificationQuery
     */
    public function createSspAssetNotificationQuery(): SpySspAssetNotificationQuery
    {
        return SpySspAssetNotificationQuery::create();
    }
}
