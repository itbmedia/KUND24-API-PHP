<?php

namespace Kund24\Api\Models;

class EmailTemplate implements \JsonSerializable {
	private $id;

	private $title;

	private $emailCampaign;

	public function setEmailCampaign(\Kund24\Api\Models\EmailCampaign $emailCampaign) {
		$this->emailCampaign = $emailCampaign;
		return $this;
	}
	public function getEmailCampaign() {
		return $this->emailCampaign;
	}
	private function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	private function setId($id) {
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