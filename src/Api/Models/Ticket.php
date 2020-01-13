<?php

namespace Kund24\Api\Models;

class Ticket implements \JsonSerializable {
	private $id;

	private $contact;

	private $project;

	private $title;

	private $field;

	private $number;

	private $status = 'open';

	private $channel = 'email';

	private $events = array();

	public function setContact(\Kund24\Api\Models\Contact $contact) {
		$this->contact = $contact;
		return $this;
	}
	public function getContact() {
		return $this->contact;
	}
	public function setField($field) {
		$this->field = $field;
		return $this;
	}
	public function getField() {
		return $this->field;
	}
	public function setProject(\Kund24\Api\Models\Project $project) {
		$this->project = $project;
		return $this;
	}
	public function getProject() {
		return $this->project;
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
		if ((array_key_exists("contact", $data)) && ($data['contact'])) {
			$contact = new \Kund24\Api\Models\Contact();
			$contact->jsonUnserialize($data['contact']);
			$this->setContact($contact);
		}
		if ((array_key_exists("project", $data)) && ($data['project'])) {
			$project = new \Kund24\Api\Models\Project();
			$project->jsonUnserialize($data['project']);
			$this->setProject($project);
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
        	"field" => $this->getField(),
        	"channel" => $this->getChannel(),
        	"contact" => (($this->getContact()) ? $this->getContact()->jsonSerialize():null),
        	"project" => (($this->getProject()) ? $this->getProject()->jsonSerialize():null),
        	"events" => array_map(function($event) { return $event->jsonSerialize(); }, $this->getEvents()),
        );
    }
}