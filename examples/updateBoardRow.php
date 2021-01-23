<?php
require_once("../vendor/autoload.php");

$accountId = '24';
$apiKey = 'tok_cdfe548635c31cbb6556f1debf22a0b2';

$client = new \Kund24\Api\Client($accountId, $apiKey);

$board = $client->getBoard(40);
$row = $client->getBoardRow($board, 1101);
$row->setValueByColumnName('E-post', 'name2@example.com');
$row = $client->updateBoardRow($board, $row);

print_r($row);