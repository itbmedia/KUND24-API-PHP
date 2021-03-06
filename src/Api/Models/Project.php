<?php

namespace Kund24\Api\Models;

class Project implements \JsonSerializable {
	private $id;

	private $contact;

	private $field;

	private $title;

	private $type = 'standard';

	private $note;

	private $reference;

	private $archived; 

	private $users = array();

	private $groups = array();

	private $uploads = array();

	public function setContact(\Kund24\Api\Models\Contact $contact) {
		$this->contact = $contact;
		return $this;
	}
	public function getContact() {
		return $this->contact;
	}
	public function setField($field) {
		$this->field = $field;
		return $this;
	}
	public function getField() {
		return $this->field;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	public function getType() {
		return $this->type;
	}
	public function setNote($note) {
		$this->note = $note;
		return $this;
	}
	public function getNote() {
		return $this->note;
	}
	public function setArchived($archived) {
		$this->archived = $archived;
		return $this;
	}
	public function getArchived() {
		return $this->archived;
	}
	public function setReference($reference) {
		$this->reference = $reference;
		return $this;
	}
	public function getReference() {
		return $this->reference;
	}
	public function getUploads() {
		return $this->uploads;
	}
	public function addUpload(\Kund24\Api\Models\Upload $upload) {
		$this->uploads[] = $upload;
		return $this;
	}
	public function getUsers() {
		return $this->users;
	}
	public function addUser(\Kund24\Api\Models\User $user) {
		$this->users[] = $user;
		return $this;
	}
	public function getGroups() {
		return $this->groups;
	}
	public function addGroup(\Kund24\Api\Models\UserGroup $group) {
		$this->groups[] = $group;
		return $this;
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
		if (array_key_exists("type", $data)) {
			$this->setTitle($data['type']);
		}
		if (array_key_exists("note", $data)) {
			$this->setNote($data['note']);
		}
		if (array_key_exists("reference", $data)) {
			$this->setReference($data['reference']);
		}
		if (array_key_exists("archived", $data)) {
			$this->setArchived($data['archived']);
		}
		if ((array_key_exists("contact", $data)) && ($data['contact'])) {
			$contact = new \Kund24\Api\Models\Contact();
			$contact->jsonUnserialize($data['contact']);
			$this->setContact($contact);
		}
		if (array_key_exists("field", $data)) {
			$this->setField($data['field']['title']);
		}
		if ((array_key_exists("files", $data)) && ($data['files'])) {
			foreach ($data['files'] as $upl) {
				$upload = new \Kund24\Api\Models\Upload();
				$upload->jsonUnserialize($upl);
				$this->addUpload($upload);
			}
		}
		if ((array_key_exists("users", $data)) && ($data['users'])) {
			foreach ($data['users'] as $usr) {
				$user = new \Kund24\Api\Models\User();
				$user->jsonUnserialize($usr);
				$this->addUser($user);
			}
		}
		if ((array_key_exists("groups", $data)) && ($data['groups'])) {
			foreach ($data['groups'] as $grp) {
				$group = new \Kund24\Api\Models\UserGroup();
				$group->jsonUnserialize($grp);
				$this->addGroup($group);
			}
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"type" => $this->getType(),
        	"note" => $this->getNote(),
        	"field" => $this->getField(),
        	"archived" => $this->getArchived(),
        	"reference" => $this->getReference(),
        	"contact" => (($this->getContact()) ? $this->getContact()->jsonSerialize():null),
        	"files" => array_map(function($upload) { return $upload->jsonSerialize(); }, $this->getUploads()),
        	"users" => array_map(function($user) { return $user->jsonSerialize(); }, $this->getUsers()),
        	"groups" => array_map(function($group) { return $group->jsonSerialize(); }, $this->getGroups()),
        );
    }
}