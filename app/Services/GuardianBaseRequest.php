<?php

namespace App\Services;

use App\Exceptions\GuardianCredentialNotDefined;
use App\Models\Guardian;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GuardianBaseRequest
{
    public string $apiKey;

    public string $baseUrl;

    /**
     * @throws GuardianCredentialNotDefined
     */
    public function __construct()
    {
        $credentials = Guardian::first();

        $this->checkCredentials($credentials);

        $this->apiKey = $credentials->api_key;
        $this->baseUrl = $credentials->base_url;
    }

    /**
     * @throws GuardianCredentialNotDefined
     */
    protected function checkCredentials($credentials)
    {
        if(!$credentials || empty($credentials->base_url) || empty($credentials->api_key)){
            throw new GuardianCredentialNotDefined('Credentials not defined');
        }
    }

    public function __doRequest(string $path, array $body = [])
    {

        //merge api-key to the generated query parameters
        $requestBody = array_merge($body,[
            'api-key'=>$this->apiKey
        ]);

        //save request log
        $this->saveRequestLog($path.time().'RQ.json',json_encode($requestBody));

        //get response from the  api
        $response = Http::get($this->baseUrl."/{$path}",$requestBody)->json();

        //save response log
        $this->saveRequestLog($path.time().'RS.json',json_encode($response));

        return $response;
    }

    public function saveRequestLog($filename,$content)
    {

        Storage::disk('logs')
            ->put('guardian\\'.date('Y-m-d').'\\'.$filename,$content);
    }
}