<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class gbv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:vue-page {page-name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "working " . $this->argument("page-name");
        return 0;
    }
}
