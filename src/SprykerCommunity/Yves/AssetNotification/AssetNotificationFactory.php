<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Yves\AssetNotification;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerFeature\Client\SelfServicePortal\SelfServicePortalClient;
use SprykerFeature\Client\SelfServicePortal\SelfServicePortalClientInterface;

class AssetNotificationFactory extends AbstractFactory
{
 /**
  * @return \SprykerFeature\Client\SelfServicePortal\SelfServicePortalClientInterface
  */
    public function getSelfServicePortalClient(): SelfServicePortalClientInterface
    {
        return new SelfServicePortalClient();
    }
}
