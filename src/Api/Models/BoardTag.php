<?php

namespace Kund24\Api\Models;

class BoardTag implements \JsonSerializable {
	private $id;

	private $title;

	private $color;

	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setColor($color) {
		$this->color = $color;
		return $this;
	}
	public function getColor() {
		return $this->color;
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
		if (array_key_exists("color", $data)) {
			$this->setColor($data['color']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"color" => $this->getColor(),
        );
    }
}