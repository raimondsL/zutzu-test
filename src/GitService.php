<?php

use GuzzleHttp\Client;

class GitService
{
    private $cacheService;
    private $key;

    public function __construct()
    {
        $this->cacheService = new CacheService;
        $this->key = "organizations";
    }

    public function GetMore()
    {
        $organizations = array();
        $files = glob($this->cacheService->filepath . $this->key ."*");

        foreach ($files as $file)
        {
            $organizations = array_merge($organizations, $this->cacheService->get(basename($file)));
        }

        $len = count($organizations);
        $id = $len ? $organizations[$len-1]->id : 0;
        $organizations = array_merge($organizations, $this->GetOrganizations($id));

        return $organizations;
    }

    public function GetOrganizations(int $since = 0)
    {
        if ($organizations = $this->cacheService->get($this->key . "-$since"))
            return $organizations;

        $api = "https://api.github.com/organizations?since=$since";
        $accept = "application/vnd.github.v3+json";

        $client = new Client(
            [
                'headers' => [ 'Accept' => $accept ]
            ]
        );

        $response = $client->request('GET', $api);

        if ($response->getStatusCode() == 200)
        {
            $json = json_decode($response->getBody());
            $this->cacheService->set($this->key . "-$since", $json, 300);
            return $json;
        }
        else
            return null;
    }
}