<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $taskCount = auth()->user()->role === 'ADMIN' ? Task::count() : Task::where('user_id', auth()->user()->id)->count();
        $unfinishedTasks = auth()->user()->role === 'ADMIN' ? Task::where('status', 'Belum Terlaksana')->count() : Task::where(['status' => 'Belum Terlaksana', 'user_id' => auth()->user()->id])->count();
        $finishedTasks = Task::where('status', 'Terlaksana')->count();
        $districtCount = District::count();
        $usersCount = User::count();
        $adminCount = User::where('role', 'ADMIN')->count();
        $karyawanCount = User::where('role', 'KARYAWAN')->count();

        //table data
        $finished_tasks = auth()->user()->role === 'ADMIN' ? Task::where('status', 'Terlaksana')->get() : Task::where(['status' => 'Terlaksana', 'user_id' => auth()->user()->id])->get();
        $unfinished_tasks = auth()->user()->role === 'ADMIN' ? Task::where('status', 'Belum Terlaksana')->get() : Task::where(['status' => 'Belum Terlaksana', 'user_id' => auth()->user()->id])->get();

        return view('dashboard.index', [
            'tasks_count' => $taskCount,
            'unfinished_tasks_count' => $unfinishedTasks,
            'finished_tasks_count' => $finishedTasks,
            'districts_count' => $districtCount,
            'users_count' => $usersCount,
            'admin_count' => $adminCount,
            'karyawan_count' => $karyawanCount,
            'finished_tasks' => $finished_tasks,
            'unfinished_tasks' => $unfinished_tasks,
        ]);
    }
}
