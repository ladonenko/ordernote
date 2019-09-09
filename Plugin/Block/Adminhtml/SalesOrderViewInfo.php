<?php
/**
 * Copyright © Ladonenko. All rights reserved.
 * See LICENSE.txt for license details.
 */
 
namespace Ladonenko\OrderNote\Plugin\Block\Adminhtml;

use Ladonenko\OrderNote\Model\Data\OrderNote;
use Magento\Sales\Block\Adminhtml\Order\View\Info as ViewInfo;

class SalesOrderViewInfo
{
    /**
     * @param ViewInfo $subject
     * @param string $result
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function afterToHtml(
        ViewInfo $subject,
        $result
    ) {
        $noteBlock = $subject->getLayout()
            ->getBlock('order_note');
            
        if ($noteBlock !== false) {
            $noteBlock->setOrderNote($subject->getOrder()
                ->getData(\Ladonenko\OrderNote\Helper\Data::NOTE_FIELD_NAME));
            $result = $result . $noteBlock->toHtml();
        }
        
        return $result;
    }
}
