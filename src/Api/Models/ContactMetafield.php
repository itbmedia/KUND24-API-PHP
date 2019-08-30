<?php

namespace Kund24\Api\Models;

class ContactMetafield implements \JsonSerializable {

	private $id;

	private $handle;

	private $metafieldId;

	private $value;

	private $contact;

	public function __construct($handle = null, $value = null) {
		if ($handle) {
			$this->setHandle($handle);
		}
		if ($value) {
			$this->setValue($value);
		}
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function setHandle($handle) {
		$this->handle = $handle;
		return $this;
	}
	public function getHandle() {
		return $this->handle;
	}
	public function setMetafieldId($metafieldId) {
		$this->metafieldId = $metafieldId;
		return $this;
	}
	public function getMetafieldId() {
		return $this->metafieldId;
	}
	public function setContact($contact) {
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
	public function jsonUnserialize($data) {
		if (array_key_exists("id", $data)) {
			$this->setId($data['id']);
		}
		if (array_key_exists("handle", $data)) {
			$this->setHandle($data['handle']);
		}
		if (array_key_exists("metafield_id", $data)) {
			$this->setMetafieldId($data['metafield_id']);
		}
		if (array_key_exists("value", $data)) {
			$this->setValue($data['value']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"handle" => $this->getHandle(),
        	"metafield_id" => $this->getMetafieldId(),
        	"value" => $this->getValue(),
        );
    }
}