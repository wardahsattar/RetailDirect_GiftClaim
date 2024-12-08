<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace RetailDirect\GiftClaim\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface GiftClaimRepositoryInterface
{

    /**
     * Save GiftClaim
     * @param \RetailDirect\GiftClaim\Api\Data\GiftClaimInterface $giftClaim
     * @return \RetailDirect\GiftClaim\Api\Data\GiftClaimInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \RetailDirect\GiftClaim\Api\Data\GiftClaimInterface $giftClaim
    );

    /**
     * Retrieve GiftClaim
     * @param string $giftclaimId
     * @return \RetailDirect\GiftClaim\Api\Data\GiftClaimInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($giftclaimId);

    /**
     * Retrieve GiftClaim matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \RetailDirect\GiftClaim\Api\Data\GiftClaimSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete GiftClaim
     * @param \RetailDirect\GiftClaim\Api\Data\GiftClaimInterface $giftClaim
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \RetailDirect\GiftClaim\Api\Data\GiftClaimInterface $giftClaim
    );

    /**
     * Delete GiftClaim by ID
     * @param string $giftclaimId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($giftclaimId);
}
