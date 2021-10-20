<?php

namespace Kund24\Api\Models;

class BoardRowValue implements \JsonSerializable {
	private $id;

	private $value;

	private $row;

	private $column;

	public function setValue($value) {
		$this->value = $value;
		return $this;
	}
	public function getValue() {
		return $this->value;
	}
	public function setRow(\Kund24\Api\Models\BoardRow $boardRow) {
		$this->row = $boardRow;
		return $this;
	}
	public function getRow() {
		return $this->row;
	}
	public function setColumn(\Kund24\Api\Models\BoardColumn $boardColumn) {
		$this->column = $boardColumn;
		return $this;
	}
	public function getColumn() {
		return $this->column;
	}
	public function getColumnId() {
		return $this->getColumn()->getId();
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
		if (array_key_exists("value", $data)) {
			$this->setValue($data['value']);
		}
		if (array_key_exists("column_id", $data)) {
			$column = $this->getRow()->getBoard()->getColumnById($data['column_id']);
			if ($column) {
				$this->setColumn($column);
			}
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"value" => $this->getValue(),
        	"column_id" => $this->getColumnId(),
        );
    }
}