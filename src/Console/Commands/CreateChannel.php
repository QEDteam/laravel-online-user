<?php

namespace Qed\LaravelOnlineUser\Console\Commands;

use Illuminate\Console\Command;

class CreateChannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:channel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create channel for user online presence';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Updating channels.php route file.
        $this->setFileData(
            base_path() . '/routes/channels.php',
            $this->getApiRouterSnippet()
        );
    }

    /**
     * Create WebViewController snippet.
     *
     * @return string
     */
    public function getApiRouterSnippet()
    {
        return
        '
Broadcast::channel("' . config('laravel-online-user.channel') . '{userId}", function ($user, $userId) {
    return $user->id == $userId;
});
        ';
    }

    public function setFileData($file, $insertText)
    {
        return file_put_contents(
            $file,
            $insertText,
            FILE_APPEND | LOCK_EX
        );
    }
}
