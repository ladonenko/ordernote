<?php
/**
 * Copyright © Ladonenko. All rights reserved.
 * See LICENSE.txt for license details.
 */
 
namespace Ladonenko\OrderNote\Setup;

use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Eav\Setup\EavSetupFactory;


class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * UpgradeData constructor.
     *
     * @param CustomerSetupFactory $customerSetupFactory
     * @param EavSetupFactory      $eavSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $setup->startSetup();
            $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
            $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'customer_note', [
                'type' => 'varchar',
                'label' => 'Add default note for orders',
                'input' => 'text',
                'source' => '',
                'required' => false,
                'visible' => true,
                'position' => 333,
                'system' => false,
                'backend' => ''
            ]);

            $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'customer_note')
                ->addData(['used_in_forms' => [
                    'adminhtml_customer',
                    'customer_account_edit'
                ]]);
            $attribute->save();
            $setup->endSetup();
        }
    }
}
