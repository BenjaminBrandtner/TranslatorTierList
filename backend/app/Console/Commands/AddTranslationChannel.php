<?php

namespace App\Console\Commands;

use App\Exceptions\ChannelDoesntExistException;
use App\Exceptions\ChannelExistsException;
use App\Exceptions\InvalidTierException;
use App\Exceptions\InvalidUrlException;
use Illuminate\Console\Command;

class AddTranslationChannel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translationChannels:add {channel_id} {tier?} {goodEditor?} {--f|force}';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            \App\Actions\AddTranslationChannel::run(
                $this->argument('channel_id'),
                $this->argument('tier') ?? null,
                $this->argument('goodEditor') ?? null,
                $this->option('force')
            );
        } catch (ChannelExistsException $e) {
            $this->warn($e->getMessage() . ' Use -f to overwrite it.');
            return 1;
        } catch (InvalidTierException $e) {
            $this->error($e->getMessage());
            return 1;
        } catch (InvalidUrlException $e) {
            $this->error($e->getMessage());
            return 1;
        } catch (ChannelDoesntExistException $e) {
            $this->error($e->getMessage());
            return 1;
        }

        return 0;
    }
}
