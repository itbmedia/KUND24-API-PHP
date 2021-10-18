<?php

namespace Kund24\Api\Models;

class BoardGroup implements \JsonSerializable {
	private $id;

	private $title;

	private $board;

	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setBoard(\Kund24\Api\Models\Board $board) {
		$this->board = $board;
		return $this;
	}
	public function getBoard() {
		return $this->board;
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
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        );
    }
}