<?php
namespace Omnipay\AbnInternetKassaIdealOnly;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

class PurchaseRequest extends AbstractRequest {

    private $pspId;
    private $url;
    private $shaPassPhrase;

    public function getPspId ()
    {
        return $this->pspId;
    }
    public function setPspId($value)
    {
        $this->pspId = $value;
    }
    public function getLanguage()
    {
        return $this->getParameter('language');
    }
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }
    public function getDescription()
    {
        return $this->getParameter('description');
    }
    public function setDescription($value)
    {
        return $this->setParameter('description', $value);
    }
    public function getTransactionId()
    {
        return $this->getParameter('purchaseID');
    }
    public function setTransactionId($value)
    {
        return $this->setParameter('purchaseID', $value);
    }
    public function getPaymentMethod()
    {
        return $this->getParameter('paymentType');
    }
    public function setUrl ($value)
    {
        $this->url = $value;
    }
    public function getUrl ()
    {
        return $this->url;
    }
    /**
     * Set the payment method.
     *
     * This field is used by some European gateways, which support
     * multiple payment providers with a single API.
     */
    public function setPaymentMethod($value)
    {
        return $this->setParameter('paymentType', $value);
    }
    public function getReturnUrl()
    {
        return $this->getParameter('urlSuccess');
    }
    public function setReturnUrl($value)
    {
        return $this->setParameter('urlSuccess', $value);
    }
    public function getCancelUrl()
    {
        return $this->getParameter('urlCancel');
    }
    public function setCancelUrl($value)
    {
        return $this->setParameter('urlCancel', $value);
    }
    public function getNotifyUrl()
    {
        return null;
    }
    public function setNotifyUrl($value)
    {
        ;
    }
    public function getData ()
    {
        $data = parent::getData();
        $data['PSPID'] = $this->getPspId();
        $data['ORDERID'] = $this->getTransactionId();
        $data['AMOUNT'] = $this->getAmountInteger();
        $data['CURRENCY'] = $this->getCurrency();
        $data['LANGUAGE'] = $this->getLanguage();
        $data['ACCEPTURL'] = $this->getReturnUrl();
        $data['CANCELURL'] = $this->getCancelUrl();
        $data['PARAMVAR'] = $this->getNotifyUrlPath();
        $data['hash'] = $this->generateHash([
            'AMOUNT' => $this->getAmountInteger(),
            'CURRENCY' => $this->getCurrency(),
            'LANGUAGE' => $this->getLanguage(),
            'ORDERID' => $this->getTransactionId(),
            'PSPID' => $this->getPspId(),
        ]);
        return $data;
    }

    private function getNotifyUrlPath () {
        return parse_url($this->getReturnUrl(), PHP_URL_PATH);
    }

    private function generateHash ($listOfItems) {
        $stringToBeHashed = null;
        foreach ($listOfItems as $key => $value)  {
            $stringToBeHashed .= $key . '=' . $value . $this->getParameter('shaPassPhrase');
        }
        return sha1($stringToBeHashed);
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    public function setShaPassPhrase($shaPassPhrase)
    {
        $this->shaPassPhrase = $shaPassPhrase;
    }

}