<?php
/**
 * Magento 2 OpenCampaigns Module
 * MVP Controller for serving the .well-known/opencampaigns.json endpoint
 */
namespace OpenCampaigns\Protocol\Controller\WellKnown;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Index implements HttpGetActionInterface
{
    protected $resultJsonFactory;
    protected $scopeConfig;

    public function __construct(
        JsonFactory $resultJsonFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Task 6.2: Exporting Catalog Price Rules into OpenCampaigns JSON
     * For this MVP boilerplate, we output the stored signed payload.
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        
        // Retrieve the locally signed JSON generated via Admin JS
        $payload = $this->scopeConfig->getValue('opencampaigns/general/signed_payload');

        if ($payload) {
            $data = json_decode($payload, true);
            return $result->setData($data);
        }

        // Fallback empty manifest
        return $result->setData([
            'version' => '1.0',
            'publisher' => [
                'name' => $this->scopeConfig->getValue('opencampaigns/general/brand_name'),
                'pubkey' => $this->scopeConfig->getValue('opencampaigns/general/pubkey')
            ],
            'campaigns' => [],
            'signature' => null
        ]);
    }
}
