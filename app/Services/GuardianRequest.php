<?php

namespace App\Services;

interface GuardianRequest
{

    /**
     * @return mixed
     * create request body to be sent to remote api
     */
    public function generateBody();

    /**
     * @return mixed
     * call the remote api
     */
    public function doRequest();

    /**
     * @param $response
     * @return mixed
     * format the remote api response
     */
    public function formatResponse($response);
}