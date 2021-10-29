<?php

namespace Kund24\Api\Models;

class TicketEvent implements \JsonSerializable {

	private $id;

	private $ticket;

	private $internal = false;

	private $message;

	private $status;

	private $files = array();

	private $contact;

	private $user;

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
	public function setStatus($status) {
		if (($status) && (!in_array($status, array("closed", "spam", "removed", "open", "pending")))) {
			throw new \Exception('Status must be one of [closed, spam, removed, open, pending]');
		}
		$this->status = $status;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setContact(\Kund24\Api\Models\Contact $contact) {
		$this->contact = $contact;
		return $this;
	}
	public function getContact() {
		return $this->contact;
	}
	public function setUser(\Kund24\Api\Models\User $user) {
		$this->user = $user;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	public function getMessage() {
		return $this->message;
	}
	public function setFiles($files) {
		$this->files = $files;
		return $this;
	}
	public function getFiles() {
		return $this->files;
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
		if (array_key_exists("message", $data)) {
			$this->setMessage($data['message']);
		}
		if (array_key_exists("status", $data)) {
			$this->setStatus($data['status']);
		}
		if (array_key_exists("files", $data)) {
			$this->setFiles($data['files']);
		}
		if (array_key_exists("internal", $data)) {
			$this->setInternal($data['internal']);
		}
		if ((array_key_exists("contact", $data)) && ($data['contact'])) {
			$contact = new \Kund24\Api\Models\Contact();
			$contact->jsonUnserialize($data['contact']);
			$this->setContact($contact);
		}
		if ((array_key_exists("user", $data)) && ($data['user'])) {
			$user = new \Kund24\Api\Models\User();
			$user->jsonUnserialize($data['user']);
			$this->setUser($user);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"message" => $this->getMessage(),
        	"status" => $this->getStatus(),
        	"files" => $this->getFiles(),
        	"internal" => $this->getInternal(),
        	"contact" => (($this->getContact()) ? $this->getContact()->jsonSerialize():null),
        	"user" => (($this->getUser()) ? $this->getUser()->jsonSerialize():null),
        );
    }
}