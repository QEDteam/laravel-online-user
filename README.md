# Laravel Online User

Laravel package that is used alongside laravel echo server and redis. Trough trait you can always get user online status with help of a occupied private channel and laravel echo server api.

## Installation

For installing laravel online user, either add qed/laravel-online-user to the require section in your project's composer.json, or you can use composer as below:

```
composer require qed/laravel-online-user
```

Publish config:

```
php artisan vendor:publish --provider="Qed\LaravelOnlineUser\LaravelOnlineUserServiceProvider"
```

Generate laravel echo server client and get APP_ID and APP_KEY
```
laravel-echo-server client:add APP_ID
```

Populate config:

```
LARAVEL_ECHO_SERVER_URL=http://localhost
LARAVEL_ECHO_SERVER_PORT=6001
LARAVEL_ECHO_SERVER_APP_ID=APP_ID
LARAVEL_ECHO_SERVER_APP_KEY=APP_KEY
LARAVEL_ECHO_SERVER_CHANNEL='user-online.'
```

Run config clear and command that generates new private broadcast route:

```
php artisan config:clear
php artisan create:channel
```

In the application where you listen for events add private channel, note the event isn't important, we will check if user is subscribed to channel itself.

```
Echo.private('LARAVEL_ECHO_SERVER_CHANNEL.${userId}')
    .listen('IsOnline', (e) => {
        console.log(e);
    });
```

## Usage

After installation add trait to user model and you can call ->isOnline() on user with true/false response. Note since channel is private by default it'll have private- prefix. To exclude it you can set LARAVEL_ECHO_SERVER_PREFIX=false.

## Example

Add trait

```
...
use Qed\LaravelOnlineUser\Traits\IsOnline;

class User extends Authenticatable
{
    use IsOnline;
...
```

Call isOnline anywhere on some user

```
User::whereId(1)->first()->isOnline();
```

## References

Laravel echo server: https://github.com/tlaverdure/laravel-echo-server
