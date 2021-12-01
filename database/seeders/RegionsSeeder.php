<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = ['Central','Eastern','Northern','Western','Southern'];
        for($i=0; $i<count($regions); $i++){
            if(Region::where('region',$regions[$i])->exists()){
                continue;
            }else{
                $region = new Region;
                $region->region = $regions[$i];
                $region->id     = $i+1;
                $region->save();
            }
        }
    }
}
