<?php

namespace SprykerCommunity\Zed\AssetNotification\Communication\Controller;

use Generated\Shared\Transfer\SspAssetNotificationTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use SprykerCommunity\Zed\AssetNotification\Persistence\AssetNotificationEntityManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function saveAction(Request $request): RedirectResponse
    {
        $entityManager = (new AssetNotificationEntityManager())
            ->saveAssetNotification(
                (new SspAssetNotificationTransfer())
                ->setName($request->get('name'))
                ->setInterval($request->get('service_interval'))
                ->setFkSspAsset(1)
            );

        return $this->redirectResponse('/self-service-portal/update-asset?id-ssp-asset=4');
    }
}
