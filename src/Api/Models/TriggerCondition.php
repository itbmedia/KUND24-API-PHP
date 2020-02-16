<?php

namespace Kund24\Api\Models;

class TriggerCondition implements \JsonSerializable {

	private $trigger;

	private $field;

	private $value;

	private $target;

	private $operator = 'contains';

	private $inclusive = false;

	public function setTrigger(\Kund24\Api\Models\Trigger $trigger) {
		$this->trigger = $trigger;
		return $this;
	}
	public function getTrigger() {
		return $this->trigger;
	}
	public function setField($field) {
		$this->field = $field;
		return $this;
	}
	public function getField() {
		return $this->field;
	}
	public function setValue($value) {
		$this->value = $value;
		return $this;
	}
	public function getValue() {
		return $this->value;
	}
	public function setTarget($target) {
		$this->target = $target;
		return $this;
	}
	public function getTarget() {
		return $this->target;
	}
	public function setOperator($operator) {
		$this->operator = $operator;
		return $this;
	}
	public function getOperator() {
		return $this->operator;
	}
	public function setInclusive($inclusive) {
		$this->inclusive = $inclusive;
		return $this;
	}
	public function getInclusive() {
		return $this->inclusive;
	}
	public function jsonUnserialize($data) {
		if (array_key_exists("field", $data)) {
			$this->setField($data['field']);
		}
		if (array_key_exists("value", $data)) {
			$this->setValue($data['value']);
		}
		if (array_key_exists("target", $data)) {
			$this->setTarget($data['target']);
		}
		if (array_key_exists("operator", $data)) {
			$this->setOperator($data['operator']);
		}
		if (array_key_exists("inclusive", $data)) {
			$this->setInclusive($data['inclusive']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"field" => $this->getField(),
        	"value" => $this->getValue(),
        	"target" => $this->getTarget(),
        	"operator" => $this->getOperator(),
        	"inclusive" => $this->getInclusive(),
        );
    }
}