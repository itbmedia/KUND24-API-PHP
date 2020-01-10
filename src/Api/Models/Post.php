<?php

namespace Kund24\Api\Models;

class Post implements \JsonSerializable {
	private $id;

	private $title;

	private $handle;

	private $content;

	private $socialMediaContent;

	private $url;

	private $publishAt;

	private $blog;

	private $user;

	public function setUser(\Kund24\Api\Models\User $user) {
		$this->user = $user;
		return $this;
	}
	public function getUser() {
		return $this->user;
	}

	public function setBlog(\Kund24\Api\Models\Blog $blog) {
		$this->blog = $blog;
		return $this;
	}
	public function getBlog() {
		return $this->blog;
	}

	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getTitle() {
		return $this->title;
	}
	public function setHandle($handle) {
		$this->handle = $handle;
		return $this;
	}
	public function getHandle() {
		return $this->handle;
	}
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	public function getContent() {
		return $this->content;
	}
	public function setSocialMediaContent($socialMediaContent) {
		$this->socialMediaContent = $socialMediaContent;
		return $this;
	}
	public function getSocialMediaContent() {
		return $this->socialMediaContent;
	}
	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}
	public function getUrl() {
		return $this->url;
	}
	public function setPublishAt($publishAt) {
		$this->publishAt = $publishAt;
		return $this;
	}
	public function getPublishAt() {
		return $this->publishAt;
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
		if (array_key_exists("handle", $data)) {
			$this->setHandle($data['handle']);
		}
		if (array_key_exists("content", $data)) {
			$this->setContent($data['content']);
		}
		if (array_key_exists("social_media_content", $data)) {
			$this->setSocialMediaContent($data['social_media_content']);
		}
		if (array_key_exists("publish_at", $data)) {
			$this->setPublishAt($data['publish_at']);
		}
		if (array_key_exists("url", $data)) {
			$this->setUrl($data['url']);
		}
		if (array_key_exists("blog", $data)) {
			$blog = new \Kund24\Api\Models\Blog();
			$blog->jsonUnserialize($data['blog']);
			$this->setBlog($blog);
		}
		if (array_key_exists("user", $data)) {
			$user = new \Kund24\Api\Models\User();
			$user->jsonUnserialize($data['user']);
			$this->setUser($user);
		}
	}
	public function jsonSerialize() {
        return array(
        	"id" => $this->getId(),
        	"title" => $this->getTitle(),
        	"handle" => $this->getHandle(),
        	"content" => $this->getContent(),
        	"social_media_content" => $this->getSocialMediaContent(),
        	"publish_at" => $this->getPublishAt(),
        	"url" => $this->getUrl(),
        	"blog" => (($this->getBlog()) ? $this->getBlog()->jsonSerialize():null),
        	"user" => (($this->getUser()) ? $this->getUser()->jsonSerialize():null),
        );
    }
}