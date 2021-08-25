<?php

namespace Amasty\SecondVictoriaModule\Plugin\Block;

class Index
{
    public function afterGetFormAction(
        \Amasty\VictoriaModule\Block\Index $subject,
        $result
    ) {
        return $result = $subject->getUrl('checkout/cart/add');
    }
}

