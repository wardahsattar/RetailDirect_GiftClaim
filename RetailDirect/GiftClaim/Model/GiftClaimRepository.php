<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace RetailDirect\GiftClaim\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use RetailDirect\GiftClaim\Api\Data\GiftClaimInterface;
use RetailDirect\GiftClaim\Api\Data\GiftClaimInterfaceFactory;
use RetailDirect\GiftClaim\Api\Data\GiftClaimSearchResultsInterfaceFactory;
use RetailDirect\GiftClaim\Api\GiftClaimRepositoryInterface;
use RetailDirect\GiftClaim\Model\ResourceModel\GiftClaim as ResourceGiftClaim;
use RetailDirect\GiftClaim\Model\ResourceModel\GiftClaim\CollectionFactory as GiftClaimCollectionFactory;

class GiftClaimRepository implements GiftClaimRepositoryInterface
{

    /**
     * @var ResourceGiftClaim
     */
    protected $resource;

    /**
     * @var GiftClaimCollectionFactory
     */
    protected $giftClaimCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var GiftClaimInterfaceFactory
     */
    protected $giftClaimFactory;

    /**
     * @var GiftClaim
     */
    protected $searchResultsFactory;


    /**
     * @param ResourceGiftClaim $resource
     * @param GiftClaimInterfaceFactory $giftClaimFactory
     * @param GiftClaimCollectionFactory $giftClaimCollectionFactory
     * @param GiftClaimSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceGiftClaim $resource,
        GiftClaimInterfaceFactory $giftClaimFactory,
        GiftClaimCollectionFactory $giftClaimCollectionFactory,
        GiftClaimSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->giftClaimFactory = $giftClaimFactory;
        $this->giftClaimCollectionFactory = $giftClaimCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(GiftClaimInterface $giftClaim)
    {
        try {
            $this->resource->save($giftClaim);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the giftClaim: %1',
                $exception->getMessage()
            ));
        }
        return $giftClaim;
    }

    /**
     * @inheritDoc
     */
    public function get($giftClaimId)
    {
        $giftClaim = $this->giftClaimFactory->create();
        $this->resource->load($giftClaim, $giftClaimId);
        if (!$giftClaim->getId()) {
            throw new NoSuchEntityException(__('GiftClaim with id "%1" does not exist.', $giftClaimId));
        }
        return $giftClaim;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->giftClaimCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(GiftClaimInterface $giftClaim)
    {
        try {
            $giftClaimModel = $this->giftClaimFactory->create();
            $this->resource->load($giftClaimModel, $giftClaim->getGiftclaimId());
            $this->resource->delete($giftClaimModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the GiftClaim: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($giftClaimId)
    {
        return $this->delete($this->get($giftClaimId));
    }
}
