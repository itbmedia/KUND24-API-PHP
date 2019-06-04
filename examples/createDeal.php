<?php
require_once("../vendor/autoload.php");

$apiKey = 'cdfe548635c31cbb6556f1debf22a0b2';

$client = new \Kund24\Api\Client($apiKey);

$deal = new \Kund24\Api\Models\Deal();
$deal->setValue(500);
$deal->setTitle('Lead från hemsida');
$deal->setSource('Hemsida');
$deal->setStage('Leads');
$contact = new \Kund24\Api\Models\Contact();
$contact->setEmail('lars2000@gmail.com');
$contact->setFirstName('Fredrik');
$contact->setLastName('Bengtsson');
$contact->setCompany('ITB Media');
$deal->setContact($contact);

$result = $client->createDeal($deal);

print_r($result);