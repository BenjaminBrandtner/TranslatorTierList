<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateTranslationChannels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translationChannels:update';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \App\Actions\UpdateTranslationChannels::run();

        return 0;
    }
}
