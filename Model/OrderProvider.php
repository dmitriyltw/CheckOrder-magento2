<?php

namespace Litvinov\CheckOrder\Model;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Exception\NotFoundException;

class OrderProvider
{
    /** @var OrderRepositoryInterface */
    protected $orderRepository;

    /** @var SearchCriteriaBuilder */
    protected $searchCriteriaBuilder;

    /**
     * Initialize dependencies.
     *
     * @param OrderRepositoryInterface $orderRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->orderRepository = $orderRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }
    /**
     * @param $fieldValue
     * Get orders with filter.
     * @return \Magento\Sales\Api\Data\OrderInterface[]
     */

    public function getOrderByIncrementId($fieldValue)
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('increment_id', $fieldValue, 'eq')->create();
        $orders = $this->orderRepository->getList($searchCriteria)->getItems();
//        if (!$orders){
//            throw new NotFoundException(__('Parameter is incorrect.'));
//        }
        return array_shift($orders);
    }
}