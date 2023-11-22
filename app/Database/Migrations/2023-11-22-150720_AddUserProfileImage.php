<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserProfileImage extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'profile_pic' => ['type' => 'TEXT'],
            // Add more fields here as needed
        ]);
    }

    public function down()
    {
        //
    }
}
