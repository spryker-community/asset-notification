<?php

use Orm\Zed\AssetNotification\Persistence\Map\SpySspAssetNotificationTableMap;
use Orm\Zed\AssetNotification\Persistence\SpySspAssetNotificationQuery;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class SspAssetNotificationTable extends AbstractTable
{
    public function __construct(
        protected SpySspAssetNotificationQuery $spySspAssetNotificationQuery,
    ) {
    }

    protected function configure(TableConfiguration $config)
    {
        $config = $this->setHeader($config);

        $config->setSearchable([
            SpySspAssetNotificationTableMap::COL_NAME,
            SpySspAssetNotificationTableMap::COL_NOTIFICATION_INTERVAL,
        ]);

        $config->setRawColumns([
            SpySspAssetNotificationTableMap::COL_NAME,
            SpySspAssetNotificationTableMap::COL_NOTIFICATION_INTERVAL,
        ]);

        return $config;
    }

    protected function setHeader(TableConfiguration $config): TableConfiguration
    {
        $baseData = [
            'name' => 'Name',
            'interval' => 'Interval',
        ];

        $config->setHeader($baseData);

        return $config;
    }

    protected function prepareData(TableConfiguration $config)
    {
        $queryResults = $this->runQuery($this->prepareQuery(), $config);
        $results = [];

        foreach ($queryResults as $item) {
            $results[] = $this->formatRow($item);
        }

        return $results;
    }

    protected function prepareQuery(): SpySspAssetNotificationQuery
    {
        $query = $this->spySspAssetNotificationQuery;

        $query
            ->select([
                SpySspAssetNotificationTableMap::COL_NAME,
                SpySspAssetNotificationTableMap::COL_NOTIFICATION_INTERVAL,
            ]);

        return $query;
    }

    /**
     * @param array<string, mixed> $item
     *
     * @return array<string, mixed>
     */
    protected function formatRow(array $item): array
    {
        $rowData = [
            SpySspAssetNotificationTableMap::COL_NAME => $item[SpySspAssetNotificationTableMap::COL_NAME],
            SpySspAssetNotificationTableMap::COL_NOTIFICATION_INTERVAL => $item[SpySspAssetNotificationTableMap::COL_NOTIFICATION_INTERVAL],
        ];

        return $rowData;
    }
}
