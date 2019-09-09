<?php
/**
 * Copyright © Ladonenko. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ladonenko\OrderNote\Plugin\Checkout\Model;

class ShippingInformationManagement
{
    // @codingStandardsIgnoreLine
    protected $quoteRepository;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    // @codingStandardsIgnoreLine
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $extAttributes = $addressInformation->getExtensionAttributes();
        $orderNote = htmlspecialchars($extAttributes->getOrderNote());
        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setOrderNote($orderNote);
    }
}