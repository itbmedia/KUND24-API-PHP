<?php

namespace Kund24\Api\Models;

class ContactAddress implements \JsonSerializable {

	private $id;

	private $title;

	private $email;

	private $phone;

	private $address1;

	private $address2;

	private $zip;

	private $city;

	private $country = 'SE';

	private $usePostal = false;

	private $postalAddress1;

	private $postalAddress2;

	private $postalZip;

	private $postalCity;

	private $contact;

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
	public function setContact($contact) {
		$this->contact = $contact;
		return $this;
	}
	public function getContact() {
		return $this->contact;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
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
	public function setUsePostal($usePostal) {
        $this->usePostal = (($usePostal) ? true:false);
        return $this;
    }
    public function getUsePostal() {
        return $this->usePostal;
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
		if (array_key_exists("title", $data)) {
			$this->setTitle($data['title']);
		}
		if (array_key_exists("email", $data)) {
			$this->setEmail($data['email']);
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
			$this->setPhone($data['zip']);
		}
		if (array_key_exists("city", $data)) {
			$this->setPhone($data['city']);
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
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"email" => $this->getEmail(),
        	"phone" => $this->getPhone(),
        	"address1" => $this->getAddress1(),
        	"address2" => $this->getAddress2(),
        	"zip" => $this->getZip(),
        	"city" => $this->getCity(),
        	"country" => $this->getCountry(),
        	"use_postal" => $this->getUsePostal(),
        	"postal_address1" => $this->getPostalAddress1(),
        	"postal_address2" => $this->getPostalAddress2(),
        	"postal_zip" => $this->getPostalZip(),
        	"postal_city" => $this->getPostalCity(),
        );
    }
}