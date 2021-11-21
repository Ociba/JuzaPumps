<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Town;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $towns = ['Buikwe','Bukomansimbi','Butambala','Buvuma','Gomba','Kalangala','Kalungu','Kampala',
                        'Kayunga','Kiboga','Kyankwanzi','Luweero','Lwengo','Lyantonde','Masaka','Mityana',
                        'Mpigi','Mubende','Mukono','Nakaseke','Nakasongola','Rakai','Sembabule','Wakiso',
                        'Amuria','Budaka','Bududa','Bugiri','Bukedea','Bukwa','Bulambuli','Busia','Butaleja',
                        'Buyende','Iganga','Jinja','Kaberamaido','Kaliro','Kamuli','Kapchorwa','Katakwi',
                        'Kibuku','Kumi','Kween','Luuka','Manafwa','Mayuge','Mbale','Namayingo','Namutumba',
                        'Ngora','Pallisa','Serere','Sironko','Soroti','Tororo','Abim','Adjumani','Agago',
                        'Alebtong','Amolatar','Amudat','Amuru','Apac','Arua','Dokolo','Gulu','Kaabong',
                        'Kitgum','Koboko','Kole','Kotido','Lamwo','Lira','Maracha','Moroto','Moyo',
                        'Nakapiripirit','Napak','Nebbi','Nwoya','Otuke','Oyam','Pader','Yumbe','Zombo',
                        'Buhweju','Buliisa','Bundibugyo','Bushenyi','Hoima','Ibanda','Isingiro','Kabale',
                        'Kabarole','Kamwenge','Kanungu','Kasese','Kibaale','Kiruhura','Kiryandongo',
                        'Kisoro','Kyegegwa','Kyenjojo','Masindi','Mbarara','Mitooma','Ntoroko','Ntungamo',
                        'Rubirizi','Rukungiri','Sheema'
        ];
        for($i=0; $i < count($towns); $i++){
            $town = new Town();
            if(town::where("id",$i)->exists()){
                $town->id = $i+1;
            }
            else{
                $town->id = $i;
            } 
            $town->town=$towns[$i];
            $town->save();
           
    }
    }
}
