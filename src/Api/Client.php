<?php

namespace Kund24\Api;

class Client {

	private $apiKey;

	private $baseUrl = 'https://www.kund24.se/api';

	public function __construct($apiKey) {
		$this->apiKey = $apiKey;
	}
	public function createDeal(\Kund24\Api\Models\Deal $deal) {
		$data = $this->convertToArray($deal);
		$result = $this->makeCurlRequest('POST', '/deals.json', $data);

		$deal = new \Kund24\Api\Models\Deal();
		$deal->jsonUnserialize($result['deal']);

		return $deal;
	}
	private function convertToArray($object) {
		return $object->jsonSerialize();
	}
	private function makeCurlRequest($method, $path, $data = array()) {
        $method = strtoupper($method);

        $url = $this->baseUrl.$path;
        if (in_array($method, array('GET','DELETE')) && !empty($data)) {
            if (is_array($data)) $data = http_build_query($data);
            $url .= "?".ltrim($data, "?");
        }

        $url .= ((strstr($url, "?")) ? '&':'?').http_build_query(array("token" => $this->apiKey));

        $ch = curl_init($url); 
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'KUND24 PHP Api v1.0.0');
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
        if (array_key_exists("error", $response)) {
			throw new \Exception($response['error']['message'], $response['error']['code']);
		}

        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);

        return $response;
    }
}