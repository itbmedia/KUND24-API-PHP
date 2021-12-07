<?php

namespace Kund24\Api\Models;

class Ticket implements \JsonSerializable {
	private $id;

	private $contact;

	private $rowInfo;

	private $title;

	private $field;

	private $number;

	private $status;

	private $channel = 'email';

	private $deadlineAt;

	private $createdAt;

	private $updatedAt;

	private $events = array();

	public function setContact(\Kund24\Api\Models\Contact $contact) {
		$this->contact = $contact;
		return $this;
	}
	public function getContact() {
		return $this->contact;
	}
	public function setRowInfo($rowInfo) {
		$this->rowInfo = $rowInfo;
		return $this;
	}
	public function getRowInfo() {
		return $this->rowInfo;
	}
	public function setDeadlineAt($deadlineAt) {
		$this->deadlineAt = $deadlineAt;
		return $this;
	}
	public function getDeadlineAt() {
		return $this->deadlineAt;
	}
	public function setField($field) {
		$this->field = $field;
		return $this;
	}
	public function getField() {
		return $this->field;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setNumber($number) {
		$this->number = $number;
		return $this;
	}
	public function getNumber() {
		return $this->number;
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
	public function setChannel($channel) {
		$this->channel = $channel;
		return $this;
	}
	public function getChannel() {
		return $this->channel;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function addEvent(\Kund24\Api\Models\TicketEvent $event) {
		$event->setTicket($this);
		$this->events[] = $event;
		return $this;
	}
	public function getEvents() {
		return $this->events;
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
	public function jsonUnserialize($data) {
		if (array_key_exists("id", $data)) {
			$this->setId($data['id']);
		}
		if (array_key_exists("title", $data)) {
			$this->setTitle($data['title']);
		}
		if (array_key_exists("number", $data)) {
			$this->setNumber($data['number']);
		}
		if (array_key_exists("status", $data)) {
			$this->setStatus($data['status']);
		}
		if (array_key_exists("channel", $data)) {
			$this->setChannel($data['channel']);
		}
		if (array_key_exists("deadline_at", $data)) {
			$this->setDeadlineAt($data['deadline_at']);
		}
		if (array_key_exists("created_at", $data)) {
			$this->setCreatedAt($data['created_at']);
		}
		if (array_key_exists("updated_at", $data)) {
			$this->setUpdatedAt($data['updated_at']);
		}
		if ((array_key_exists("contact", $data)) && ($data['contact'])) {
			$contact = new \Kund24\Api\Models\Contact();
			$contact->jsonUnserialize($data['contact']);
			$this->setContact($contact);
		}
		if ((array_key_exists("row_info", $data)) && ($data['row_info'])) {
			$this->setRowInfo($data['row_info']);
		}
		if ((array_key_exists("events", $data)) && ($data['events'])) {
			foreach ($data['events'] as $eventData) {
				$event = new \Kund24\Api\Models\TicketEvent();
				$event->jsonUnserialize($eventData);
				$this->addEvent($event);
			}
		}
		if (array_key_exists("field", $data)) {
			$this->setField($data['field']['title']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"number" => $this->getNumber(),
        	"status" => $this->getStatus(),
        	"deadline_at" => $this->getDeadlineAt(),
        	"field" => $this->getField(),
        	"created_at" => $this->getCreatedAt(),
        	"updated_at" => $this->getUpdatedAt(),
        	"channel" => $this->getChannel(),
        	"contact" => (($this->getContact()) ? $this->getContact()->jsonSerialize():null),
        	"row_info" => (($this->getRowInfo()) ? $this->getRowInfo():null),
        	"events" => array_map(function($event) { return $event->jsonSerialize(); }, $this->getEvents()),
        );
    }
}