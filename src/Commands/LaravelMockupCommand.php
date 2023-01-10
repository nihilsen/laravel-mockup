<?php

namespace Nihilsen\LaravelMockup\Commands;

use Illuminate\Console\Command;

class LaravelMockupCommand extends Command
{
    public $signature = 'laravel-mockup';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
