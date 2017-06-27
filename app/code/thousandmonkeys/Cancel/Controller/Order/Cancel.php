<?php
/**
 * Author: Khoa TruongDinh https://magento.stackexchange.com/questions/133003/
 */


namespace thousandmonkeys\Cancel\Controller\Order;

use Magento\Sales\Controller\OrderInterface;
use Magento\Framework\App\Action\Context;
use Magento\Sales\Controller\AbstractController\OrderLoaderInterface;
use Magento\Framework\Registry;

class Cancel extends \Magento\Framework\App\Action\Action implements OrderInterface
{
    /**
     * @var \Magento\Sales\Api\OrderManagementInterface
     */
    protected $_order;

    /**
     * @var \Magento\Sales\Controller\AbstractController\OrderLoaderInterface
     */
    protected $orderLoader;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * Cancel constructor.
     * @param \Magento\Sales\Api\OrderManagementInterface $orderManagementInterface
     * @param Context $context
     */
    public function __construct(
        \Magento\Sales\Api\OrderManagementInterface $orderManagementInterface,
        OrderLoaderInterface $orderLoader,
        Registry $registry,
        Context $context
    )
    {
        $this->_order = $orderManagementInterface;
        $this->orderLoader = $orderLoader;
        $this->registry = $registry;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->orderLoader->load($this->_request);
        if ($result instanceof \Magento\Framework\Controller\ResultInterface) {
            return $result;
        }
        $order = $this->registry->registry('current_order');
        //$orderId = 1;
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            $this->_order->cancel($order->getId());

        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            if ($this->_objectManager->get('Magento\Checkout\Model\Session')->getUseNotice(true)) {
                $this->messageManager->addNotice($e->getMessage());
            } else {
                $this->messageManager->addError($e->getMessage());
            }
        }
        return $resultRedirect->setPath('*/*/history');
    }
}