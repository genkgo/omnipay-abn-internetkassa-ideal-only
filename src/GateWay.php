<?php
namespace Omnipay\AbnInternetKassaIdealOnly;

use Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Ogone';
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPspId($value)
    {
        return $this->setParameter('PSPID', $value);
    }

    /**
     * @return string
     */
    public function getPspId()
    {
        return $this->getParameter('PSPID');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setShaPassPhrase($value)
    {
        return $this->setParameter('shaPassPhrase', $value);
    }

    /**
     * @return string
     */
    public function getShaPassPhrase()
    {
        return $this->getParameter('shaPassPhrase');
    }

    /**
     * @param  array $parameters
     * @return PurchaseRequest
     */
    public function purchase (array $parameters = array()) {
        $parameters['PSP'] = $this->getPspId();
        $request = $this->createRequest(PurchaseRequest::class, $parameters);
        /* @var $request PurchaseRequest */
        if ($this->getTestMode()) {
            $request->setUrl('https://internetkassa.abnamro.nl/ncol/test/orderstandard.asp');
        } else {
            $request->setUrl('https://internetkassa.abnamro.nl/ncol/prod/orderstandard.asp');
        }
        $request->setCurrency('EUR');
        $request->setLanguage('nl_NL');
        $request->setPaymentMethod('ideal');
        $request->setShaPassPhrase($this->getShaPassPhrase());
        return $request;
    }
}