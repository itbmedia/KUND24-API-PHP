<?php

namespace Kund24\Api\Models;

class ChatMessage implements \JsonSerializable {

	private $id;

	private $chatId;

	private $userId;

	private $content;

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function setChatId($chatId) {
		$this->chatId = $chatId;
		return $this;
	}
	public function getChatId() {
		return $this->chatId;
	}
	public function setUserId($userId) {
		$this->userId = $userId;
		return $this;
	}
	public function getUserId() {
		return $this->userId;
	}
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	public function getContent() {
		return $this->content;
	}
	public function jsonUnserialize($data) {
		if (array_key_exists("id", $data)) {
			$this->setId($data['id']);
		}
		if (array_key_exists("chat_id", $data)) {
			$this->setChatId($data['chat_id']);
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
        	"chat_id" => $this->getChatId(),
        	"content" => $this->getContent(),
        	"user_id" => $this->getUserId(),
        );
    }
}