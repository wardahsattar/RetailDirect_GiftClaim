<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace RetailDirect\GiftClaim\Model\ResourceModel\GiftClaim;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'giftclaim_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \RetailDirect\GiftClaim\Model\GiftClaim::class,
            \RetailDirect\GiftClaim\Model\ResourceModel\GiftClaim::class
        );
    }
}
