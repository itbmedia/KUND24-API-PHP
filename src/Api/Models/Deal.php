<?php

namespace Kund24\Api\Models;

class Deal implements \JsonSerializable {
	private $id;

	private $contact;

	private $title;

	private $value = 0;

	private $margin = 0;

	private $archived;

	private $source = 'API';

	private $field = 'Standardavdelning';

	private $reference;

	private $stage = 'Leads';

	private $content = '';

	private $type;

	private $currency = 'SEK';

	private $user;

	private $uploads = array();

	private $creator;

	private $decisionAt;

	private $completeAt;

	private $createdAt;

	private $updatedAt;

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
	public function setMargin($margin) {
		$this->margin = $margin;
		return $this;
	}
	public function getMargin() {
		return $this->margin;
	}
	public function setDecisionAt($decisionAt) {
		$this->decisionAt = $decisionAt;
		return $this;
	}
	public function getDecisionAt() {
		return $this->decisionAt;
	}
	public function setCompleteAt($completeAt) {
		$this->completeAt = $completeAt;
		return $this;
	}
	public function getCompleteAt() {
		return $this->completeAt;
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
	public function setArchived($archived) {
		$this->archived = $archived;
		return $this;
	}
	public function getArchived() {
		return $this->archived;
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
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	public function getType() {
		return $this->type;
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
	public function getUploads() {
		return $this->uploads;
	}
	public function addUpload(\Kund24\Api\Models\Upload $upload) {
		$this->uploads[] = $upload;
		return $this;
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
		if (array_key_exists("margin", $data)) {
			$this->setMargin($data['margin']);
		}
		if (array_key_exists("title", $data)) {
			$this->setTitle($data['title']);
		}
		if (array_key_exists("archived", $data)) {
			$this->setArchived($data['archived']);
		}
		if (array_key_exists("decision_at", $data)) {
			$this->setDecisionAt($data['decision_at']);
		}
		if (array_key_exists("complete_at", $data)) {
			$this->setCompleteAt($data['complete_at']);
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
		if (array_key_exists("type", $data)) {
			$this->setType($data['type']['title']);
		}
		if (array_key_exists("field", $data)) {
			$this->setField($data['field']['title']);
		}
		if (array_key_exists("content", $data)) {
			$this->setContent($data['content']);
		}
		if ((array_key_exists("contact", $data)) && ($data['contact'])) {
			$contact = new \Kund24\Api\Models\Contact();
			$contact->jsonUnserialize($data['contact']);
			$this->setContact($contact);
		}
		if ((array_key_exists("creator", $data)) && ($data['creator'])) {
			$creator = new \Kund24\Api\Models\User();
			$creator->jsonUnserialize($data['creator']);
			$this->setCreator($creator);
		}
		if ((array_key_exists("user", $data)) && ($data['user'])) {
			$user = new \Kund24\Api\Models\User();
			$user->jsonUnserialize($data['user']);
			$this->setUser($user);
		}
		if ((array_key_exists("files", $data)) && ($data['files'])) {
			foreach ($data['files'] as $upl) {
				$upload = new \Kund24\Api\Models\Upload();
				$upload->jsonUnserialize($upl);
				$this->addUpload($upload);
			}
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"value" => $this->getValue(),
        	"margin" => $this->getMargin(),
        	"title" => $this->getTitle(),
        	"archived" => $this->getArchived(),
        	"currency" => $this->getCurrency(),
        	"field" => $this->getField(),
        	"source" => $this->getSource(),
        	"reference" => $this->getReference(),
        	"stage" => $this->getStage(),
        	"type" => $this->getType(),
        	"decision_at" => $this->getDecisionAt(),
        	"complete_at" => $this->getCompleteAt(),
        	"created_at" => $this->getCreatedAt(),
        	"updated_at" => $this->getUpdatedAt(),
        	"content" => $this->getContent(),
        	"contact" => (($this->getContact()) ? $this->getContact()->jsonSerialize():null),
        	"user" => (($this->getUser()) ? $this->getUser()->jsonSerialize():null),
        	"files" => array_map(function($upload) { return $upload->jsonSerialize(); }, $this->getUploads()),
        );
    }
}