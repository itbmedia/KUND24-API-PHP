<?php

namespace Kund24\Api\Models;

class ProjectTask implements \JsonSerializable {
	private $id;

	private $title;

	private $project;

	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setProject(\Kund24\Api\Models\Project $project) {
		$this->project = $project;
		return $this;
	}
	public function getProject() {
		return $this->project;
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
		if (array_key_exists("project", $data)) {
			$project = new \Kund24\Api\Models\Project();
			$project->jsonUnserialize($data['project']);
			$this->setContact($project);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"project" => (($this->getProject()) ? $this->getProject()->jsonSerialize():null),
        );
    }
}