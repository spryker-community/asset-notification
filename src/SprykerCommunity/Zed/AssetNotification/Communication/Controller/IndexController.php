<?php

namespace SprykerCommunity\Zed\AssetNotification\Communication\Controller;

use Generated\Shared\Transfer\SspAssetNotificationTransfer;
use Spryker\Yves\Kernel\View\View;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use SprykerCommunity\Zed\AssetNotification\Communication\AssetNotificationCommunicationFactory;
use SprykerCommunity\Zed\AssetNotification\Persistence\AssetNotificationEntityManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method AssetNotificationCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function saveAction(Request $request): RedirectResponse
    {
        $assetId = $request->get('ssp_asset_id');
        $entityManager = (new AssetNotificationEntityManager())
            ->saveAssetNotification(
                (new SspAssetNotificationTransfer())
                ->setName($request->get('name'))
                ->setInterval($request->get('service_interval'))
                ->setFkSspAsset($assetId)
            );

        return $this->redirectResponse('/self-service-portal/update-asset?id-ssp-asset=' . $assetId);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<mixed>
     */
    public function indexAction(Request $request): array
    {
        $sspServiceTable = $this
            ->getFactory()
            ->createAssetSspServiceTable($request->attributes->get('reference'));

        return ['sspServiceTable' => $sspServiceTable->render()];
    }
}
