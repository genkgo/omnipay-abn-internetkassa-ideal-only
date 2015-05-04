<?php
namespace Omnipay\AbnInternetKassaIdealOnly;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class CompletePurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

    /**
     * {@inheritdoc}
     */
    public function isRedirect()
    {
        return false;
    }
    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl()
    {
        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function getRedirectMethod()
    {
        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function getRedirectData()
    {
        return null;
    }
    /**
     * {@inheritdoc}
     */
    public function isSuccessful()
    {
        return $this->data['STATUS'] == 9;
    }
    /**
     * @return boolean
     */
    public function isOpen()
    {
        return $this->data['STATUS'] == 5;
    }
    /**
     * @return boolean
     */
    public function isCancelled()
    {
        return $this->data['STATUS'] == 1;
    }
    /**
     * @return mixed
     */
    public function getTransactionReference()
    {
        if (isset($this->data['ORDERID'])) {
            return $this->data['ORDERID'];
        }
    }
    /**
     * @return mixed
     */
    public function getStatus()
    {
        if (isset($this->data['STATUS'])) {
            return $this->data['STATUS'];
        }
    }
    /**
     * @return mixed
     */
    public function getAmount()
    {
        if (isset($this->data['AMOUNT'])) {
            return $this->data['AMOUNT'];
        }
    }
}
