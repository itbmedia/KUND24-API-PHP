<?php

namespace Kund24\Api\Models;

class BoardRow implements \JsonSerializable {
	private $id;

	private $title;

	private $board;

	private $group;

	private $values = array();

	public function createValue(\Kund24\Api\Models\BoardColumn $column) {
		$rowValue = new \Kund24\Api\Models\BoardRowValue();
		$rowValue->setColumn($column);
		$this->addValue($rowValue);
		return $rowValue;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setBoard(\Kund24\Api\Models\Board $board) {
		$this->board = $board;
		return $this;
	}
	public function getBoard() {
		return $this->board;
	}
	public function setGroup(\Kund24\Api\Models\BoardGroup $group) {
		$this->group = $group;
		return $this;
	}
	public function getGroup() {
		return $this->group;
	}
	public function setValues($values) {
		$this->values = $values;
		return $this;
	}
	public function getValues() {
		return $this->values;
	}
	public function addValue(\Kund24\Api\Models\BoardRowValue $rowValue) {
		$rowValue->setRow($this);
		$this->values[] = $rowValue;
		return $this;
	}
	public function getValueById($id) {
		foreach ($this->getValues() as $value) {
			if ($value->getId() == $id) {
				return $value;
			}
		}
		return null;
	}
	public function setValueByColumnName($name, $value) {
		return $this->setValueByColumn($this->getBoard()->getColumnByName($name), $value);
	}
	public function getValueByColumnName($name) {
		return $this->getValueByColumn($this->getBoard()->getColumnByName($name));
	}
	public function setValueByColumn(\Kund24\Api\Models\BoardColumn $column, $value) {
		$rowValue = $this->getValueByColumn($column, true);
		$rowValue->setValue($value);
		return $this;
    }
	public function getValueByColumn(\Kund24\Api\Models\BoardColumn $column, $create = false) {
        foreach ($this->getValues() as $value) {
            if ($value->getColumn()->getId() == $column->getId()) {
                return $value;
            }
        }
        if ($create) {
			return $this->createValue($column);
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
		if (array_key_exists("values", $data)) {
			foreach ($data['values'] as $valueData) {
				$rowValue = new \Kund24\Api\Models\BoardRowValue();
				$this->addValue($rowValue);
				$rowValue->jsonUnserialize($valueData);
			}
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"values" => array_map(function($value) { return $value->jsonSerialize(); }, $this->getValues()),
        );
    }
}