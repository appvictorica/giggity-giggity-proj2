<?php

namespace Amasty\SecondVictoriaModule\Plugin\Checkout\Cart;

use Magento\Catalog\Api\ProductRepositoryInterface;

class Add
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function beforeExecute(
        \Magento\Checkout\Controller\Cart\Add $subject
    ) {
        $sku = $subject->getRequest()->getParam('sku');
        if (!$subject->getRequest()->getParam('product')) {
            $product = $this->productRepository->get($sku);
            $subject->getRequest()->setParams(['product' => $product->getId()]);
        }
    }
}

