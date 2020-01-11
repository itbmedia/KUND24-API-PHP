<?php

namespace Kund24\Api\Models;

class PostComment implements \JsonSerializable {
	private $id;

	private $content;

	private $name;

	private $email;

	private $ip;

	private $publishedAt;

	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	public function getContent() {
		return $this->content;
	}
	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getName() {
		return $this->name;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setIp($ip) {
		$this->ip = $ip;
		return $this;
	}
	public function getIp() {
		return $this->ip;
	}
	public function setPublishedAt($publishedAt) {
		$this->publishedAt = $publishedAt;
		return $this;
	}
	public function getPublishedAt() {
		return $this->publishedAt;
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
		if (array_key_exists("content", $data)) {
			$this->setContent($data['content']);
		}
		if (array_key_exists("name", $data)) {
			$this->setName($data['name']);
		}
		if (array_key_exists("email", $data)) {
			$this->setEmail($data['email']);
		}
		if (array_key_exists("ip", $data)) {
			$this->setIp($data['ip']);
		}
		if (array_key_exists("published_at", $data)) {
			$this->setPublishedAt($data['published_at']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"content" => $this->getContent(),
        	"name" => $this->getName(),
        	"email" => $this->getEmail(),
        	"ip" => $this->getIp(),
        	"published_at" => $this->getPublishedAt(),
        );
    }
}