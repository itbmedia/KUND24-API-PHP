<?php

namespace Kund24\Api\Models;

class Contact implements \JsonSerializable {

	private $id;

	private $email;

	private $bolag;

	private $parent = null;

	private $isCompany = false;

	private $firstName;

	private $lastName;

	private $title;

	private $company;

	private $phone;

	private $address1;

	private $address2;

	private $zip;

	private $orgnr;

	private $city;

	private $country = 'SE';

	private $usePostal = false;

	private $postalAddress1;

	private $postalAddress2;

	private $postalZip;

	private $postalCity;

	private $reference;

	private $note;

	private $metafields = array();

	private $tags = array();

	private $addresses = array();

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function setBolag(\Kund24\Api\Models\Bolag $bolag) {
		$this->bolag = $bolag;
		return $this;
	}
	public function getBolag() {
		return $this->bolag;
	}
	public function setOrgnr($orgnr) {
		$this->orgnr = $orgnr;
		return $this;
	}
	public function getOrgnr() {
		return $this->orgnr;
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
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
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
	public function addAddress(\Kund24\Api\Models\ContactAddress $address) {
		$address->setContact($this);
		$this->addresses[] = $address;
		return $this;
	}
	public function getAddresses() {
		return $this->addresses;
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
	public function setParent(\Kund24\Api\Models\Contact $parent) {
		$this->parent = $parent;
		return $this;
	}
	public function getParent() {
		return $this->parent;
	}
	public function setUsePostal($usePostal) {
        $this->usePostal = (($usePostal) ? true:false);
        return $this;
    }
    public function getUsePostal() {
        return $this->usePostal;
    }
    public function setPostalAddress1($postalAddress1) {
		$this->postalAddress1 = $postalAddress1;
		return $this;
	}
    public function getPostalAddress1() {
		return $this->postalAddress1;
	}
	public function setPostalAddress2($postalAddress2) {
		$this->postalAddress2 = $postalAddress2;
		return $this;
	}
	public function getPostalAddress2() {
		return $this->postalAddress2;
	}
	public function getPostalStreet() {
		return trim($this->getPostalAddress1()." ".$this->getPostalAddress2());
	}
	public function setPostalZip($postalZip) {
		$this->postalZip = $postalZip;
		return $this;
	}
	public function getPostalZip() {
		return $this->postalZip;
	}
	public function setPostalCity($postalCity) {
		$this->postalCity = $postalCity;
		return $this;
	}
	public function getPostalCity() {
		return $this->postalCity;
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
		if (array_key_exists("title", $data)) {
			$this->setTitle($data['title']);
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
			$this->setAddress2($data['address2']);
		}
		if (array_key_exists("zip", $data)) {
			$this->setZip($data['zip']);
		}
		if (array_key_exists("city", $data)) {
			$this->setCity($data['city']);
		}
		if (array_key_exists("note", $data)) {
			$this->setNote($data['note']);
		}
		if (array_key_exists("parent", $data)) {
			$this->setCompany($data['parent']['name']);
			$parent = new \Kund24\Api\Models\Contact();
        	$parent->jsonUnserialize($data['parent']);
        	$this->setParent($parent);
		}
		if (array_key_exists("reference", $data)) {
			$this->setReference($data['reference']);
		}
		if ((array_key_exists("tags", $data)) && ($data['tags'])) {
			$tags = array();
			foreach ($data['tags'] as $tag) {
				if (is_string($tag)) {
					$tags[] = $tag;
				}
				ELSE {
					$tags[] = $tag['title'];
				}
			}
			$this->setTags($tags);
		}
		if ((array_key_exists("addresses", $data)) && ($data['addresses'])) {
			$addresses = array();
			foreach ($data['addresses'] as $adr) {
				$address = new \Kund24\Api\Models\ContactAddress();
				$address->jsonUnserialize($adr);
				$this->addAddress($address);
			}
		}
		if ((array_key_exists("bolag", $data)) && ($data['bolag'])) {
			$bolag = new \Kund24\Api\Models\Bolag();
			$bolag->jsonUnserialize($data['bolag']);
			$this->setBolag($bolag);
		}
		if ((array_key_exists("metafields", $data)) && ($data['metafields'])) {
			foreach ($data['metafields'] as $metafieldData) {
				$metafield = new \Kund24\Api\Models\ContactMetafield();
				$metafield->jsonUnserialize($metafieldData);
				$this->addMetafield($metafield);
			}
		}
		if (array_key_exists("use_postal", $data)) {
			$this->setUsePostal($data['use_postal']);
		}
		if (array_key_exists("postal_address1", $data)) {
			$this->setPostalAddress1($data['postal_address1']);
		}
		if (array_key_exists("postal_address2", $data)) {
			$this->setPostalAddress2($data['postal_address2']);
		}
		if (array_key_exists("postal_zip", $data)) {
			$this->setPostalZip($data['postal_zip']);
		}
		if (array_key_exists("postal_city", $data)) {
			$this->setPostalCity($data['postal_city']);
		}
		if (array_key_exists("orgnr", $data)) {
			$this->setOrgnr($data['orgnr']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"is_company" => $this->getIsCompany(),
        	"first_name" => $this->getFirstName(),
        	"last_name" => $this->getLastName(),
        	"title" => $this->getTitle(),
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
        	"orgnr" => $this->getOrgnr(),
        	"tags" => $this->getTags(),
        	"metafields" => array_map(function($metafield) { return $metafield->jsonSerialize(); }, $this->getMetafields()),
        	"addresses" => array_map(function($address) { return $address->jsonSerialize(); }, $this->getAddresses()),
        	"use_postal" => $this->getUsePostal(),
        	"postal_address1" => $this->getPostalAddress1(),
        	"postal_address2" => $this->getPostalAddress2(),
        	"postal_zip" => $this->getPostalZip(),
        	"postal_city" => $this->getPostalCity(),
        );
    }
}