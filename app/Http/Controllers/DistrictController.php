<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('dashboard.district.index', [
            'districts' => District::all()
        ]);
    }

    public function destroy($id)
    {
        District::find($id)->delete();

        return redirect('/dashboard/districts')->with('delete', 'Data kecamatan berhasil dihapus!');
    }

    public function store(Request $request)
    {  
        $validatedData = $request->validate([
            "name" => "required",
        ]);
        District::create($validatedData);
        return redirect('/dashboard/districts')->with('success', 'Data Kecamatan berhasil ditambahkan');
    }

    public function update(Request $request)
    {   
        $validatedData = $request->validate([
            "name" => "required",
        ]);     

        District::where('id', $request->id)->update($validatedData);
        return back()->with('update', 'Data Kecamatan berhasil diubah!');
    }

}
