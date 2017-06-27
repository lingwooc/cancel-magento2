<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Block of links in Order view page
 */
namespace thousandmonkeys\Cancel\Block\Order\Info;

use Magento\Customer\Model\Context;

class Buttons extends \Magento\Sales\Block\Order\Info\Buttons
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\App\Http\Context $httpContext
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Http\Context $httpContext,
        array $data = []
    ) {
        parent::__construct($context, $registry, $httpContext, $data);
    }

    /**
     * Get url for canceling order
     *
     * @param \Magento\Sales\Model\Order $order
     * @return string
     */
    public function getCancelUrl($order)
    {
        if (!$this->httpContext->getValue(Context::CONTEXT_AUTH)) {
            return '';
        }
        return $this->getUrl('sales/order/cancel', ['order_id' => $order->getId()]);    
    }
}