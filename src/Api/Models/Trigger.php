<?php

namespace Kund24\Api\Models;

class Trigger implements \JsonSerializable {
	private $id;

	private $title;

	private $enabled;

	private $event;

	private $conditions = array();

	private $actions = array();

	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setEnabled($enabled) {
		$this->enabled = $enabled;
		return $this;
	}
	public function getEnabled() {
		return $this->enabled;
	}
	public function setEvent($event) {
		$this->event = $event;
		return $this;
	}
	public function getEvent() {
		return $this->event;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function addCondition(\Kund24\Api\Models\TriggerCondition $condition) {
		$condition->setTrigger($this);
		$this->conditions[] = $condition;
		return $this;
	}
	public function getConditions() {
		return $this->conditions;
	}
	public function addAction(\Kund24\Api\Models\TriggerAction $action) {
		$action->setTrigger($this);
		$this->actions[] = $action;
		return $this;
	}
	public function getActions() {
		return $this->actions;
	}
	public function jsonUnserialize($data) {
		if (array_key_exists("id", $data)) {
			$this->setId($data['id']);
		}
		if (array_key_exists("title", $data)) {
			$this->setTitle($data['title']);
		}
		if (array_key_exists("enabled", $data)) {
			$this->setEnabled($data['enabled']);
		}
		if (array_key_exists("event", $data)) {
			$this->setEvent($data['event']);
		}
		if ((array_key_exists("conditions", $data)) && ($data['conditions'])) {
			foreach ($data['conditions'] as $eventData) {
				$condition = new \Kund24\Api\Models\TriggerCondition();
				$condition->jsonUnserialize($eventData);
				$this->addCondition($condition);
			}
		}
		if ((array_key_exists("actions", $data)) && ($data['actions'])) {
			foreach ($data['actions'] as $eventData) {
				$action = new \Kund24\Api\Models\TriggerAction();
				$action->jsonUnserialize($eventData);
				$this->addAction($action);
			}
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"enabled" => $this->getEnabled(),
        	"event" => $this->getEvent(),
        	"conditions" => array_map(function($event) { return $event->jsonSerialize(); }, $this->getConditions()),
        	"actions" => array_map(function($event) { return $event->jsonSerialize(); }, $this->getActions()),
        );
    }
}