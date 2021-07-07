<?php

return [
  'url' => (env('LARAVEL_ECHO_SERVER_URL', 'http://localhost')),
  'port' => (env('LARAVEL_ECHO_SERVER_PORT', '6001')),
  'appId' => (env('LARAVEL_ECHO_SERVER_APP_ID', 'testID')),
  'appKey' => (env('LARAVEL_ECHO_SERVER_APP_KEY', '0eb6be7bf551351b5e436fba69c88cf2')),
  'channel' => (env('LARAVEL_ECHO_SERVER_CHANNEL', 'user-online.')),
  'prefix' => (env('LARAVEL_ECHO_SERVER_PREFIX', true)),
];
