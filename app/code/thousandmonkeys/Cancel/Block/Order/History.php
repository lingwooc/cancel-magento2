<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace thousandmonkeys\Cancel\Block\Order;

/**
 * Sales order history block
 */
class History extends \Magento\Sales\Block\Order\History
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Sales\Model\Order\Config $orderConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Sales\Model\Order\Config $orderConfig,
        array $data = []
    ) {
        parent::__construct($context, $orderCollectionFactory, $customerSession, $orderConfig, $data);
    }

    /**
     * @param object $order
     * @return string
     */
    public function getCancelUrl($order)
    {
        return $this->getUrl('sales/order/cancel', ['order_id' => $order->getId()]);
    }
}