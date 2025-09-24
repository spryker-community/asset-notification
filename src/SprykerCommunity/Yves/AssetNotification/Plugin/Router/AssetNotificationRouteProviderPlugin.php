<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Yves\AssetNotification\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class AssetNotificationRouteProviderPlugin extends AbstractRouteProviderPlugin
{
    /**
     * @var string
     */
    public const ROUTE_NAME_ASSET_NOTIFICATION_DOWNLOAD_ICS = 'customer/ssp-asset/download-notification-ics';

    /**
     * @inheritDoc
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = $this->addDownloadIcsRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    private function addDownloadIcsRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildGetRoute('/customer/ssp-asset/download-notification-ics', 'AssetNotification', 'Ics', 'downloadAction');

        $routeCollection->add(static::ROUTE_NAME_ASSET_NOTIFICATION_DOWNLOAD_ICS, $route);

        return $routeCollection;
    }
}
