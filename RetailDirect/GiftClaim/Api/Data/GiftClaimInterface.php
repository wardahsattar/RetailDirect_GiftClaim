<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace RetailDirect\GiftClaim\Api\Data;

interface GiftClaimInterface
{

    const CLAIM_DATE = 'claim_date';
    const NAME = 'name';
    const EMAIL = 'email';
    const IS_CLAIMED = 'is_claimed';
    const GIFTCLAIM_ID = 'giftclaim_id';
    const TRACKINGNUMBER = 'trackingnumber';
    const IMEI = 'imei';
    const PHONE = 'phone';
    const ADDRESS = 'Address';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Get giftclaim_id
     * @return string|null
     */
    public function getGiftclaimId();

    /**
     * Set giftclaim_id
     * @param string $giftclaimId
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setGiftclaimId($giftclaimId);

    /**
     * Get imei
     * @return string|null
     */
    public function getImei();

    /**
     * Set imei
     * @param string $imei
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setImei($imei);

    /**
     * Get is_claimed
     * @return string|null
     */
    public function getIsClaimed();

    /**
     * Set is_claimed
     * @param string $isClaimed
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setIsClaimed($isClaimed);

    /**
     * Get claim_date
     * @return string|null
     */
    public function getClaimDate();

    /**
     * Set claim_date
     * @param string $claimDate
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setClaimDate($claimDate);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setName($name);

    /**
     * Get Address
     * @return string|null
     */
    public function getAddress();

    /**
     * Set Address
     * @param string $address
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setAddress($address);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setEmail($email);

    /**
     * Get phone
     * @return string|null
     */
    public function getPhone();

    /**
     * Set phone
     * @param string $phone
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setPhone($phone);

    /**
     * Get trackingnumber
     * @return string|null
     */
    public function getTrackingnumber();

    /**
     * Set trackingnumber
     * @param string $trackingnumber
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setTrackingnumber($trackingnumber);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \RetailDirect\GiftClaim\GiftClaim\Api\Data\GiftClaimInterface
     */
    public function setUpdatedAt($updatedAt);
}
