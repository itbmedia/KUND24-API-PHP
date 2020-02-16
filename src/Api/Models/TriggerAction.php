<?php

namespace Kund24\Api\Models;

class TriggerAction implements \JsonSerializable {

	private $trigger;

	private $action = 'webhook.send';

	private $url;

	public function setTrigger(\Kund24\Api\Models\Trigger $trigger) {
		$this->trigger = $trigger;
		return $this;
	}
	public function getTrigger() {
		return $this->trigger;
	}
	public function setAction($action) {
		$this->action = $action;
		return $this;
	}
	public function getAction() {
		return $this->action;
	}
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}
	public function getUrl() {
		return $this->url;
	}
	public function jsonUnserialize($data) {
		if (array_key_exists("action", $data)) {
			$this->setAction($data['action']);
		}
		if (array_key_exists("url", $data)) {
			$this->setAction($data['url']);
		}
	}
	public function jsonSerialize() {
        return array(
        	"action" => $this->getAction(),
        	"url" => $this->getUrl(),
        );
    }
}