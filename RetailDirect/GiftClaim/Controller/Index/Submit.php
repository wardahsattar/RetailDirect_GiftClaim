<?php
namespace RetailDirect\GiftClaim\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use RetailDirect\GiftClaim\Model\GiftClaimFactory;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Submit
 *
 * Handles the gift claim submission process, including OTP generation and email sending.
 */
class Submit extends Action
{
    /** Path for the gift claim form. */
    const GIFT_CLAIM_FROM_PATH = 'retaildirect_giftclaim/index/index';

    /** Path for the OTP verification form. */
    const OTP_VERIFICATION_FORM_PATH = 'retaildirect_giftclaim/otp/form';

    /** @var RequestInterface */
    protected RequestInterface $request;

    /** @var GiftClaimFactory */
    protected $giftClaimFactory;

    /** @var DateTime */
    protected $dateTime;

    /** @var ManagerInterface */
    protected $messageManager;

    /** @var RedirectFactory */
    protected $redirectFactory;

    /** @var SessionManagerInterface */
    protected $sessionManager;

    /** @var TransportBuilder */
    protected $transportBuilder;

    /** @var StoreManagerInterface */
    protected $storeManager;

    /** @var LoggerInterface */
    protected $logger;


    /**
     * Constructor
     *
     * @param Context $context
     * @param RequestInterface $request
     * @param GiftClaimFactory $giftClaimFactory
     * @param DateTime $dateTime
     * @param ManagerInterface $messageManager
     * @param RedirectFactory $redirectFactory
     * @param SessionManagerInterface $sessionManager
     * @param TransportBuilder $transportBuilder
     * @param StoreManagerInterface $storeManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        GiftClaimFactory $giftClaimFactory,
        DateTime $dateTime,
        ManagerInterface $messageManager,
        RedirectFactory $redirectFactory,
        SessionManagerInterface $sessionManager,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->request = $request;
        $this->giftClaimFactory = $giftClaimFactory;
        $this->dateTime = $dateTime;
        $this->messageManager = $messageManager;
        $this->redirectFactory = $redirectFactory;
        $this->sessionManager = $sessionManager;
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
	$this->logger = $logger;
    }

    /**
     * Execute the gift claim submission process.
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $params = $this->request->getPostValue();
        try {
            $giftClaim = $this->giftClaimFactory->create()->load($params['imei'], 'imei');

            if (!$giftClaim->getId() || $giftClaim->getIsClaimed()) {
                $this->messageManager->addErrorMessage('This gift does not exist or has already been claimed.');
                return $this->redirect(self::GIFT_CLAIM_FROM_PATH);
            }

            $otp = rand(100000, 999999);
            $this->sessionManager->setOtp($otp);
            $this->sessionManager->setGiftClaimData($params);

            $this->sendOtpEmail($params['email'], $otp);

            return $this->redirect(self::OTP_VERIFICATION_FORM_PATH);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An unexpected error occurred. Please try again later.'));
            $this->logger->addDebug('Error in OTP generation: '. $e->geMessage());
        }

        return $this->redirect(self::GIFT_CLAIM_FROM_PATH);
    }

    /**
     * Redirect to the specified path.
     *
     * @param string $path
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    private function redirect($path)
    {
        return $this->redirectFactory->create()->setPath($path);
    }

    /**
     * Send an OTP email to the user.
     *
     * @param string $email
     * @param int $otp
     * @return void
     */
    private function sendOtpEmail($email, $otp)
    {
        try {
            $store = $this->storeManager->getStore();
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('otp_email_template')
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => $store->getId(),
                    ]
                )
                ->setTemplateVars(['otp' => $otp])
                ->setFrom(['email' => 'sender@example.com', 'name' => 'Sender Name'])
                ->addTo($email)
                ->getTransport();

            $transport->sendMessage();
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Unable to send OTP email.'));
            $this->logger->addDebug('Error while sending OTP email: '. $e->geMessage());
        }
    }
}
