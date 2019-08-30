<?php

namespace Kund24\Api;

class Client {

	private $apiKey;

    private $accountId;

	private $baseUrl = 'https://www.kund24.se/api';

	public function __construct($accountId, $apiKey) {
        $this->accountId = $accountId;
		$this->apiKey = $apiKey;
	}
    public function addContactsToEmailCampaign($campaignId, $contactIds = array()) {
        $data = array("contact_ids" => $contactIds);
        return $this->makeCurlRequest('POST', '/email_campaigns/'.$campaignId.'/contacts.json', $data);
    }
	public function createDeal(\Kund24\Api\Models\Deal $deal) {
		$data = $deal->jsonSerialize();
		$result = $this->makeCurlRequest('POST', '/deals.json', $data);
		$deal = new \Kund24\Api\Models\Deal();
		$deal->jsonUnserialize($result['deal']);

		return $deal;
	}
    public function createTicket(\Kund24\Api\Models\Ticket $ticket) {
        $data = $ticket->jsonSerialize();
        $result = $this->makeCurlRequest('POST', '/tickets.json', $data);

        $ticket = new \Kund24\Api\Models\Ticket();
        $ticket->jsonUnserialize($result['ticket']);

        return $ticket;
    }
    public function createContact(\Kund24\Api\Models\Contact $contact) {
        $data = $contact->jsonSerialize();
        $result = $this->makeCurlRequest('POST', '/contacts.json', $data);

        $contact = new \Kund24\Api\Models\Contact();
        $contact->jsonUnserialize($result['contact']);

        return $contact;
    }
    public function createProject(\Kund24\Api\Models\Project $project) {
        $data = $project->jsonSerialize();
        $result = $this->makeCurlRequest('POST', '/projects.json', $data);

        $project = new \Kund24\Api\Models\Project();
        $project->jsonUnserialize($result['project']);

        return $project;
    }
    public function createProjectTask($projectId, \Kund24\Api\Models\ProjectTask $projectTask) {
        $data = $projectTask->jsonSerialize();
        $result = $this->makeCurlRequest('POST', '/projects/'.$projectId.'/tasks.json', $data);

        $projectTask = new \Kund24\Api\Models\ProjectTask();
        $projectTask->jsonUnserialize($result['project_task']);

        return $projectTask;
    }
	private function makeCurlRequest($method, $path, $data = array()) {
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
        curl_setopt($ch, CURLOPT_USERAGENT, 'KUND24 PHP Api v1.1.0');
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