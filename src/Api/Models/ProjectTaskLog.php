<?php

namespace Kund24\Api\Models;

class ProjectTaskLog implements \JsonSerializable {
	private $id;

	private $minutes;

	private $status;

	private $comment;

	private $checkinAt;

	private $checkoutAt;

	private $user;

	private $uploads = array();

	private $createdAt;

	private $updatedAt;

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
	public function setCheckinAt($checkinAt) {
		$this->checkinAt = $checkinAt;
		return $this;
	}
	public function getCheckinAt() {
		return $this->checkinAt;
	}
	public function setCheckoutAt($checkoutAt) {
		$this->checkoutAt = $checkoutAt;
		return $this;
	}
	public function getCheckoutAt() {
		return $this->checkoutAt;
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
		if (array_key_exists("checkin_at", $data)) {
			$this->setCheckinAt($data['checkin_at']);
		}
		if (array_key_exists("checkout_at", $data)) {
			$this->setCheckoutAt($data['checkout_at']);
		}
		if (array_key_exists("created_at", $data)) {
			$this->setCreatedAt($data['created_at']);
		}
		if (array_key_exists("updated_at", $data)) {
			$this->setUpdatedAt($data['updated_at']);
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
        	"checkin_at" => $this->getCheckinAt(),
        	"checkout_at" => $this->getCheckoutAt(),
        	"created_at" => $this->getCreatedAt(),
        	"updated_at" => $this->getUpdatedAt(),
        	"user" => (($this->getUser()) ? $this->getUser()->jsonSerialize():null),
        	"files" => array_map(function($upload) { return $upload->jsonSerialize(); }, $this->getUploads()),
        );
    }
}