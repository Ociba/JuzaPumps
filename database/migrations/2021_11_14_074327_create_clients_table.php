<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('first_name');
            $table->string('other_names');
            $table->string('town');
            $table->string('region');
            $table->string('date_of_birth');
            $table->string('telephone');
            $table->string('number_plate');
            $table->string('id_number');
            $table->string('stage_name');
            $table->string('stage_leader');
            $table->string('stage_leader_contact');
            $table->string('debt');
            $table->string('amount_paid')->nullable();
            $table->string('date_paid')->nullable();
            $table->string('days');
            $table->string('profile_photo_path');
            $table->enum('status',['pending','overdue','cleared'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
