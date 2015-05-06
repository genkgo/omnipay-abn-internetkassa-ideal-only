# ABN InternetKassa iDEAL Only Kassa driver for Omnipay
Use Omnipay with Dutch bank ABN.

## Usage

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('AbnInternetKassaIdealOnly');
$gateway->setPspId('pspid');
$gateway->setShaInPassPhrase('passphrase, sha1 encoded');
$gateway->setTestMode(true);

$response = $gateway->purchase([
	'transactionId' => 1,
	'amount' => '18.15',
	'description' => 'Description here',
	'cancelUrl' => 'http://example.com/cancel',
	'returnUrl' => 'http://example.com/return',
	'notifyUrl' => 'http://example.com/notify',
])->send();

```

## Be aware with notify url

In the ABN Amro settings panel, you will have to set the notify url to: ```http://example.com/<PARAMVAR>```. When you insert a notifyUrl
in your purchase request (see above). A hidden input field  [PARAMVAR](http://payment-services.ingenico.com/int/en/ogone/support/guides/integration%20guides/e-commerce) will be included in the post redirect and it will be set to only the path of that notifyUrl.

Because ABN Amro urlencodes this field your notifyUrl can only contain one path segment (a slash becomes %2F). If this is a problem for you, 
change the notify url in the ABN Amro settings panel to ```http://example.com/path-to-payment-hook?target=<PARAMVAR>``` and set the request
type to GET. Then your <PARAMVAR> contains the urlencoded target GET variable. Now you should be able to make the correct request yourself.

Unfortunately, this is how it works, because in my opinion it is best compatible with other omnipay drivers.
