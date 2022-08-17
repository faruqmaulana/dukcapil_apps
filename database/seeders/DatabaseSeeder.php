<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\District;
use App\Models\Post;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //create admin
        User::create([
            'name' => 'admin',
            'email' => '1@gmail.com',
            'password' => bcrypt('1'),
            'divisi' => 'NULL',
            'jabatan' => 'NULL',
            'role' => 'ADMIN'
        ]);

        //create karyawan
        User::create([
            'name' => 'Angga Lucu',
            'email' => '2@gmail.com',
            'password' => bcrypt('2'),
            'divisi' => 'Humas',
            'jabatan' => 'Kepala Dinas',
            'role' => 'KARYAWAN'
        ]);

        User::create([
            'name' => 'Angga Sasongko',
            'email' => '3@gmail.com',
            'password' => bcrypt('3'),
            'divisi' => 'Humas',
            'jabatan' => 'Kepala Dinas',
            'role' => 'KARYAWAN'
        ]);

        //create district
        District::create([
            'name' => 'Pagu',
        ]);

        District::create([
            'name' => 'Mojo',
        ]);

        //create task
        Task::create([
            'user_id' => '2',
            'task_name' => 'tugas pertamamu nih',
            'district_id' => '1',
            'status' => 'Belum terlaksana'
        ]);

        Task::create([
            'user_id' => '3',
            'task_name' => 'tugas baru',
            'district_id' => '1',
            'status' => 'Belum terlaksana'
        ]);

        Task::create([
            'user_id' => '2',
            'task_name' => 'tugas',
            'district_id' => '2',
            'status' => 'terlaksana'
        ]);
    }
}
