<?php
require_once("../vendor/autoload.php");

$accountId = '11';
$apiKey = 'tok_cdfe548635c31cbb6556f1debf22a0b2';

$client = new \Kund24\Api\Client($accountId, $apiKey);

$ticket = new \Kund24\Api\Models\Ticket();

$contact = new \Kund24\Api\Models\Contact();
$contact->setFirstName('Fredrik');
$contact->setLastName('Bengtsson');
$contact->setEmail('fredrik.bengtsson@itbmedia.se');

$ticket->setContact($contact);
$ticket->setTitle('Hej');
$ticket->addEvent(new \Kund24\Api\Models\TicketEvent('Behövde du hjälp?!'));

$ticket = $client->createTicket($ticket);

print_r($ticket);