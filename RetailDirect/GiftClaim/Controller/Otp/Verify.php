<?php

namespace RetailDirect\GiftClaim\Controller\Otp;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Session\SessionManagerInterface;
use RetailDirect\GiftClaim\Model\GiftClaimFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Psr\Log\LoggerInterface;

/**
 * Class Verify
 *
 * Handles the OTP verification process and updates gift claim status if OTP is valid.
 */
class Verify extends Action
{
    /** @var SessionManagerInterface */
    protected $sessionManager;

    /** @var GiftClaimFactory */
    protected $giftClaimFactory;

    /** @var ManagerInterface */
    protected $messageManager;

    /** @var DateTime */
    protected $dateTime;

    /** @var LoggerInterface */
    protected $logger;

    /**
     * Constructor
     *
     * @param Context $context
     * @param SessionManagerInterface $sessionManager
     * @param GiftClaimFactory $giftClaimFactory
     * @param ManagerInterface $messageManager
     * @param DateTime $dateTime
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        SessionManagerInterface $sessionManager,
        GiftClaimFactory $giftClaimFactory,
        ManagerInterface $messageManager,
	DateTime $dateTime,
	LoggerInterface $logger
    ) {
        $this->sessionManager = $sessionManager;
        $this->giftClaimFactory = $giftClaimFactory;
        $this->messageManager = $messageManager;
	$this->dateTime =  $dateTime;
    	$this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Execute OTP verification and gift claim update process.
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $inputOtp = $this->getRequest()->getParam('otp');
        $sessionOtp = $this->sessionManager->getOtp();
        $giftClaimData = $this->sessionManager->getGiftClaimData();

	if (!$inputOtp || !$sessionOtp || $inputOtp != $sessionOtp) {
            $this->messageManager->addErrorMessage(__('Invalid OTP. Please try again.'));
	    return $this->resultRedirectFactory->create()->setPath('retaildirect_giftclaim/otp/form');
	}

        try {
            $giftClaim = $this->giftClaimFactory->create()->load($giftClaimData['imei'], 'imei');

            if (!$giftClaim->getId()) {
                $this->messageManager->addErrorMessage(__('Error occurred. Please try again.'));
                return $this->resultRedirectFactory->create()->setPath('retaildirect_giftclaim/otp/form');
	    }

 	    $giftClaim->setName($giftClaimData['name'] ?? null);
            $giftClaim->setAddress($giftClaimData['address'] ?? null);
            $giftClaim->setEmail($giftClaimData['email'] ?? null);
            $giftClaim->setPhone($giftClaimData['phone'] ?? null);
            $giftClaim->setIsClaimed(true);
            $giftClaim->setClaimedDate( $this->dateTime->gmtDate('Y-m-d H:i:s'));
            $giftClaim->save();

            $this->sessionManager->unsOtp();
            $this->sessionManager->unsGiftClaimData();
            $this->messageManager->addSuccessMessage(__('OTP verified successfully!'));

	} catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An unexpected error occurred. Please try again later.'));
    	    $this->logger->addDebug('Error while OTP verification: '.$e->getMessage());
        }

        return $this->resultRedirectFactory->create()->setPath('retaildirect_giftclaim/index/index');
    }
}
