<?php

namespace Kund24\Api\Models;

class BoardRowComment implements \JsonSerializable {
	private $id;

	private $comment;

	private $files = array();

	private $mentions = array();

	public function setComment($comment) {
		$this->comment = $comment;
		return $this;
	}
	public function getComment() {
		return $this->comment;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function getMentions() {
		return $this->mentions;
	}
	public function getFiles() {
		return $this->files;
	}
	public function jsonUnserialize($data) {
		if (array_key_exists("id", $data)) {
			$this->setId($data['id']);
		}
		if (array_key_exists("comment", $data)) {
			$this->setComment($data['comment']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"comment" => $this->getComment(),
        	"mentions" => $this->getMentions(),
        	"files" => $this->getFiles(),
        );
    }
}