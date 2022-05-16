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
	public function addMention(\Kund24\Api\Models\User $user) {
		$this->mentions[] = $user;
		return $this;
	}
	public function addFile(\Kund24\Api\Models\Upload $upload) {
		$this->files[] = $upload;
		return $this;
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
		if ((array_key_exists("files", $data)) && ($data['files'])) {
			foreach ($data['files'] as $eventData) {
				$event = new \Kund24\Api\Models\Upload();
				$event->jsonUnserialize($eventData);
				$this->addFile($event);
			}
		}
		if ((array_key_exists("mentions", $data)) && ($data['mentions'])) {
			foreach ($data['mentions'] as $eventData) {
				$event = new \Kund24\Api\Models\User();
				$event->jsonUnserialize($eventData);
				$this->addMention($event);
			}
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"comment" => $this->getComment(),
        	"mentions" => array_map(function($user) { return $user->jsonSerialize(); }, $this->getMentions()),
        	"files" => $this->getFiles(),
        );
    }
}