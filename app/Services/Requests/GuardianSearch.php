<?php

namespace App\Services\Requests;

use App\Services\GuardianBaseRequest;
use App\Services\GuardianRequest;

class GuardianSearch extends GuardianBaseRequest implements GuardianRequest
{
    public mixed $query;

    public function __construct( $query = null)
    {
        parent::__construct();
        $this->query = $query;
    }

    public function generateBody()
    {
        if($this->query){
            return [
                'section'=>$this->query
            ];
        } else {
            return [];
        }

    }

    public function doRequest()
    {
        $requestBody = $this->generateBody();

        $response = $this->__doRequest('search',$requestBody);

        return $this->formatResponse($response);
    }

    public function formatResponse($response)
    {
        return $response['response']['results'] ?? false;
    }
}