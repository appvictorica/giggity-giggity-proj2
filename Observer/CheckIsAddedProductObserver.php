<?php

namespace Amasty\SecondVictoriaModule\Observer;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class CheckIsAddedProductObserver implements ObserverInterface
{
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;
    /**
     * @var Session
     */
    private $session;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        Session                    $session,
        ScopeConfigInterface       $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->productRepository = $productRepository;
        $this->session = $session;
    }

    public function execute(Observer $observer)
    {
        $promoSku = $this->scopeConfig->getValue('secondvictoriamod_config/general/promo_sku');
        $forSku = $this->scopeConfig->getValue('secondvictoriamod_config/general/for_sku');
        $forSkuArray = explode(",", str_replace(" ", "", $forSku));
        /** @var \Magento\Catalog\Model\Product $observerProduct */
        $observerProduct = $observer->getEvent()->getProduct();
        if (in_array($observerProduct->getSku(), $forSkuArray)) {
            $quote = $this->session->getQuote();
            $product = $this->productRepository->get($promoSku);
            $quote->addProduct($product, 1);
            $quote->save();
        }
    }
}
