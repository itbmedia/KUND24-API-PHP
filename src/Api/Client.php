<?php

namespace Kund24\Api;

class Client {

	protected $apiKey;

    protected $accountId;

    protected $environment = 'production';

	protected $baseUrl = 'https://www.kund24.se/api';

    protected $sandboxBaseUrl = 'http://dev.kund24.se/api';

	public function __construct($accountId, $apiKey) {
        $this->accountId = $accountId;
		$this->apiKey = $apiKey;
	}
    public function setEnvironment($environment) {
        $this->environment = $environment;
    }
    public function getEnvironment() {
        return $this->environment;
    }
    public function getMe() {
        $result = $this->makeCurlRequest('GET', '/me.json');
        $user = new \Kund24\Api\Models\User();
        $user->jsonUnserialize($result['user']);

        return $user;
    }
    public function updateMe(\Kund24\Api\Models\User $user) {
        $data = $this->array_remove_null($user->jsonSerialize());
        $result = $this->makeCurlRequest('PUT', '/me.json', $data);

        $user = new \Kund24\Api\Models\User();
        $user->jsonUnserialize($result['user']);

        return $user;
    }
    public function sendRoleNotification($resource, $resourceId, $role, $message, $priority='normal') {
        $result = $this->makeCurlRequest('POST', '/notifications/'.$resource.'/'.$resourceId.'/roles/'.$role.'.json', array("content" => $message, "priority" => $priority));

        return $result;
    }
    public function sendUserNotification($resource, $resourceId, $userId, $message, $priority='normal') {
        $result = $this->makeCurlRequest('POST', '/notifications/'.$resource.'/'.$resourceId.'/users/'.$userId.'.json', array("content" => $message, "priority" => $priority));

        return $result;
    }
    public function listGroups(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;
        
        $result = $this->makeCurlRequest('GET', '/groups.json', $query);

        foreach ($result['groups'] as $key => $row) {
            $group = new \Kund24\Api\Models\UserGroup();
            $group->jsonUnserialize($row);
            $result['groups'][$key] = $group;
        }

        return $result;
    }
    public function listUsers(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;
        
        $result = $this->makeCurlRequest('GET', '/users.json', $query);

        foreach ($result['users'] as $key => $row) {
            $user = new \Kund24\Api\Models\User();
            $user->jsonUnserialize($row);
            $result['users'][$key] = $user;
        }

        return $result;
    }
    public function addContactsToEmailCampaign($campaignId, $contactIds = array(), $metafields = array()) {
        $data = array("contact_ids" => $contactIds, "metafields" => $metafields);
        return $this->makeCurlRequest('POST', '/email_campaigns/'.$campaignId.'/contacts.json', $data);
    }
    public function getBoard($id) {
        $result = $this->makeCurlRequest('GET', '/boards/'.$id.'.json');
        $board = new \Kund24\Api\Models\Board();
        $board->jsonUnserialize($result['board']);

        return $board;
    }
    public function createBoardGroup(\Kund24\Api\Models\Board $board, \Kund24\Api\Models\BoardGroup $group) {
        $group->setBoard($board);
        $data = $this->array_remove_null($group->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/boards/'.$board->getId().'/groups.json', $data);

        $boardGroup = new \Kund24\Api\Models\BoardGroup();
        $boardGroup->setBoard($board);
        $boardGroup->jsonUnserialize($result['group']);

        return $boardGroup;
    }
    public function getBoardGroup(\Kund24\Api\Models\Board $board, $id) {
        $result = $this->makeCurlRequest('GET', '/boards/'.$board->getId().'/groups/'.$id.'.json');
        $boardGroup = new \Kund24\Api\Models\BoardGroup();
        $boardGroup->setBoard($board);
        $boardGroup->jsonUnserialize($result['group']);

        return $boardGroup;
    }
    public function listBoardGroups(\Kund24\Api\Models\Board $board) {
        $result = $this->makeCurlRequest('GET', '/boards/'.$board->getId().'/groups.json');

        foreach ($result['groups'] as $key => $g) {
            $boardGroup = new \Kund24\Api\Models\BoardGroup();
            $boardGroup->setBoard($board);
            $boardGroup->jsonUnserialize($g);
            $result['groups'][$key] = $boardGroup;
        }

        return $result;
    }
    public function getBoardRow(\Kund24\Api\Models\Board $board, $id) {
        $result = $this->makeCurlRequest('GET', '/boards/'.$board->getId().'/rows/'.$id.'.json');
        $boardRow = new \Kund24\Api\Models\BoardRow();
        $boardRow->setBoard($board);
        $boardRow->jsonUnserialize($result['row']);

        return $boardRow;
    }
    public function searchBoardRows(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;
        
        $result = $this->makeCurlRequest('GET', '/board_rows/search.json', $query);

        foreach ($result['boards'] as $key => $boardData) {
            $board = new \Kund24\Api\Models\Board();
            $board->jsonUnserialize($boardData);
            $result['boards'][$key] = $board;
        }

        foreach ($result['groups'] as $key => $groupData) {
            $group = new \Kund24\Api\Models\BoardGroup();
            $group->jsonUnserialize($groupData);
            $result['groups'][$key] = $group;
        }

        foreach ($result['rows'] as $key => $row) {
            $boardRow = new \Kund24\Api\Models\BoardRow();

            foreach ($result['boards'] as $board) {
                if ($board->getId() == $row['board_id']) {
                    $boardRow->setBoard($board);
                    break;
                }
            }
            foreach ($result['groups'] as $group) {
                if ($group->getId() == $row['group_id']) {
                    $boardRow->setGroup($group);
                    break;
                }
            }
            $boardRow->jsonUnserialize($row);
            $result['rows'][$key] = $boardRow;
        }

        return $result;
    }
    public function createBoardRow(\Kund24\Api\Models\Board $board, $boardRow) {
        $boardRow->setBoard($board);
        $data = $this->array_remove_null($boardRow->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/boards/'.$board->getId().(($boardRow->getGroup()) ? '/groups/'.$boardRow->getGroup()->getId():'').'/rows.json', $data);

        $boardRow = new \Kund24\Api\Models\BoardRow();
        $boardRow->setBoard($board);
        $boardRow->jsonUnserialize($result['row']);

        return $boardRow;
    }
    public function moveBoardRow(\Kund24\Api\Models\Board $board, $boardRow, $group, $duplicate = false, $force = false) {
        $boardRow->setBoard($board);
        $data = array(
            "dupe" => $duplicate,
            "force" => $force,
            "group" => $this->array_remove_null($group->jsonSerialize())
        );
        $result = $this->makeCurlRequest('POST', '/boards/'.$board->getId().'/rows/'.$boardRow->getId().'/move.json', $data);

        $boardRow = new \Kund24\Api\Models\BoardRow();
        $boardRow->setBoard($group->getBoard());
        $boardRow->jsonUnserialize($result['row']);

        return $boardRow;
    }
    public function updateBoardRow(\Kund24\Api\Models\Board $board, $boardRow) {
        $boardRow->setBoard($board);
        $data = $this->array_remove_null($boardRow->jsonSerialize());
        $result = $this->makeCurlRequest('PUT', '/boards/'.$board->getId().'/rows/'.$boardRow->getId().'.json', $data);

        $boardRow = new \Kund24\Api\Models\BoardRow();
        $boardRow->setBoard($board);
        $boardRow->jsonUnserialize($result['row']);

        return $boardRow;
    }
    public function removeBoardRow(\Kund24\Api\Models\Board $board, $id) {
        $result = $this->makeCurlRequest('DELETE', '/boards/'.$board->getId().'/rows/'.$id.'.json');

        return array();
    }
    public function listBoardRowComments($boardId, $rowId) {
        $result = $this->makeCurlRequest('GET', '/boards/'.$boardId.'/rows/'.$rowId.'/comments.json', $query);

        foreach ($result['comments'] as $key => $row) {
            $comment = new \Kund24\Api\Models\BoardRowComment();
            $comment->jsonUnserialize($row);
            $result['comments'][$key] = $comment;
        }

        return $result;
    }
    public function createBoardRowComment($boardId, $rowId, \Kund24\Api\Models\BoardRowComment $comment) {
        $data = $this->array_remove_null($comment->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/boards/'.$boardId.'/rows/'.$rowId.'/comments.json', $data);

        $comment = new \Kund24\Api\Models\BoardRowComment();
        $comment->jsonUnserialize($result['comment']);

        return $comment;
    }
    public function createTicket(\Kund24\Api\Models\Ticket $ticket) {
        $data = $this->array_remove_null($ticket->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/tickets.json', $data);

        $ticket = new \Kund24\Api\Models\Ticket();
        $ticket->jsonUnserialize($result['ticket']);

        return $ticket;
    }
    public function updateTicket(\Kund24\Api\Models\Ticket $ticket) {
        $data = $this->array_remove_null($ticket->jsonSerialize());
        $result = $this->makeCurlRequest('PUT', '/tickets/'.$ticket->getId().'.json', $data);

        $ticket = new \Kund24\Api\Models\Ticket();
        $ticket->jsonUnserialize($result['ticket']);

        return $ticket;
    }
    public function getTicket($id) {
        $result = $this->makeCurlRequest('GET', '/tickets/'.$id.'.json');
        $ticket = new \Kund24\Api\Models\Ticket();
        $ticket->jsonUnserialize($result['ticket']);

        return $ticket;
    }
    public function listTickets(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;
        
        $result = $this->makeCurlRequest('GET', '/tickets.json', $query);

        foreach ($result['tickets'] as $key => $row) {
            $ticket = new \Kund24\Api\Models\Ticket();
            $ticket->jsonUnserialize($row);
            $result['tickets'][$key] = $ticket;
        }

        return $result;
    }
    public function createTicketEvent($ticketId, \Kund24\Api\Models\TicketEvent $ticketEvent) {
        $data = $this->array_remove_null($ticketEvent->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/tickets/'.$ticketId.'/events.json', $data);

        $ticket = new \Kund24\Api\Models\Ticket();
        $ticket->jsonUnserialize($result['ticket']);

        $ticketEvent = new \Kund24\Api\Models\TicketEvent();
        $ticketEvent->jsonUnserialize($result['event']);

        return $ticketEvent;
    }
    public function createContact(\Kund24\Api\Models\Contact $contact) {
        $data = $this->array_remove_null($contact->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/contacts.json', $data);

        $contact = new \Kund24\Api\Models\Contact();
        $contact->jsonUnserialize($result['contact']);

        return $contact;
    }
    public function updateContact(\Kund24\Api\Models\Contact $contact) {
        $data = $this->array_remove_null($contact->jsonSerialize());
        $result = $this->makeCurlRequest('PUT', '/contacts/'.$contact->getId().'.json', $data);

        $contact = new \Kund24\Api\Models\Contact();
        $contact->jsonUnserialize($result['contact']);

        return $contact;
    }
    public function getContact($id) {
        $result = $this->makeCurlRequest('GET', '/contacts/'.$id.'.json');
        $contact = new \Kund24\Api\Models\Contact();
        $contact->jsonUnserialize($result['contact']);

        return $contact;
    }
    public function listContacts(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;
        
        $result = $this->makeCurlRequest('GET', '/contacts.json', $query);

        foreach ($result['contacts'] as $key => $row) {
            $contact = new \Kund24\Api\Models\Contact();
            $contact->jsonUnserialize($row);
            $result['contacts'][$key] = $contact;
        }

        return $result;
    }
    public function removeContact($id) {
        $result = $this->makeCurlRequest('DELETE', '/contacts/'.$id.'.json');
        return array();
    }
    public function listContactComments($contactId, Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;
        
        $result = $this->makeCurlRequest('GET', '/contacts/'.$contactId.'/.json', $query);

        foreach ($result['comments'] as $key => $row) {
            $comment = new \Kund24\Api\Models\Comment();
            $comment->jsonUnserialize($row);
            $result['comments'][$key] = $comment;
        }

        return $result;
    }
    public function createContactComment($contactId, \Kund24\Api\Models\Comment $comment) {
        $data = $this->array_remove_null($comment->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/contacts/'.$contactId.'/comments.json', $data);

        $comment = new \Kund24\Api\Models\Comment();
        $comment->jsonUnserialize($result['comment']);

        return $comment;
    }
    public function createContactAddress($contactId, \Kund24\Api\Models\ContactAddress $contactAddress) {
        $data = $this->array_remove_null($contactAddress->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/contacts/'.$contactId.'/addresses.json', $data);

        $contact = new \Kund24\Api\Models\Contact();
        $contact->jsonUnserialize($result['address']);

        return $contact;
    }
    public function sendChatMessage($chatId, \Kund24\Api\Models\ChatMessage $chatMessage) {
        $data = $this->array_remove_null($chatMessage->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/chats/'.$chatId.'/messages.json', $data);

        $chatMessage = new \Kund24\Api\Models\ChatMessage();
        $chatMessage->jsonUnserialize($result['message']);

        return $chatMessage;
    }
    public function listBlogs(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;

        $result = $this->makeCurlRequest('GET', '/blogs.json', $query);

        foreach ($result['blogs'] as $key => $row) {
            $blog = new \Kund24\Api\Models\Blog();
            $blog->jsonUnserialize($row);
            $result['blogs'][$key] = $blog;
        }

        return $result;
    }
    public function listPosts(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;

        $result = $this->makeCurlRequest('GET', '/posts.json', $query);

        foreach ($result['posts'] as $key => $row) {
            $post = new \Kund24\Api\Models\Post();
            $post->jsonUnserialize($row);
            $result['posts'][$key] = $post;
        }

        return $result;
    }
    public function createPost(\Kund24\Api\Models\Post $post) {
        $data = $this->array_remove_null($post->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/posts.json', $data);

        $post = new \Kund24\Api\Models\Post();
        $post->jsonUnserialize($result['post']);

        return $post;
    }
    public function updatePost(\Kund24\Api\Models\Post $post) {
        $data = $this->array_remove_null($post->jsonSerialize());
        $result = $this->makeCurlRequest('PUT', '/posts/'.$post->getId().'.json', $data);

        $post = new \Kund24\Api\Models\Post();
        $post->jsonUnserialize($result['post']);

        return $post;
    }
    public function getPost($id) {
        $result = $this->makeCurlRequest('GET', '/posts/'.$id.'.json');
        $post = new \Kund24\Api\Models\Post();
        $post->jsonUnserialize($result['post']);

        return $post;
    }
    public function createTrigger(\Kund24\Api\Models\Trigger $trigger) {
        $data = $this->array_remove_null($trigger->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/triggers.json', $data);

        $trigger = new \Kund24\Api\Models\Trigger();
        $trigger->jsonUnserialize($result['trigger']);

        return $trigger;
    }
    public function updateTrigger(\Kund24\Api\Models\Trigger $trigger) {
        $data = $this->array_remove_null($trigger->jsonSerialize());
        $result = $this->makeCurlRequest('PUT', '/triggers/'.$trigger->getId().'.json', $data);

        $trigger = new \Kund24\Api\Models\Trigger();
        $trigger->jsonUnserialize($result['trigger']);

        return $trigger;
    }
    public function getTrigger($id) {
        $result = $this->makeCurlRequest('GET', '/triggers/'.$id.'.json');
        $trigger = new \Kund24\Api\Models\Trigger();
        $trigger->jsonUnserialize($result['trigger']);

        return $trigger;
    }
    public function updateIntegration(\Kund24\Api\Models\Integration $integration) {
        $data = $this->array_remove_null($integration->jsonSerialize());
        $result = $this->makeCurlRequest('PUT', '/integrations/'.$integration->getId().'.json', $data);

        $integration = new \Kund24\Api\Models\Integration();
        $integration->jsonUnserialize($result['integration']);

        return $integration;
    }
    public function getIntegration($id) {
        $result = $this->makeCurlRequest('GET', '/integrations/'.$id.'.json');
        $integration = new \Kund24\Api\Models\Integration();
        $integration->jsonUnserialize($result['integration']);

        return $integration;
    }
    public function listTriggers(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;
        
        $result = $this->makeCurlRequest('GET', '/triggers.json', $query);

        foreach ($result['triggers'] as $key => $row) {
            $trigger = new \Kund24\Api\Models\Trigger();
            $trigger->jsonUnserialize($row);
            $result['triggers'][$key] = $trigger;
        }

        return $result;
    }
    protected function array_remove_null($haystack) {
        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $haystack[$key] = $this->array_remove_null($haystack[$key]);
            }

            if ($haystack[$key] === null) {
                unset($haystack[$key]);
            }
        }

        return $haystack;
    }
	protected function makeCurlRequest($method, $path, $data = array()) {
        $method = strtoupper($method);

        $url = (($this->getEnvironment() == 'production') ?  $this->baseUrl:$this->sandboxBaseUrl).$path;
        if (in_array($method, array('GET','DELETE')) && !empty($data)) {
            if (is_array($data)) $data = http_build_query($data);
            $url .= "?".ltrim($data, "?");
        }

        $url .= ((strstr($url, "?")) ? '&':'?').http_build_query(array("token" => $this->apiKey, "acc_id" => $this->accountId));

        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'KUND24 PHP Api v1.1.1');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type: application/json',
        ));

        if (in_array($method, array('POST','PUT')) && !empty($data)) {
            if (is_array($data)) {
                curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
            ELSE {
                curl_setopt ($ch, CURLOPT_POSTFIELDS, ltrim($data, "?"));
            }
        }

        $res = curl_exec($ch);

        $response = json_decode($res, true);

        if (!is_array($response)) {
        	throw new \Exception('Invalid response from server: '.$res);
        }
        if (array_key_exists("message", $response)) {
			throw new \Exception($response['message'], $response['code']);
		}
        elseif (array_key_exists("error", $response)) {
            if ((is_array($response['error'])) && (array_key_exists("message", $response['error']))) {
                if (array_key_exists("code", $response['error'])) {
                    throw new \Exception($response['error']['message'], $response['error']['code']);
                }
                else {
                    throw new \Exception($response['error']['message']);
                }
            }
            throw new \Exception($response['error']);
        }

        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);

        return $response;
    }
}