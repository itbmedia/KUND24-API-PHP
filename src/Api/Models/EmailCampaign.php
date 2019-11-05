<?php

namespace Kund24\Api\Models;

class EmailCampaign implements \JsonSerializable {
	private $id;

	private $title;

	private $template;

	public function setTemplate(\Kund24\Api\Models\EmailTemplate $emailTemplate) {
		$emailTemplate->setEmailCampaign($this);
		$this->template = $emailTemplate;
		return $this;
	}
	public function getTemplate() {
		return $this->contact;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
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
		if (array_key_exists("template", $data)) {
			$template = new \Kund24\Api\Models\EmailTemplate();
			$template->jsonUnserialize($data['template']);
			$this->setTemplate($template);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"template" => (($this->getTemplate()) ? $this->getTemplate()->jsonSerialize():null),
        );
    }
}