<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace RetailDirect\GiftClaim\Api\Data;

interface GiftClaimSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get GiftClaim list.
     * @return \RetailDirect\GiftClaim\Api\Data\GiftClaimInterface[]
     */
    public function getItems();

    /**
     * Set imei list.
     * @param \RetailDirect\GiftClaim\Api\Data\GiftClaimInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
