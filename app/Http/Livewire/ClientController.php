<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;

class ClientController extends Component
{
    public $user_id, $first_name, $other_names, $town_id, $region, $date_of_birth, $telephone,
           $number_plate, $id_number, $stage_name, $stage_leader, $stage_leader_contact, $debt,
            $amount_paid,$date_paid,$days, $profile_photo_path, $get_clients;
    public function render()
    {
        $this ->get_clients = Client::join('users','clients.user_id','clienst.id')
        ->where('clients.deleted_at',null)->simplePaginate(10);
        return view('livewire.client-controller');
    }
    //This function declares input
    private function resetInputFields(){
        $this->user_id = '';
        $this->first_name = '';
        $this->other_names = '';
        $this->town_id = '';
        $this->region = '';
        $this->date_of_birth = '';
        $this->telephone = '';
        $this->number_plate = '';
        $this->id_number = '';
        $this->stage_name = '';
        $this->stage_leader = '';
        $this->debt = '';
        $this->amount_paid = '';
        $this->date_paid = '';
        $this->days = '';
        $this->profile_photo_path = '';
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        User::create($validatedDate);

        session()->flash('message', 'Users Created Successfully.');

        $this->resetInputFields();

    }
}
