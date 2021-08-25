<?php

namespace Amasty\SecondVictoriaModule\Controller\Index;

use Amasty\VictoriaModule\Controller\Index\Index as VictoriaController;
use Amasty\VictoriaModule\Model\Config\ConfigProvider;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;

class Index extends VictoriaController
{
    /**
     * @var Context
     */
    private $context;
    /**
     * @var Session
     */
    private $customerSession;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var ConfigProvider
     */
    private $configProvider;

    public function __construct(
        Context               $context,
        PageFactory           $pageFactory,
        Session               $customerSession,
        StoreManagerInterface $storeManager,
        ConfigProvider        $configProvider
    ) {
        parent::__construct($context, $pageFactory, $storeManager, $configProvider);
        $this->context = $context;
        $this->pageFactory = $pageFactory;
        $this->customerSession = $customerSession;
        $this->storeManager = $storeManager;
        $this->configProvider = $configProvider;
    }

    public function execute()
    {
       if ($this->customerSession->authenticate()) {
           if ($this->configProvider->getIsEnabled($this->storeManager->getStore()->getId())) {
               return $this->pageFactory->create();
           } else {
               die("Victoria Module Disabled");
           }
       }
    }
}
