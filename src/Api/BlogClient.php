<?php
namespace Kund24\Api;

use \Kund24\Api\Client;

class BlogClient extends Client {

    public function getBlogPosts($blogId, $params = array("offset" => 0, "limit" => 10)) {
        /*
            @Params offset, limit, author, tagged, category, month
        */
        $result = $this->makeCurlRequest('GET', '/blogs/'.$blogId.'/posts.json', $params);

        foreach ($result['posts'] as $key => $p) {
            $post = new \Kund24\Api\Models\Post();
            $post->jsonUnserialize($p);
            $result['posts'][$key] = $post;
        }

        return $result;
    }
    public function getBlogPost($blogId, $postId, $offset = 0, $limit = 10) {
        $result = $this->makeCurlRequest('GET', '/blogs/'.$blogId.'/posts/'.$postId.'.json', $params);

        $post = new \Kund24\Api\Models\Post();
        $post->jsonUnserialize($result['post']);
        $result['post'] = $post;

        foreach ($result['comments'] as $key => $c) {
            $comment = new \Kund24\Api\Models\PostComment();
            $comment->jsonUnserialize($c);
            $result['comments'][$key] = $comment;
        }

        foreach ($result['similar_posts'] as $key => $p) {
            $post = new \Kund24\Api\Models\Post();
            $post->jsonUnserialize($p);
            $result['similar_posts'][$key] = $post;
        }

        return $result;
    }
}