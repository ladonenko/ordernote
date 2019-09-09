<?php
/**
 * Copyright © Ladonenko. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ladonenko\OrderNote\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XPATH_IS_SHOW_DEFAULT_NOTE = "ladonenko_extensions/ordernote/is_show_default_note";
    const XPATH_DEFAULT_NOTE = "ladonenko_extensions/ordernote/ntlm";
    const NOTE_FIELD_NAME = 'order_note';

    /**
     * @var Magento\Store\Model\StoreManagerInterface
     */
    // @codingStandardsIgnoreLine
    protected $storeManager;
    
    /**
     * @param Magento\Store\Model\StoreManagerInterface $storeManager
     */
    
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->storeManager = $storeManager;
    }

    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );
    }
    
    /**
     * @return store id
     */
    public function getStoreId()
    {
        return $this->storeManager->getStore()->getStoreId();
    }
    
    public function getDefaultNote()
    {
        return $this->getConfig(self::XPATH_DEFAULT_NOTE);
    }

    public function isEnabled()
    {
        $enabled = $this->getConfig(self::XPATH_IS_SHOW_DEFAULT_NOTE);
        if ($enabled) {
            return true;
        }
        return false;
    }
}
