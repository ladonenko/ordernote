<?php
/**
 * Copyright © Ladonenko. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Ladonenko\OrderNote\Block\Customer;

use Psr\Log\LoggerInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
/**
 * Customer Additional Info block
 *
 */
class AdditionalInfo extends \Magento\Customer\Block\Account\Dashboard
{
    private $logger;
}