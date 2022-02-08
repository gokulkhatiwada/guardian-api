<?php

namespace App\Services\Requests;

use App\Services\GuardianBaseRequest;
use App\Services\GuardianRequest;

class GuardianSingleItem extends GuardianBaseRequest implements GuardianRequest
{
    public string $id;
    public function __construct(string $id)
    {
        parent::__construct();
        $this->id = $id;
    }

    public function generateBody()
    {
        return [];
    }

    public function doRequest()
    {
        $requestBody = $this->generateBody();

        $response = $this->__doRequest($this->id,$requestBody);

        return $this->formatResponse($response);
    }

    public function formatResponse($response)
    {
        return $response['response']['content'] ?? false;
    }
}