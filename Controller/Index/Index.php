<?php

namespace Litvinov\CheckOrder\Controller\Index;
use Magento\Framework\App\Action\Action;
use Litvinov\CheckOrder\Model\OrderProvider;

class Index extends Action
{
    protected $resultPageFactory;
    private $_registry;
    private $_orderProvider;

    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magento\Framework\Registry $registry,
                                OrderProvider $orderProvider,
                                \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_registry = $registry;
        $this->_orderProvider = $orderProvider;
        $this->resultPageFactory=$resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $incrementId = $this->getRequest()->getParam('incrementId');
        $order = $this->_orderProvider->getOrderByIncrementId($incrementId);
        $this->_registry->register('current_order',$order);
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;

    }
    
}
