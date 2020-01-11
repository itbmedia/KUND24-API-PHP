<?php

namespace Kund24\Api\Models;

class Post implements \JsonSerializable {
	private $id;

	private $title;

	private $handle;

	private $category;

	private $content;

	private $commentCount = 0;

	private $socialMediaContent;

	private $url;

	private $publishAt;

	private $synced;

	private $published;

	private $blog;

	private $user;

	private $tags = array();

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
	public function setCommentCount($commentCount) {
		$this->commentCount = $commentCount;
		return $this;
	}
	public function getCommentCount() {
		return $this->commentCount;
	}
	public function setHandle($handle) {
		$this->handle = $handle;
		return $this;
	}
	public function getHandle() {
		return $this->handle;
	}
	public function setCategory($category) {
		$this->category = $category;
		return $this;
	}
	public function getCategory() {
		return $this->category;
	}
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	public function getContent() {
		return $this->content;
	}
	public function getTextContent() {
        $html = new \Html2Text\Html2Text($this->getContent());
        return $html->getText();
    }
    public function getExcerpt($maxLength = 200) {
    	$content = $this->getTextContent();
    	if (mb_strlen($content) > $maxLength) {
    		return mb_substr($content, 0, $maxLength-3).'...';
    	}
    	return $content;
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
	public function setSynced($synced) {
		$this->synced = $synced;
		return $this;
	}
	public function getSynced() {
		return $this->synced;
	}
	public function setPublished($published) {
		$this->published = $published;
		return $this;
	}
	public function getPublished() {
		return $this->published;
	}
	public function setPublishAt($publishAt) {
		$this->publishAt = $publishAt;
		return $this;
	}
	public function getPublishAt() {
		return $this->publishAt;
	}
	public function setTags($tags) {
		$this->tags = $tags;
		return $this;
	}
	public function addTag($tag) { 
		if (!in_array($tag, $this->tags)) {
			$this->tags[] = $tag;
		}
		return $this;
	}
	public function getTags() {
		return $this->tags;
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
		if (array_key_exists("comment_count", $data)) {
			$this->setCommentCount($data['comment_count']);
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
		if (array_key_exists("synced", $data)) {
			$this->setSynced($data['synced']);
		}
		if (array_key_exists("published", $data)) {
			$this->setPublished($data['published']);
		}
		if (array_key_exists("category", $data)) {
			if ($data['category']) {
				$this->setCategory($data['category']['title']);
			}
			ELSE {
				$this->setCategory(null);
			}
		}
		if (array_key_exists("tags", $data)) {
			$tags = array();
			foreach ($data['tags'] as $tag) {
				if (is_string($tag)) {
					$tags[] = $tag;
				}
				ELSE {
					$tags[] = $tag['title'];
				}
			}
			$this->setTags($tags);
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
        	"tags" => $this->getTags(),
        	"url" => $this->getUrl(),
        	"blog" => (($this->getBlog()) ? $this->getBlog()->jsonSerialize():null),
        	"user" => (($this->getUser()) ? $this->getUser()->jsonSerialize():null),
        );
    }
}