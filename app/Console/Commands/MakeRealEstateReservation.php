<?php

namespace App\Console\Commands;

use App\Models\RealEstate;
use App\Models\Reservations;
use Illuminate\Console\Command;

class MakeRealEstateReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:reservation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check if real estate have reservation to change status in db';

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
        ## get ids 
        $realestate_ids = Reservations::where('from', '>=', now())
            ->pluck('realestate_id')
            ->toArray();
            
        ## update 
        RealEstate::whereIn('id', $realestate_ids)
            ->update([
                'is_reserved' => true
            ]);
    }
}
