<?php

namespace Kund24\Api\Models;

class Board implements \JsonSerializable {
	private $id;

	private $title;

	private $columns = array();

	private $tags = array();

	public function createRow() {
		$row = new \Kund24\Api\Models\BoardRow();
		$row->setBoard($this);
		return $row;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setColumns($columns) {
		$this->columns = $columns;
		return $this;
	}
	public function getColumns() {
		return $this->columns;
	}
	public function addColumn(\Kund24\Api\Models\BoardColumn $boardColumn) {
		$boardColumn->setBoard($this);
		$this->columns[] = $boardColumn;
		return $this;
	}
	public function getTags() {
		return $this->tags;
	}
	public function addTag(\Kund24\Api\Models\BoardTag $boardTag) {
		$this->tags[] = $boardTag;
		return $this;
	}
	public function getColumnById($id) {
		foreach ($this->getColumns() as $column) {
			if ($column->getId() == $id) {
				return $column;
			}
		}
		return null;
	}
	public function getColumnByName($name) {
		foreach ($this->getColumns() as $column) {
			if (mb_strtolower($column->getTitle()) == mb_strtolower($name)) {
				return $column;
			}
		}
		return null;
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
		if (array_key_exists("columns", $data)) {
			foreach ($data['columns'] as $columnData) {
				$column = new \Kund24\Api\Models\BoardColumn();
				$column->jsonUnserialize($columnData);
				$this->addColumn($column);
			}
		}
		if (array_key_exists("tags", $data)) {
			foreach ($data['tags'] as $tagData) {
				$tag = new \Kund24\Api\Models\BoardTag();
				$tag->jsonUnserialize($tagData);
				$this->addTag($tag);
			}
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"columns" => array_map(function($column) { return $column->jsonSerialize(); }, $this->getColumns()),
        	"tags" => array_map(function($tag) { return $tag->jsonSerialize(); }, $this->getTags()),
        );
    }
}