<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use App\Imports\ImportMahasiswa;
// use Maatwebsite\Excel\Facades\Excel;

class RegisterController extends Controller
{
    public function index()
    {
        return view('operator.register', [
            'title' => 'Daftar User Baru'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'name' => 'required|max:255',
            'nim' => 'required',
            'angkatan' => 'required',
            'level' => 'required',
            'status' => 'required',
            'dosenwali' => 'max:255',
            'password' => 'required|min:5|max:255'
        ]);
        //cara keduia
        $validatedata['password'] = bcrypt($validatedata['password']);
        //$validatedata['password'] = Hash::make($validatedata['password']);
        User::create($validatedata)->with('success', 'Registrasi Berhasil');

        //alert pertama
        //$request->session()->flash('success', 'Registrasi Berhasil, Silahkan login');


        return redirect('/dashboardadmin/register')->with('success', 'Registrasi Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function show(User $user)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $user)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, User $user)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function destroy(User $user)
    // {
    //     //
    // }
    // public function import(Request $request)
    // {
    //     $this->validate($request, [
    //         'file' => 'required|mimes:csv,xls,xlsx'
    //     ]);
    //     $file = $request->file('file');
    //     $nama_file = rand() . $file->getClientOriginalName();
    //     $file->move('data_file', $nama_file);
    //     Excel::import(new ImportMahasiswa, public_path('/data_file/' . $nama_file));
    //     return redirect('/dashboardadmin/register')->with('success', 'Registrasi Berhasil');
    // }

    // public function download()
    // {
    //     $filepath = public_path("data_file/template.xlsx");
    //     return response()->download($filepath);
    // }
}