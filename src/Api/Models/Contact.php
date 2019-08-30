<?php

namespace Kund24\Api\Models;

class Contact implements \JsonSerializable {

	private $id;

	private $email;

	private $isCompany = false;

	private $firstName;

	private $lastName;

	private $company;

	private $phone;

	private $address1;

	private $address2;

	private $zip;

	private $city;

	private $country = 'SE';

	private $reference;

	private $note;

	private $metafields = array();

	private $tags = array();

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function setIsCompany($isCompany) {
		$this->isCompany = $isCompany;
		return $this;
	}
	public function getIsCompany() {
		return $this->isCompany;
	}
	public function setPhone($phone) {
		$this->phone = $phone;
		return $this;
	}
	public function getPhone() {
		return $this->phone;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}
	public function getFirstName() {
		return $this->firstName;
	}
	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}
	public function getLastName() {
		return $this->lastName;
	}
	public function getName() {
		return trim($this->getFirstName()." ".$this->getLastName());
	}
	public function setName($name) {
		return $this->setFirstName($name);
	}
	public function setCompany($company) {
		$this->company = $company;
		return $this;
	}
	public function getCompany() {
		return $this->company;
	}
	public function setAddress1($address1) {
		$this->address1 = $address1;
		return $this;
	}
	public function getAddress1() {
		return $this->address1;
	}
	public function setAddress2($address2) {
		$this->address2 = $address2;
		return $this;
	}
	public function getAddress2() {
		return $this->address2;
	}
	public function getStreet() {
		return trim($this->getAddress1()." ".$this->getAddress2());
	}
	public function setZip($zip) {
		$this->zip = $zip;
		return $this;
	}
	public function getZip() {
		return $this->zip;
	}
	public function setCity($city) {
		$this->city = $city;
		return $this;
	}
	public function getCity() {
		return $this->city;
	}
	public function setReference($reference) {
		$this->reference = $reference;
		return $this;
	}
	public function getReference() {
		return $this->reference;
	}
	public function setCountry($country) {
		if (strlen($country) != 2) {
			throw new \Exception('Country code must be 2 letters');
		}
		$this->country = strtoupper($country);
		return $this;
	}
	public function getCountry() {
		return $this->country;
	}
	public function setTags($tags) {
		$this->tags = $tags;
		return $this;
	}
	public function addTag($tag) {
		if (!in_array($tag, $this->tags)) {
			$this->tags[] = $tag;
		}
		return $this;
	}
	public function getTags() {
		return $this->tags;
	}
	public function addMetafield(\Kund24\Api\Models\ContactMetafield $metafield) {
		$metafield->setContact($this);
		$this->metafields[] = $metafield;
		return $this;
	}
	public function getMetafields() {
		return $this->metafields;
	}
	public function setNote($note) {
		$this->note = $note;
		return $this;
	}
	public function getNote() {
		return $this->note;
	}
	public function jsonUnserialize($data) {
		if (array_key_exists("id", $data)) {
			$this->setId($data['id']);
		}
		if (array_key_exists("is_company", $data)) {
			$this->setIsCompany($data['is_company']);
		}
		if (array_key_exists("name", $data)) {
			$this->setName($data['name']);
		}
		if (array_key_exists("first_name", $data)) {
			$this->setFirstName($data['first_name']);
		}
		if (array_key_exists("last_name", $data)) {
			$this->setLastName($data['last_name']);
		}
		if (array_key_exists("email", $data)) {
			$this->setEmail($data['email']);
		}
		if (array_key_exists("company", $data)) {
			$this->setCompany($data['company']);
		}
		if (array_key_exists("country", $data)) {
			$this->setCountry($data['country']);
		}
		if (array_key_exists("phone", $data)) {
			$this->setPhone($data['phone']);
		}
		if (array_key_exists("address1", $data)) {
			$this->setAddress1($data['address1']);
		}
		if (array_key_exists("address2", $data)) {
			$this->setAddress1($data['address2']);
		}
		if (array_key_exists("zip", $data)) {
			$this->setPhone($data['zip']);
		}
		if (array_key_exists("city", $data)) {
			$this->setPhone($data['city']);
		}
		if (array_key_exists("note", $data)) {
			$this->setNote($data['note']);
		}
		if (array_key_exists("parent", $data)) {
			$this->setCompany($data['parent']['name']);
		}
		if (array_key_exists("reference", $data)) {
			$this->setReference($data['reference']);
		}
		if (array_key_exists("tags", $data)) {
			$tags = array();
			foreach ($data['tags'] as $tag) {
				$tags[] = $tag['title'];
			}
			$this->setTags($tags);
		}
		if (array_key_exists("metafields", $data)) {
			foreach ($data['metafields'] as $metafieldData) {
				$metafield = new \Kund24\Api\Models\ContactMetafield();
				$metafield->jsonUnserialize($metafieldData);
				$this->addMetafield($metafield);
			}
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"is_company" => $this->getIsCompany(),
        	"first_name" => $this->getFirstName(),
        	"last_name" => $this->getLastName(),
        	"name" => $this->getName(),
        	"company" => $this->getCompany(),
        	"email" => $this->getEmail(),
        	"phone" => $this->getPhone(),
        	"address1" => $this->getAddress1(),
        	"address2" => $this->getAddress2(),
        	"zip" => $this->getZip(),
        	"city" => $this->getCity(),
        	"country" => $this->getCountry(),
        	"note" => $this->getNote(),
        	"reference" => $this->getReference(),
        	"tags" => $this->getTags(),
        	"metafields" => array_map(function($metafield) { return $metafield->jsonSerialize(); }, $this->getMetafields()),
        );
    }
}