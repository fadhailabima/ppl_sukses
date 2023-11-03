<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EditMhsController extends Controller
{
    //


    public function index()
    {
        return view('mahasiswa.editprofileMhs', [
            'title' => 'Profile Mahasiswa'
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
            'name' => 'required|max:255',
            'nim' => 'nullable|integer',
            'jurusan' => 'required|string',
            'angkatan' => 'nullable|integer|digits:4',
            'alamat' => 'required|string',
            'nomortlp' => 'required|digits_between:8,12:',
            'photo' => 'nullable|file|image|mimes:png,jpg,jpeg'
        ]);

        // Check if a file was uploaded
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = uniqid() . '.' . $file->getClientOriginalName();
            $file->storeAs('public/photo/', $fileName);
            $validatedData['photo'] = $fileName;
        }

        // Update the user's data
        User::where('id', auth()->user()->id)->update($validatedData);

        return redirect('dashboardmahasiswa/profile/edit')->with('success', 'Data berhasil di Perbarui');
    }

}