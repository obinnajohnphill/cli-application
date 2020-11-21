<?php


namespace App\Http;

use App\Parsers\JsonParser;

class Request implements RequestInterface
{
    /**
     * Method that sends API request
     *
     * @param string $name
     * @param string $path
     * @return mixed
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRequest(string $name, string $path){

        $params = [
            'query' => [
                'name' => $name,
                'path' => $path
            ]
        ];

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', config('api.endpoint'),  $params);
            if ($response->getBody()) {
                return $response->getBody()->getContents();
            }
        } catch (\GuzzleHttp\Exception\RequestException $e){
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBodyAsCode = $response->getStatusCode();
                $responseBodyAsString = $response->getBody()->getContents();
                $responseData = json_decode($responseBodyAsString, true);
                $responseData['code'] =  $responseBodyAsCode;
                $responseData['path'] =  $path;
                return   json_encode($responseData);
            }
        }
    }
}
