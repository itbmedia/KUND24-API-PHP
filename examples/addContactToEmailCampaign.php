<?php
require_once("../vendor/autoload.php");

$accountId = '11';
$apiKey = 'tok_cdfe548635c31cbb6556f1debf22a0b2';

$client = new \Kund24\Api\Client($accountId, $apiKey);

$contact = new \Kund24\Api\Models\Contact();
$contact->setEmail('lars2000@gmail.com');
$contact->setFirstName('Fredrik');
$contact->setLastName('Bengtsson');
$contact->setCompany('ITB Media');
$contact->addMetafield(new \Kund24\Api\Models\ContactMetafield('food', 'love'));

$contact = $client->createContact($contact);
$emailCampaignId = 9;
$metafields = array(
	"username" => "myuser"
);

$result = $client->addContactsToEmailCampaign($emailCampaignId, array($contact->getId()), $metafields); //Empty array