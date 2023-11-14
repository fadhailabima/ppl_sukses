<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LengkapiDataMhsController extends Controller
{
    //


    public function index()
    {
        return view('LengkapiData', [
            'title' => 'Lengkapi Data Mahasiswa'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|max:255',
            'email' => 'required|max:255',
            'nim' => 'nullable|integer',
            'angkatan' => 'nullable|integer|digits:4',
            'alamat' => 'required|string',
            'kotakab' => 'required|string',
            'provinsi' => 'required|string',
            'jalurmasuk' => 'required|string',
            'nomortlp' => 'nullable|string|regex:/^[0-9]+$/|between:10,12',
            'password' => 'nullable|min:5|max:255',
            'photo' => 'required|file|image|mimes:png,jpg,jpeg'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        // Check if a file was uploaded
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid() . '.' . $file->getClientOriginalName();
            $file->storeAs('public/photo/', $fileName);
            $validatedData['photo'] = $fileName;
        }

        // Update the user's data
        User::where('id', auth()->user()->id)->update($validatedData);

        return redirect('/dashboardmahasiswa')->with('success', 'Data berhasil di Perbarui');
    }

}