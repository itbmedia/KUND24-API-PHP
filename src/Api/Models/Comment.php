<?php

namespace Kund24\Api\Models;

class Comment implements \JsonSerializable {

	private $id;

	private $user;

	private $content;

	private $uploads = array();

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	public function getContent() {
		return $this->content;
	}
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
	public function jsonUnserialize($data) {
		if (array_key_exists("id", $data)) {
			$this->setId($data['id']);
		}
		if (array_key_exists("content", $data)) {
			$this->setContent($data['content']);
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
        	"content" => $this->getContent(),
        	"user" => (($this->getUser()) ? $this->getUser()->jsonSerialize():null),
        	"files" => array_map(function($upload) { return $upload->jsonSerialize(); }, $this->getUploads()),
        );
    }
}