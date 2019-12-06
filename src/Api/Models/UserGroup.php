<?php

namespace Kund24\Api\Models;

class UserGroup implements \JsonSerializable {
	private $id;

	private $name;

	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getName() {
		return $this->name;
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
		if (array_key_exists("name", $data)) {
			$this->setName($data['name']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"name" => $this->getName(),
        );
    }
}