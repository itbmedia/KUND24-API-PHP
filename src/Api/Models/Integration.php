<?php

namespace Kund24\Api\Models;

class Integration implements \JsonSerializable {
	private $id;

	private $badgeCount;

	public function setBadgeCount($badgeCount) {
		$this->badgeCount = $badgeCount;
		return $this;
	}
	public function getBadgeCount() {
		return $this->badgeCount;
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
		if (array_key_exists("badge_count", $data)) {
			$this->setBadgeCount($data['badge_count']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"badge_count" => $this->getBadgeCount(),
        );
    }
}