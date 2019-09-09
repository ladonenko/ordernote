<?php
/**
 * Copyright © Ladonenko. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ladonenko\OrderNote\Model\Adminhtml\Config\Source;

use \Magento\Framework\Data\OptionSourceInterface;

class DefaultNotes implements OptionSourceInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' =>  __('Leave at the doorstep'), 'label' => __('Leave at the doorstep')],
            ['value' =>  __('Leave in the backyard'), 'label' => __('Leave in the backyard')],
            ['value' =>  __('Ring longer'), 'label' => __('Ring longer')]
        ];
    }
}
