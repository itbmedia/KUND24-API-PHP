<?php

namespace Kund24\Api\Models;

class Blog implements \JsonSerializable {
	private $id;

	private $title;

	private $type;

	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	public function getType() {
		return $this->type;
	}

	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
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
		if (array_key_exists("title", $data)) {
			$this->setTitle($data['title']);
		}
		if (array_key_exists("type", $data)) {
			$this->setType($data['type']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"type" => $this->getType(),
        );
    }
}