<?php

class Vh2zeya4eve_API {

    private $apiKey;
    private $authKey;
    private $apiUrl;

    public function __construct(){
        if(VH2ZEYA4EVE_ENVIRONMENT === 'DEV') {
            $this->apiUrl = 'https://skoryk.realmart.com.ua/admin/partner-api/';
        } elseif (VH2ZEYA4EVE_ENVIRONMENT === 'STAGING') {
            $this->apiUrl = 'https://staging-server.zeya888.com/admin/partner-api/';
        } elseif (VH2ZEYA4EVE_ENVIRONMENT === 'PROD') {
            $this->apiUrl = 'https://server.zeya888.com/admin/partner-api/';
        }

        $this->apiKey = get_option('vh2zeya4eve_api_key');
        $this->authKey = $this->getAuthKey();
    }

    // get auth key from api
    private function getAuthKey($apiKey = '') : string
    {
        if (empty($apiKey)) {
            $apiKey = $this->apiKey;
        }
        $request = $this->request('get-auth-key', ['apiKey' => $apiKey]);
        return !empty($request->authKey) ? $request->authKey : '';
    }

    private function request($endpoint, $data = []) : object
    {
        $url = add_query_arg($data, $this->apiUrl . $endpoint);
        $response = wp_remote_get($url);
        // errors handling
        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            return (object) [
                'status' => 'error',
                'message' => $error_message
            ];
        }

        $body = wp_remote_retrieve_body($response);
        return json_decode($body);
    }

    // trigger partner action for create lovestars
    public function createRuleAction($inputValue) : object
    {
        $data = [
            'authKey' => $this->authKey,
            'partnerRuleId' => 4,
            'triggerName' => 'Emitted lovestars from ViralHelp',
            'inputValue' => $inputValue
        ];

        return $this->request('create-rule-action', $data);
    }

    public function checkApiKey($apiKey) : bool
    {
        return !empty($this->getAuthKey($apiKey));
    }
}