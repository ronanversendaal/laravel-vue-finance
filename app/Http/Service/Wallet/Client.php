<?php


namespace App\Http\Service\Wallet;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class Client
{
    private $client;

    private $headers;

    public function __construct()
    {
        $this->headers = [
            'X-Token' => env('WALLET_API_CLIENT_TOKEN'),
            'X-User' => env('USER_EMAIL')
        ];

        $this->client = new \GuzzleHttp\Client([
            'base_uri' => env('WALLET_API_URI'),
            'headers' => $this->headers
        ]);
    }

    protected function request($uri, $method = 'GET', $body = null, $headers = [])
    {
        array_merge($headers, $this->headers);

        $request = new Request($method, $uri, $headers, $body);

        try {
            $response = $this->client->send($request);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $exception) {
            switch ($exception->getCode()) {
                case 400:
                    if (null !== $response = $exception->getResponse()) {
                        $responseBody = json_decode($response->getBody()->getContents(), true);
                        if ($responseBody['status'] === 'KO') {
                            return response($responseBody);
                        }
                    }
                    break;
                case 500:
                    return response(['msg' => 'Server unable to perform action'], 400);
                    break;
                default:
                    return response(['msg' => 'Unable to perform action'], 503);
            }
        } catch (GuzzleException $e) {
//            return response(['msg' => 'Something went wrong'], 500);
        }
        return response(['msg' => 'Something went wrong'], 500);
    }

}
