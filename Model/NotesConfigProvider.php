<?php
/**
 * Copyright © Ladonenko. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ladonenko\OrderNote\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class NotesConfigProvider implements ConfigProviderInterface
{

    /**
     * @var \Ladonenko\OrderNote\Helper\Data
     */
    protected $helper;

    /**
     * @var \Magento\Customer\Api\Data\CustomerInterface
     */
    protected $customer;

    /**
     * @var \Magento\Customer\Model\CustomerRegistry
     */
    protected $customerRegistry;

    /**
     * @var \Magento\Customer\Model\SessionFactory
     */
    protected $customerSessionFactory;


    /**
     * @param \Ladonenko\OrderNote\Helper\Data $dataHelper
     */
    public function __construct(
        \Ladonenko\OrderNote\Helper\Data $dataHelper,
        \Magento\Customer\Model\CustomerRegistry $customerRegistry,
        \Magento\Customer\Model\SessionFactory $customerSessionFactory
    ) {
        $this->helper = $dataHelper;
         $this->customerRegistry = $customerRegistry;
        $this->customerSessionFactory = $customerSessionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $isEnable = $this->helper->isEnabled();
        $defaultNote = $this->helper->getDefaultNote();

        $orderNote = '';
        if(!is_null($this->getCustomer())) {
            $customreNote = $this->getCustomer()->getCustomerNote();
            if(!is_null($customreNote)) {
                $orderNote = $customreNote;
            } else {
                if($isEnable && $defaultNote) {
                    $orderNote = $defaultNote;
                }
            }
        } elseif($isEnable && $defaultNote) {
            $orderNote = $defaultNote;
        }


        $config = [
            'shipping' => [
                'orderNote' => $orderNote
            ]
        ];

        return $config;
    }

    /**
     * Return logged in customer model
     *
     * @return \Magento\Customer\Model\Customer|null
     */
    public function getCustomer()
    {
        if (!$this->customer) {
            /** @var \Magento\Customer\Model\Session $customer */
            $customer = $this->customerSessionFactory->create();
            if ($customer->getCustomer() && $customer->getCustomer()->getId()) {
                $this->customer = $this->customerRegistry->retrieve($customer->getCustomer()->getId());
            } else {
                return null;
            }
        }

        return $this->customer;
    }
}
