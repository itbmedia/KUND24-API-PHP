<?php

namespace Kund24\Api\Models;

class PostComment implements \JsonSerializable {
	private $id;

	private $content;

	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	public function getContent() {
		return $this->content;
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
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"content" => $this->getContent(),
        );
    }
}