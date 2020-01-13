<?php

namespace Kund24\Api\Models;

class User implements \JsonSerializable {
	private $id;

	private $email;

	private $name;

	private $fullname;

	private $phone;

	private $avatar;

	private $group;

	private $roles = array();

	public function setName($name) {
		$this->name = $name;
		return $this;
	}
	public function getName() {
		return $this->name;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setFullname($fullname) {
		$this->fullname = $fullname;
		return $this;
	}
	public function getFullname() {
		return $this->fullname;
	}
	public function setPhone($phone) {
		$this->phone = $phone;
		return $this;
	}
	public function getPhone() {
		return $this->phone;
	}
	public function setAvatar($avatar) {
		$this->avatar = $avatar;
		return $this;
	}
	public function getAvatar() {
		return $this->avatar;
	}
	public function setRoles($roles) {
		$this->roles = $roles;
		return $this;
	}
	public function getRoles() {
		return $this->roles;
	}
	public function setGroup(\Kund24\Api\Models\UserGroup $group) {
		$this->group = $group;
		return $this;
	}
	public function getGroup() {
		return $this->group;
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
		if (array_key_exists("name", $data)) {
			$this->setName($data['name']);
		}
		if (array_key_exists("email", $data)) {
			$this->setEmail($data['email']);
		}
		if ((array_key_exists("group", $data)) && ($data['group'])) {
			$group = new \Kund24\Api\Models\UserGroup();
			$group->jsonUnserialize($data['group']);
			$this->setGroup($group);
		}
		if (array_key_exists("fullname", $data)) {
			$this->setFullname($data['fullname']);
		}
		if (array_key_exists("phone", $data)) {
			$this->setPhone($data['phone']);
		}
		if (array_key_exists("avatar", $data)) {
			$this->setAvatar($data['avatar']);
		}
		if (array_key_exists("roles", $data)) {
			$this->setRoles($data['roles']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"name" => $this->getName(),
        	"email" => $this->getEmail(),
        	"phone" => $this->getPhone(),
        	"group" => (($this->getGroup()) ? $this->getGroup()->jsonSerialize():null),
        );
    }
}