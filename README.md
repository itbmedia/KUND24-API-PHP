Kund24 - Api Client for PHP
========================================

In your admin screen of [https://www.kund24.se/](https://www.kund24.se/) you can generate an API Key for your account to integrate with your CRM


Installation through composer
--------------------

This package can be installed through composer

See [https://getcomposer.org/](https://getcomposer.org/) for more information and documentation.

Install it by running `composer require itbmedia/kund24-api-php`

Usage through regular PHP
--------------------

```
<?php 
	require_once("path/to/dir/vendor/autoload.php");

	$client = new \Kund24\Api\Client(YOUR_ACCOUNT_ID, 'YOUR_API_KEY');
	
	$contact = new \Kund24\Api\Models\Contact();
	$contact->setEmail('lars2000@gmail.com')
	->setFirstName('Fredrik')
	->setLastName('Bengtsson')
	->setCompany('ITB Media')
	;

	$deal = new \Kund24\Api\Models\Deal();
	$deal->setValue(500)
	->setTitle('Lead från hemsida')
	->setSource('Hemsida')
	->setStage('Leads')
	->setContact($contact)
	;

	$deal = $client->createDeal($deal);
```