<?php

namespace App\Services\Requests;

use App\Services\GuardianBaseRequest;
use App\Services\GuardianRequest;

class GuardianSection extends GuardianBaseRequest implements GuardianRequest
{

    public function generateBody(): array
    {
        return [];
    }

    public function doRequest()
    {
        $requestBody = $this->generateBody();

        $response = $this->__doRequest('sections',$requestBody);

        return $this->formatResponse($response);
    }

    public function formatResponse($response)
    {
        return $response['response']['results'] ?? false;
    }
}