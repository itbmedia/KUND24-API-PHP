<?php

namespace Kund24\Api\Models;

class ProjectTaskLog implements \JsonSerializable {
	private $id;

	private $minutes;

	private $status;

	private $comment;

	private $user;

	private $uploads = array();

	public function setUser(\Kund24\Api\Models\User $user) {
		$this->user = $user;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function getUploads() {
		return $this->uploads;
	}
	public function addUpload(\Kund24\Api\Models\Upload $upload) {
		$this->uploads[] = $upload;
		return $this;
	}
	public function setMinutes($minutes) {
		$this->minutes = $minutes;
		return $this;
	}
	public function getMinutes() {
		return $this->minutes;
	}
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}
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
	public function jsonUnserialize($data) {
		if (array_key_exists("id", $data)) {
			$this->setId($data['id']);
		}
		if (array_key_exists("minutes", $data)) {
			$this->setMinutes($data['minutes']);
		}
		if (array_key_exists("status", $data)) {
			$this->setStatus($data['status']);
		}
		if (array_key_exists("comment", $data)) {
			$this->setComment($data['comment']);
		}
		if ((array_key_exists("user", $data)) && ($data['user'])) {
			$user = new \Kund24\Api\Models\User();
			$user->jsonUnserialize($data['user']);
			$this->setUser($user);
		}
		if ((array_key_exists("files", $data)) && ($data['files'])) {
			foreach ($data['files'] as $upl) {
				$upload = new \Kund24\Api\Models\Upload();
				$upload->jsonUnserialize($upl);
				$this->addUpload($upload);
			}
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"minutes" => $this->getMinutes(),
        	"status" => $this->getStatus(),
        	"comment" => $this->getComment(),
        	"user" => (($this->getUser()) ? $this->getUser()->jsonSerialize():null),
        	"files" => array_map(function($upload) { return $upload->jsonSerialize(); }, $this->getUploads()),
        );
    }
}