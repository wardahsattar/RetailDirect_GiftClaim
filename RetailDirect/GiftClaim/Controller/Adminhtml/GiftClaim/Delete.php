<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace RetailDirect\GiftClaim\Controller\Adminhtml\GiftClaim;

class Delete extends \RetailDirect\GiftClaim\Controller\Adminhtml\GiftClaim
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('giftclaim_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\RetailDirect\GiftClaim\Model\GiftClaim::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Giftclaim.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['giftclaim_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Giftclaim to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
