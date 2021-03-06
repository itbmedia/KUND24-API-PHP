<?php

namespace Kund24\Api\Models;

class Upload implements \JsonSerializable {
	private $id;

	private $url;

	private $type;

	private $name;

	private $data;

	private $size;

	private $createdAt;

	private $updatedAt;

	public function setSize($size) {
		$this->size = $size;
		return $this;
	}
	public function getSize() {
		return $this->size;
	}
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	public function getType() {
		return $this->type;
	}
	public function setData($base64EncodedData) {
		$this->data = $base64EncodedData;
		return $this;
	}
	public function getData() {
		return $this->data;
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
		if (array_key_exists("filename", $data)) {
			$this->setName($data['filename']);
		}
		if (array_key_exists("data", $data)) {
			$this->setName($data['data']);
		}
		if (array_key_exists("type", $data)) {
			$this->setType($data['type']);
		}
		if (array_key_exists("created_at", $data)) {
			$this->setCreatedAt($data['created_at']);
		}
		if (array_key_exists("updated_at", $data)) {
			$this->setUpdatedAt($data['updated_at']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"url" => $this->getUrl(),
        	"size" => $this->getSize(),
        	"name" => $this->getName(),
        	"filename" => $this->getName(),
        	"type" => $this->getType(),
        	"data" => $this->getData(),
        	"created_at" => $this->getCreatedAt(),
        	"updated_at" => $this->getUpdatedAt(),
        );
    }
}