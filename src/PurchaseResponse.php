<?php
namespace Omnipay\AbnInternetKassaIdealOnly;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

    public function isSuccessful()
    {
        return true;
    }

    public function isRedirect ()
    {
        return true;
    }

    public function getRedirectUrl()
    {
        $request = $this->request;
        /* @var $request PurchaseRequest */
        return $request->getUrl();
    }

    public function getRedirectData()
    {
        return $this->request->getData();
    }

    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getData()
    {
        return $this->data;
    }
}
