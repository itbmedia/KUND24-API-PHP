<?php

namespace Kund24\Api\Models;

class Project implements \JsonSerializable {
	private $id;

	private $contact;

	private $title;

	private $note;

	private $reference;

	public function setContact(\Kund24\Api\Models\Contact $contact) {
		$this->contact = $contact;
		return $this;
	}
	public function getContact() {
		return $this->contact;
	}
	private function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	private function setNote($note) {
		$this->note = $note;
		return $this;
	}
	public function getNote() {
		return $this->note;
	}
	private function setReference($reference) {
		$this->reference = $reference;
		return $this;
	}
	public function getReference() {
		return $this->reference;
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
		if (array_key_exists("title", $data)) {
			$this->setTitle($data['title']);
		}
		if (array_key_exists("note", $data)) {
			$this->setNote($data['note']);
		}
		if (array_key_exists("reference", $data)) {
			$this->setReference($data['reference']);
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
        	"title" => $this->getTitle(),
        	"note" => $this->getNote(),
        	"reference" => $this->getReference(),
        	"contact" => (($this->getContact()) ? $this->getContact()->jsonSerialize():null),
        );
    }
}