<?php
namespace Omnipay\AbnInternetKassaIdealOnly;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

class CompletePurchaseRequest extends AbstractRequest {

    private $shaPassPhrase;

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     * @return ResponseInterface
     * @throws InvalidRequestException
     */
    public function sendData($data)
    {
        if (!isset($data['STATUS'])) {
            throw new InvalidRequestException('Purchase request should contain STATUS');
        }
        return $this->response = new CompletePurchaseResponse($this, \array_change_key_case($data, \CASE_UPPER));
    }

    public function setShaPassPhrase($shaPassPhrase)
    {
        $this->shaPassPhrase = $shaPassPhrase;
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->httpRequest->query->all();
    }
}