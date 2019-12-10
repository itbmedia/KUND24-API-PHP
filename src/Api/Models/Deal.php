<?php

namespace Kund24\Api\Models;

class Deal implements \JsonSerializable {
	private $id;

	private $contact;

	private $title;

	private $value = 0;

	private $source = 'API';

	private $field = 'Standardavdelning';

	private $reference;

	private $stage = 'Leads';

	private $content = '';

	private $currency = 'SEK';

	private $user;

	private $creator;

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
	public function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;
		return $this;
	}
	public function getCreatedAt() {
		return $this->createdAt;
	}
	public function setUpdatedAt($updatedAt) {
		$this->updatedAt = $updatedAt;
		return $this;
	}
	public function getUpdatedAt() {
		return $this->updatedAt;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setReference($reference) {
		$this->reference = $reference;
		return $this;
	}
	public function getReference() {
		return $this->reference;
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
	public function setField($field) {
		$this->field = $field;
		return $this;
	}
	public function getField() {
		return $this->field;
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
	public function setCreator(\Kund24\Api\Models\User $creator) {
		$this->creator = $creator;
		return $this;
	}
	public function getCreator() {
		return $this->creator;
	}
	public function setUser(\Kund24\Api\Models\User $user) {
		$this->user = $user;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function setId($id) {
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
		if (array_key_exists("created_at", $data)) {
			$this->setCreatedAt($data['created_at']);
		}
		if (array_key_exists("updated_at", $data)) {
			$this->setUpdatedAt($data['updated_at']);
		}
		if (array_key_exists("currency", $data)) {
			$this->setCurrency($data['currency']);
		}
		if (array_key_exists("reference", $data)) {
			$this->setReference($data['reference']);
		}
		if (array_key_exists("source", $data)) {
			$this->setSource($data['source']['title']);
		}
		if (array_key_exists("stage", $data)) {
			$this->setStage($data['stage']['title']);
		}
		if (array_key_exists("field", $data)) {
			$this->setField($data['field']['title']);
		}
		if (array_key_exists("content", $data)) {
			$this->setContent($data['content']);
		}
		if (array_key_exists("contact", $data)) {
			$contact = new \Kund24\Api\Models\Contact();
			$contact->jsonUnserialize($data['contact']);
			$this->setContact($contact);
		}
		if (array_key_exists("creator", $data)) {
			$creator = new \Kund24\Api\Models\User();
			$creator->jsonUnserialize($data['creator']);
			$this->setCreator($creator);
		}
		if (array_key_exists("user", $data)) {
			$user = new \Kund24\Api\Models\User();
			$user->jsonUnserialize($data['user']);
			$this->setUser($user);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"value" => $this->getValue(),
        	"title" => $this->getTitle(),
        	"currency" => $this->getCurrency(),
        	"field" => $this->getField(),
        	"source" => $this->getSource(),
        	"reference" => $this->getReference(),
        	"stage" => $this->getStage(),
        	"created_at" => $this->getCreatedAt(),
        	"updated_at" => $this->getUpdatedAt(),
        	"content" => $this->getContent(),
        	"contact" => (($this->getContact()) ? $this->getContact()->jsonSerialize():null),
        	"user" => (($this->getUser()) ? $this->getUser()->jsonSerialize():null),
        );
    }
}