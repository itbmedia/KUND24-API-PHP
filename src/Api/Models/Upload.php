<?php

namespace Kund24\Api\Models;

class Upload implements \JsonSerializable {
	private $id;

	private $url;

	private $name;

	private $size;

	public function setSize($size) {
		$this->size = $size;
		return $this;
	}
	public function getSize() {
		return $this->size;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getName() {
		return $this->name;
	}
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}
	public function getUrl() {
		return $this->url;
	}
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}
	public function getUrl() {
		return $this->url;
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
		if (array_key_exists("url", $data)) {
			$this->setUrl($data['url']);
		}
		if (array_key_exists("size", $data)) {
			$this->setSize($data['size']);
		}
		if (array_key_exists("name", $data)) {
			$this->setName($data['name']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"url" => $this->getUrl(),
        	"size" => $this->getSize(),
        	"name" => $this->getName(),
        );
    }
}