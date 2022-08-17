<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function index()
    {

        $tasks = auth()->user()->role === 'ADMIN' ? Task::orderByDesc('id')->with(['users'])->get() : Task::orderByDesc('id')->where('user_id', auth()->user()->id)->with(['users'])->get();
        $users = User::where('role', 'KARYAWAN')->get();
        $districts = District::all();
        return view('dashboard.task.index', [
            'tasks' => $tasks,
            'users' => $users,
            'districts' => $districts
        ]);
    }

    public function destroy($id)
    {
        Task::find($id)->delete();

        return redirect('/dashboard/tasks')->with('delete', 'Data tugas berhasil dihapus!');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "user_id" => "required",
            "task_name" => "required",
            "district_id" => "required",
            "status" => "required",
        ]);
        Task::create($validatedData);
        return back()->with('success', 'Data tugas berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            "user_id" => "required",
            "task_name" => "required",
            "district_id" => "required",
            "status" => "required",
        ]);

        Task::where('id', $request->id)->update($validatedData);

        if (auth()->user()->role === 'ADMIN') {
            return back()->with('update', 'Data tugas berhasil diubah!');
        }
        return back()->with('finishTask', $request->task_name);
    }
}
