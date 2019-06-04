<?php

namespace Kund24\Api\Models;

class Deal implements \JsonSerializable {
	private $id;

	private $contact;

	private $title;

	private $value = 0;

	private $source = 'API';

	private $stage = 'Leads';

	private $content = '';

	private $currency = 'SEK';

	public function setContact(\Kund24\Api\Models\Contact $contact) {
		$this->contact = $contact;
		return $this;
	}
	public function getContact() {
		return $this->contact;
	}
	public function setValue($value) {
		$this->value = $value;
		return $this;
	}
	public function getValue() {
		return $this->value;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	public function getContent() {
		return $this->content;
	}
	public function setStage($stage) {
		$this->stage = $stage;
		return $this;
	}
	public function getStage() {
		return $this->stage;
	}
	public function setSource($source) {
		$this->source = $source;
		return $this;
	}
	public function getSource() {
		return $this->source;
	}
	public function setCurrency($currency) {
		$this->currency = $currency;
		return $this;
	}
	public function getCurrency() {
		return $this->currency;
	}
	private function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function jsonUnserialize($data) {
		if (array_key_exists("id", $data)) {
			$this->setId($data['id']);
		}
		if (array_key_exists("value", $data)) {
			$this->setValue($data['value']);
		}
		if (array_key_exists("title", $data)) {
			$this->setTitle($data['title']);
		}
		if (array_key_exists("currency", $data)) {
			$this->setCurrency($data['currency']);
		}
		if (array_key_exists("source", $data)) {
			$this->setSource($data['source']['title']);
		}
		if (array_key_exists("stage", $data)) {
			$this->setStage($data['stage']['title']);
		}
		if (array_key_exists("content", $data)) {
			$this->setContent($data['content']);
		}
		if (array_key_exists("contact", $data)) {
			$contact = new \Kund24\Api\Models\Contact();
			$contact->jsonUnserialize($data['contact']);
			$this->setContact($contact);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"value" => $this->getValue(),
        	"title" => $this->getTitle(),
        	"currency" => $this->getCurrency(),
        	"source" => $this->getSource(),
        	"stage" => $this->getStage(),
        	"content" => $this->getContent(),
        	"contact" => $this->getContact()->jsonSerialize(),
        );
    }
}