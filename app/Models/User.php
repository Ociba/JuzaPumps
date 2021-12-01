<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use DB;
use Carbon\Carbon;
use Modules\ClientModule\Entities\Client;
use Modules\TransactionModule\Entities\Payment;
use Modules\FuelStation\Entities\FuelStation;
use App\Models\User;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'category',
        'town_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    /** 
     * This function counts riders for today
    */
    public function countTodaysRiders(){
        $count_todays_riders =DB::table('clients')
        ->where('clients.deleted_at',null)
        ->whereDate('created_at',Carbon::today())->count();
        return $count_todays_riders;
    }
    /** 
     * This function counts riders with debtors today (0-1day)
    */
    public function countTodaysDebtors(){
        $count_todays_riders_debtors =DB::table('fuel_stations')
        ->whereNotNull('debt')
        ->where('status','pending')
        ->where('created_at','>=',Carbon::today())->count();
        return $count_todays_riders_debtors;
    }
    /**
     * This function counts defaulters from 2 days to 10 days
     */
    public function countDefaultersTwoToTenDays(){ 
        //day of creation is created at after adding 2 days to it
        //last day of defaulting is day of creation plus 8
        $defaulters = FuelStation::whereNotNull('debt')->where('status','pending')->where('created_at','>',Carbon::now()->subDays(10))->count();
        return $defaulters;
    }
    /** 
     * This function counts riders for particular town
    */
    public function countRidersForTown($town_id){
        $count_riders_per_district =DB::table('clients')->join('users','clients.user_id','clients.id')
        ->where('clients.deleted_at',null)
        ->where('town_id',$town_id)->where('clients.user-id',$this->id)->groupBy('town_id')->count();
        return $count_riders_per_district;
    }
      /** 
     * This function gets district for login user
    */
    public function getLogginUserTown(){
        $get_users_town =DB::table('clients')->join('users','clients.user_id','clients.id')
        ->join('towns','clients.town_id','towns.id')
        ->where('clients.deleted_at',null)
        ->where('clients.user_id',$this->id)
        ->select('towns.town')->get();
        return $get_users_town;
    }
    /*
    * This function gets district for login user
    */
    public function Towns(){
        $get_users_town =DB::table('clients')->join('users','clients.user_id','clients.id')
        ->join('towns','clients.town_id','towns.id')
        ->where('clients.deleted_at',null)
        ->where('clients.user_id',$this->id)
        ->select('clients.town_id')->get();
        return $get_users_town;
    }

    /**
     * this function counts the number of riders for the loggeind user
     */
    public function countUserNumberOfRiders(){
        return DB::table('clients')->where('deleted_at',null)->count();
    }
     /**
     * this function gets amount collected this current week
     * set first day
     */
    public function getThisCurrentWeekRevenue(){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        return DB::table('charges')->whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->sum('charge');
    }
    /** ->where('user_id',$this->id)
     * This function gets amount paid this month
    */
    public function getThisCurrentMonthRevenue(){
        return DB::table('charges')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('charge');
    }
    /** 
     * This function gets current amount paid this year
    */
    public function getThisYearsRevenue(){
        return DB::table('charges')->whereYear('created_at', date('Y'))->sum('charge');
    }
    public function getEnforcement(){
        //day of creation is created at after 11 days
        //last day of defaulting is day of creation plus 10
        $last_11_days = FuelStation::where('created_at','>=',Carbon::now()->subdays(4))->count();
        
        return FuelStation::whereNotNull('debt')->where('status','pending')->whereDay('created_at','>=',"+'' day")->count();
        //$all= Client::where('created_at',[$start_date, $last_11_days])->get();
        //dd($last_11_days);
    }
    /*
    * This function gets photo for logged in user
    */
   public function getLoggedInUserLogo(){
       $user_logo = DB::table('users')->where('id', '=', $this->id)->value('profile_photo_path');
       if(empty($user_logo)){
           $user_logo = 'images.jpeg';
       }
       return $user_logo;
   }
     /** 
     * This function gets Users permissions
    */
    public function getUserPermisions(){
        $empty_permissions_array = [];
        $permissions_array = DB::table('user_permissions')
        ->join('permissions','user_permissions.permission_id','permissions.id')
        ->where('user_id',Auth::user()->id)
        ->select('permissions.permission')->get();
        foreach(json_decode($permissions_array,true) as $permissions){
                array_push($empty_permissions_array,$permissions["permission"]);
        }
        return $empty_permissions_array;
    }
    /** 
     * This function counts all the Users.
    */
    public function countUsers(){
        return User::count();
    }
    /** 
     * This function counts leaders
    */
    public function countLeaders(){
        return Client::where('clients.leader','leader')->count();
    }
    /** 
     * This function counts registered clients or riders
    */
    public function countClients(){
        return Client::where('clients.deleted_at',null)->count();
    }
    /** 
     * This function gets sum expected amount as debts
    */
    public function totalDebts(){
        return FuelStation::where('status','pending')->sum('debt');
    }
    /** 
     * This function gets sum of amount paid
    */
    public function totalCurrentAmountPaid(){
        return FuelStation::where('status','paid')->sum('amount_paid');
    }
      /** 
     * This function gets gets amount not paid
    */
    public function totalAmountNotPaid(){
        return $this->totalDebts()-$this->totalCurrentAmountPaid();
    }
    /** 
     * This function gets float for partucular station
    */
    public function calculateFloat(){
        //This function gets float Details
        $initial_float =DB::table('initial_floats')->where('initial_floats.fuel_station_id',auth()->user()->id)->value('float');
        $debts =FuelStation::where('fuel_stations.user_id',auth()->user()->id)->where('status','pending')->sum('debt');
        return $actual_float =$initial_float -$debts;
    }
    public function sumPaidAmount(){
        return $amount_paid =FuelStation::where('fuel_stations.user_id',auth()->user()->id)->where('status','paid')->sum('amount_paid');
    }
    public function actualFloat(){
       return $this->calculateFloat() + $this->sumPaidAmount();
    }
}
