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
        $basepath = base_path();
        $from = $basepath . "/resources/js/Pages/Dashboard.vue";
        $to = $basepath . "/resources/js/Pages/" . $this->argument('page-name') . "";
        // touch($to);
        shell_exec("mkdir $to");
        shell_exec("cp -r $from $to" . "/Index.vue");
        shell_exec("cp -r $from $to" . "/Create.vue");
        shell_exec("cp -r $from $to" . "/Edit.vue");
        shell_exec("cp -r $from $to" . "/View.vue");
        return 0;
    }
}
