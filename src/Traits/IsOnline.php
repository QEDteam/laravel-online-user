<?php

namespace Qed\LaravelOnlineUser\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

trait IsOnline
{
    public function isOnline()
    {
        return $this->getOnlineStatus($this->id);
    }

    public function getOnlineStatus($userId)
    {
        $client = new Client();

        try {
            $url = config('laravel-online-user.url') . ':' . config('laravel-online-user.port');
            $appId = config('laravel-online-user.appId');
            $appKey = config('laravel-online-user.appKey');
            $prefix = config('laravel-online-user.prefix') != false ? "private-" : '';
            $channel = $prefix . config('laravel-online-user.channel') . $userId;

            $response = $client->get("$url/apps/$appId/channels/$channel", [
                'query' => [
                    'auth_key' => $appKey,
                ]
            ]);

            $content = json_decode($response->getBody()->getContents());

            return $content ? $content->occupied : false;
        } catch (ClientException $e) {
            return false;
        }
    }
}
