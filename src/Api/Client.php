<?php

namespace Kund24\Api;

class Client {

	protected $apiKey;

    protected $accountId;

	protected $baseUrl = 'https://www.kund24.se/api';

	public function __construct($accountId, $apiKey) {
        $this->accountId = $accountId;
		$this->apiKey = $apiKey;
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
    public function sendRoleNotification($resource, $resourceId, $role, $message) {
        $result = $this->makeCurlRequest('POST', '/notifications/'.$resource.'/'.$resourceId.'/roles/'.$role.'.json', array("content" => $message));

        return $result;
    }
    public function sendUserNotification($resource, $resourceId, $userId, $message) {
        $result = $this->makeCurlRequest('POST', '/notifications/'.$resource.'/'.$resourceId.'/users/'.$userId.'.json', array("content" => $message));

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
	public function createDeal(\Kund24\Api\Models\Deal $deal) {
		$data = $this->array_remove_null($deal->jsonSerialize());
		$result = $this->makeCurlRequest('POST', '/deals.json', $data);
		$deal = new \Kund24\Api\Models\Deal();
		$deal->jsonUnserialize($result['deal']);

		return $deal;
	}
    public function updateDeal(\Kund24\Api\Models\Deal $deal) {
        $data = $this->array_remove_null($deal->jsonSerialize());
        $result = $this->makeCurlRequest('PUT', '/deals/'.$deal->getId().'.json', $data);

        $deal = new \Kund24\Api\Models\Deal();
        $deal->jsonUnserialize($result['deal']);

        return $deal;
    }
    public function listDeals(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;
        $query['newest'] = 1;
        
        $result = $this->makeCurlRequest('GET', '/deals.json', $query);

        foreach ($result['deals'] as $key => $row) {
            $deal = new \Kund24\Api\Models\Deal();
            $deal->jsonUnserialize($row);
            $result['deals'][$key] = $deal;
        }

        return $result;
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
    public function createContactAddress($contactId, \Kund24\Api\Models\ContactAddress $contactAddress) {
        $data = $this->array_remove_null($contactAddress->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/contacts/'.$contactId.'/addresses.json', $data);

        $contact = new \Kund24\Api\Models\Contact();
        $contact->jsonUnserialize($result['address']);

        return $contact;
    }
    public function createProject(\Kund24\Api\Models\Project $project) {
        $data = $this->array_remove_null($project->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/projects.json', $data);

        $project = new \Kund24\Api\Models\Project();
        $project->jsonUnserialize($result['project']);

        return $project;
    }
    public function updateProject(\Kund24\Api\Models\Project $project) {
        $data = $this->array_remove_null($project->jsonSerialize());
        $result = $this->makeCurlRequest('PUT', '/projects/'.$project->getId().'.json', $data);

        $project = new \Kund24\Api\Models\Project();
        $project->jsonUnserialize($result['project']);

        return $project;
    }
    public function getProject($id) {
        $result = $this->makeCurlRequest('GET', '/projects/'.$id.'.json');
        $project = new \Kund24\Api\Models\Project();
        $project->jsonUnserialize($result['project']);

        return $project;
    }
    public function listProjects(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;
        
        $result = $this->makeCurlRequest('GET', '/projects.json', $query);

        foreach ($result['projects'] as $key => $row) {
            $project = new \Kund24\Api\Models\Project();
            $project->jsonUnserialize($row);
            $result['projects'][$key] = $project;
        }

        return $result;
    }
    public function createProjectTask($projectId, \Kund24\Api\Models\ProjectTask $projectTask) {
        $data = $this->array_remove_null($projectTask->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/projects/'.$projectId.'/tasks.json', $data);

        $projectTask = new \Kund24\Api\Models\ProjectTask();
        $projectTask->jsonUnserialize($result['project_task']);

        return $projectTask;
    }
    public function updateProjectTask(\Kund24\Api\Models\ProjectTask $projectTask) {
        $data = $this->array_remove_null($projectTask->jsonSerialize());
        $result = $this->makeCurlRequest('PUT', '/projects/'.$projectTask->getProject()->getId().'/tasks/'.$projectTask->getId().'.json', $data);

        $projectTask = new \Kund24\Api\Models\ProjectTask();
        $projectTask->jsonUnserialize($result['project_task']);

        return $projectTask;
    }
    public function getProjectTask($id) {
        $result = $this->makeCurlRequest('GET', '/project_tasks/'.$id.'.json');
        $projectTask = new \Kund24\Api\Models\ProjectTask();
        $projectTask->jsonUnserialize($result['project_task']);

        return $projectTask;
    } 
    public function listProjectTasks(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;

        $result = $this->makeCurlRequest('GET', '/project_tasks.json', $query);

        foreach ($result['project_tasks'] as $key => $row) {
            $projectTask = new \Kund24\Api\Models\ProjectTask();
            $projectTask->jsonUnserialize($row);
            $result['project_tasks'][$key] = $projectTask;
        }

        return $result;
    }
    public function listProjectTaskIds(Array $query) {
        $result = $this->makeCurlRequest('GET', '/project_tasks/ids.json', $query);

        return $result;
    }
    public function createProjectTaskLog($projectTaskId, \Kund24\Api\Models\ProjectTaskLog $projectTaskLog) {
        $data = $this->array_remove_null($projectTaskLog->jsonSerialize());
        $result = $this->makeCurlRequest('POST', '/project_tasks/'.$projectTaskId.'/logs.json', $data);

        $projectTaskLog = new \Kund24\Api\Models\ProjectTaskLog();
        $projectTaskLog->jsonUnserialize($result['project_task_log']);

        return $projectTaskLog;
    }
    public function listProjectTaskLogs(Array $query, $offset = 0, $limit = 50) {
        $query['offset'] = $offset;
        $query['limit'] = $limit;

        $result = $this->makeCurlRequest('GET', '/project_task_logs.json', $query);

        foreach ($result['project_task_logs'] as $key => $row) {
            $projectTaskLog = new \Kund24\Api\Models\ProjectTaskLog();
            $projectTaskLog->jsonUnserialize($row);
            $result['project_task_logs'][$key] = $projectTaskLog;
        }

        return $result;
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

        $url = $this->baseUrl.$path;
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
        	throw new \Exception('Invalid response from server');
        }
        if (array_key_exists("message", $response)) {
			throw new \Exception($response['message'], $response['code']);
		}
        elseif (array_key_exists("error", $response)) {
            if ((is_array($response['error'])) && (array_key_exists("message", $response['error']))) {
                throw new \Exception($response['error']['message'], $response['error']['code']);
            }
            throw new \Exception($response['error']);
        }

        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);

        return $response;
    }
}