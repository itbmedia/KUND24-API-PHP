<?php

namespace Kund24\Api\Models;

class ProjectTask implements \JsonSerializable {
	private $id;

	private $title;

	private $content;

	private $type;

	private $status;  

	private $project;

	private $user;

	private $reference;

	private $logs = array();

	private $taskAt;

	private $taskEndAt;

	private $estimatedMinutes;

	private $creator;

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
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	public function getType() {
		return $this->type;
	}
	public function setStatus($status) {
		$this->status = $status;
		return $this;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setReference($reference) {
		$this->reference = $reference;
		return $this;
	}
	public function getReference() {
		return $this->reference;
	}
	public function addLog(\Kund24\Api\Models\ProjectTaskLog $taskLog) {
		$this->logs[] = $taskLog;
		return $this;
	}
	public function setProject(\Kund24\Api\Models\Project $project) {
		$this->project = $project;
		return $this;
	}
	public function getProject() {
		return $this->project;
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
	public function setEstimatedMinutes($estimatedMinutes) {
		$this->estimatedMinutes = $estimatedMinutes;
		return $this;
	}
	public function getEstimatedMinutes() {
		return $this->estimatedMinutes;
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
		if (array_key_exists("reference", $data)) {
			$this->setReference($data['reference']);
		}
		if (array_key_exists("status", $data)) {
			$this->setStatus($data['status']);
		}
		if (array_key_exists("type", $data)) {
			$this->setType($data['type']);
		}
		if (array_key_exists("estimated_minutes", $data)) {
			$this->setEstimatedMinutes($data['estimated_minutes']);
		}
		if (array_key_exists("task_at", $data)) {
			$this->setTaskAt($data['task_at']);
		}
		if (array_key_exists("task_end_at", $data)) {
			$this->setTaskEndAt($data['task_end_at']);
		}
		if ((array_key_exists("project", $data)) && ($data['project'])) {
			$project = new \Kund24\Api\Models\Project();
			$project->jsonUnserialize($data['project']);
			$this->setProject($project);
		}
		if ((array_key_exists("creator", $data)) && ($data['creator'])) {
			$creator = new \Kund24\Api\Models\User();
			$creator->jsonUnserialize($data['creator']);
			$this->setCreator($creator);
		}
		if ((array_key_exists("user", $data)) && ($data['user'])) {
			$user = new \Kund24\Api\Models\User();
			$user->jsonUnserialize($data['user']);
			$this->setUser($user);
		}
		if ((array_key_exists("logs", $data)) && ($data['logs'])) {
			foreach ($data['logs'] as $log) {
				$taskLog = new \Kund24\Api\Models\ProjectTaskLog();
				$taskLog->jsonUnserialize($log);
				$this->addLog($taskLog);
			}
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"content" => $this->getContent(),
        	"reference" => $this->getReference(),
        	"type" => $this->getType(),
        	"status" => $this->getStatus(),
        	"estimated_minutes" => $this->getEstimatedMinutes(),
        	"task_at" => $this->getTaskAt(),
        	"task_end_at" => $this->getTaskEndAt(),
        	"user" => (($this->getUser()) ? $this->getUser()->jsonSerialize():null),
        );
    }
}