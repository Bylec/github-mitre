<?php

namespace App\Console\Commands;

use App\Mitre\DatabaseDrivers\Mongo;
use App\Mitre\MitreDataUpdate;
use App\Mitre\Sources\Enterprise;
use App\Models\Tactics;
use App\Models\Test;
use Illuminate\Console\Command;

class FetchMitreData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mitre:fetch-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $mitreDataUpdate = new MitreDataUpdate(new Mongo(), new Enterprise());
        $mitreDataUpdate->update();
    }
}
