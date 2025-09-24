<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerCommunity\Yves\AssetNotification\Controller;

use DateInterval;
use DateTime;
use Generated\Shared\Transfer\SspAssetConditionsTransfer;
use Generated\Shared\Transfer\SspAssetCriteriaTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @method \SprykerCommunity\Yves\AssetNotification\AssetNotificationFactory getFactory()
 */
class IcsController extends AbstractController
{
    use \Spryker\Yves\Kernel\PermissionAwareTrait;

    /**
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function downloadAction(Request $request): Response
    {
        $sspAssetReference = (string)$request->query->get('reference');
        if (!$sspAssetReference) {
            throw new NotFoundHttpException('Asset reference not found');
        }

        $sspAssetCriteriaTransfer = (new SspAssetCriteriaTransfer())
            ->setSspAssetConditions(
                (new SspAssetConditionsTransfer())
                    ->addReference($sspAssetReference),
            );

        $sspAssetCollectionTransfer = $this->getFactory()->getSelfServicePortalClient()->getSspAssetCollection($sspAssetCriteriaTransfer);

        if ($sspAssetCollectionTransfer->getSspAssets()->count() === 0) {
            return new Response('', 404);
        }

        /** @var \Generated\Shared\Transfer\SspAssetTransfer $sspAssetTransfer */
        $sspAssetTransfer = $sspAssetCollectionTransfer->getSspAssets()[0];

        $icalBody = "BEGIN:VCALENDAR\nVERSION:2.0\nPRODID:SprykerServicePortaAssetNotificaions\n";

        foreach ($sspAssetTransfer->getSspAssetNotifications() as $sspAssetNotificationTransfer) {
            $icalBody .= 'BEGIN:VEVENT\n';
            $icalBody .= 'UID:' . sha1((string)$sspAssetNotificationTransfer->getIdSspAssetNotification()) . "\n";
            $icalBody .= 'DTSTAMP:' . gmdate('Ymd\THis\Z', time()) . "\n";

            $interval = new DateInterval($sspAssetNotificationTransfer->getInterval());
            $startDate = new DateTime($sspAssetTransfer->getCreatedDate());
            $startDate->add($interval);
            $icalBody .= 'DTSTART:' . $startDate->format('Ymd\THis\Z') . "\n";

            $icalBody .= 'END:VEVENT';
        }

        return new Response($icalBody, 200, ['Content-Type' => 'text/calendar']);
    }
}
