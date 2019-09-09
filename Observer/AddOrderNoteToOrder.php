<?php
/**
 * Copyright © Ladonenko. All rights reserved.
 * See LICENSE.txt for license details.
 */
 
namespace Ladonenko\OrderNote\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Ladonenko\OrderNote\Model\Data\OrderNote;

class AddOrderNoteToOrder implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        /** @var $order \Magento\Sales\Model\Order **/

        $quote = $observer->getEvent()->getQuote();
        /** @var $quote \Magento\Quote\Model\Quote **/

        $order->setData(
            \Ladonenko\OrderNote\Helper\Data::NOTE_FIELD_NAME,
            $quote->getData(\Ladonenko\OrderNote\Helper\Data::NOTE_FIELD_NAME)
        );
    }
}
