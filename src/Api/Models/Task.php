<?php

namespace Kund24\Api\Models;

class Task implements \JsonSerializable {
	private $id;

	private $contact;

	private $title;

	private $content;

	private $user;

	private $creator;

	private $taskAt;

	private $taskEndAt;

	private $projectTask;

	public function setContact(\Kund24\Api\Models\Contact $contact) {
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
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	public function getContent() {
		return $this->content;
	}
	public function setTaskAt($taskAt) {
		$this->taskAt = $taskAt;
		return $this;
	}
	public function getTaskAt() {
		return $this->taskAt;
	}
	public function setTaskEndAt($taskEndAt) {
		$this->taskEndAt = $taskEndAt;
		return $this;
	}
	public function getTaskEndAt() {
		return $this->taskEndAt;
	}
	public function setCreator(\Kund24\Api\Models\User $creator) {
		$this->creator = $creator;
		return $this;
	}
	public function getCreator() {
		return $this->creator;
	}
	public function setUser(\Kund24\Api\Models\User $user) {
		$this->user = $user;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}
	public function setProjectTask(\Kund24\Api\Models\ProjectTask $projectTask) {
		$this->projectTask = $projectTask;
		return $this;
	}
	public function getProjectTask() {
		return $this->projectTask;
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
		if (array_key_exists("content", $data)) {
			$this->setContent($data['content']);
		}
		if (array_key_exists("task_at", $data)) {
			$this->setTaskAt($data['task_at']);
		}
		if (array_key_exists("task_end_at", $data)) {
			$this->setTaskEndAt($data['task_end_at']);
		}
		if ((array_key_exists("contact", $data)) && ($data['contact'])) {
			$contact = new \Kund24\Api\Models\Contact();
			$contact->jsonUnserialize($data['contact']);
			$this->setContact($contact);
		}
		if ((array_key_exists("creator", $data)) && ($data['creator'])) {
			$creator = new \Kund24\Api\Models\User();
			$creator->jsonUnserialize($data['creator']);
			$this->setCreator($creator);
		}
		if ((array_key_exists("project_task", $data)) && ($data['project_task'])) {
			$projectTask = new \Kund24\Api\Models\ProjectTask();
			$projectTask->jsonUnserialize($data['project_task']);
			$this->setProjectTask($projectTask);
		}
		if ((array_key_exists("user", $data)) && ($data['user'])) {
			$user = new \Kund24\Api\Models\User();
			$user->jsonUnserialize($data['user']);
			$this->setUser($user);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"content" => $this->getContent(),
        	"task_at" => $this->getTaskAt(),
        	"task_end_at" => $this->getTaskEndAt(),
        	"project_task" => (($this->getProjectTask()) ? $this->getProjectTask()->jsonSerialize():null),
        	"contact" => (($this->getContact()) ? $this->getContact()->jsonSerialize():null),
        	"user" => (($this->getUser()) ? $this->getUser()->jsonSerialize():null),
        );
    }
}