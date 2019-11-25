<?php

namespace Kund24\Api\Models;

class Bolag implements \JsonSerializable {

	private $id;

	private $title;

	private $companyNumber;

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setCompanyNumber($companyNumber) {
		$this->companyNumber = $companyNumber;
		return $this;
	}
	public function getCompanyNumber() {
		return $this->companyNumber;
	}
	public function jsonUnserialize($data) {
		if (array_key_exists("id", $data)) {
			$this->setId($data['id']);
		}
		if (array_key_exists("title", $data)) {
			$this->setTitle($data['title']);
		}
		if (array_key_exists("company_number", $data)) {
			$this->setCompanyNumber($data['company_number']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"company_number" => $this->getCompanyNumber(),
        );
    }
}