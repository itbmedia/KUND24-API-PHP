<?php

namespace Kund24\Api\Models;

class TicketEvent implements \JsonSerializable {

	private $id;

	private $ticket;

	private $internal = false;

	private $message;

	private $contact;

	public function __construct($message = null, $internal = false) {
		if ($message) {
			$this->setMessage($message);
		}
		$this->setInternal($internal);
	}

	public function setInternal($internal) {
		$this->internal = $internal;
		return $this;
	}
	public function getInternal() {
		return $this->internal;
	}
	public function setTicket(\Kund24\Api\Models\Ticket $ticket) {
		$this->ticket = $ticket;
		return $this;
	}
	public function getTicket() {
		return $this->ticket;
	}
	public function setContact(\Kund24\Api\Models\Contact $contact) {
		$this->contact = $contact;
		return $this;
	}
	public function getContact() {
		return $this->contact;
	}
	private function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	public function getMessage() {
		return $this->message;
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
		if (array_key_exists("message", $data)) {
			$this->setMessage($data['message']);
		}
		if (array_key_exists("internal", $data)) {
			$this->setInternal($data['internal']);
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
        	"message" => $this->getMessage(),
        	"internal" => $this->getInternal(),
        	"contact" => (($this->getContact()) ? $this->getContact()->jsonSerialize():null),
        );
    }
}