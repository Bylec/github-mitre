<?php

namespace App\Console\Commands;

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
//        $file = file_get_contents("https://raw.githubusercontent.com/mitre/cti/master/enterprise-attack/enterprise-attack.json");
//        $array = json_decode($file,true);
//
//        $collection = collect($array["objects"]);
//
//        $collectionGrouped = $collection->groupBy("type");
//
//        dd($collectionGrouped->keys());

        Test::create([
            "test" => "test"
        ]);
    }
}
