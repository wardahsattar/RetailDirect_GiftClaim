<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace RetailDirect\GiftClaim\Model;

use Magento\Framework\Model\AbstractModel;
use RetailDirect\GiftClaim\Api\Data\GiftClaimInterface;

class GiftClaim extends AbstractModel implements GiftClaimInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\RetailDirect\GiftClaim\Model\ResourceModel\GiftClaim::class);
    }

    /**
     * @inheritDoc
     */
    public function getGiftclaimId()
    {
        return $this->getData(self::GIFTCLAIM_ID);
    }

    /**
     * @inheritDoc
     */
    public function setGiftclaimId($giftclaimId)
    {
        return $this->setData(self::GIFTCLAIM_ID, $giftclaimId);
    }

    /**
     * @inheritDoc
     */
    public function getImei()
    {
        return $this->getData(self::IMEI);
    }

    /**
     * @inheritDoc
     */
    public function setImei($imei)
    {
        return $this->setData(self::IMEI, $imei);
    }

    /**
     * @inheritDoc
     */
    public function getIsClaimed()
    {
        return $this->getData(self::IS_CLAIMED);
    }

    /**
     * @inheritDoc
     */
    public function setIsClaimed($isClaimed)
    {
        return $this->setData(self::IS_CLAIMED, $isClaimed);
    }

    /**
     * @inheritDoc
     */
    public function getClaimDate()
    {
        return $this->getData(self::CLAIM_DATE);
    }

    /**
     * @inheritDoc
     */
    public function setClaimDate($claimDate)
    {
        return $this->setData(self::CLAIM_DATE, $claimDate);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    /**
     * @inheritDoc
     */
    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }

    /**
     * @inheritDoc
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheritDoc
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheritDoc
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * @inheritDoc
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }

    /**
     * @inheritDoc
     */
    public function getTrackingnumber()
    {
        return $this->getData(self::TRACKINGNUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setTrackingnumber($trackingnumber)
    {
        return $this->setData(self::TRACKINGNUMBER, $trackingnumber);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
