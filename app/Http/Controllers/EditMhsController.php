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
        $validatedata = $request->validate([
            'name' => 'required|max:255',
            'nim' => 'nullable|integer',
            'jurusan' => 'required|string',
            'angkatan' => 'nullable|integer|digits:4',
            'alamat' => 'required|string',
            'nomortlp' => 'required|digits_between:8,12:',
            // 'photo' => 'nullable|file|image|mimes:png,jpg,jpeg'
        ]);

        // $file = $request->file('photo');
        // $fileName = uniqid(). '.'. $file->getClientOriginalExtension();
        // $file->storeAs('public/photo/', $fileName);
        // $validatedata['photo'] = $fileName;
        //('angkatan', $id)->get();
        // $validatedata['id'] = auth()->user()->id;

        User::where('id', auth()->user()->id)->update($validatedata);

        return redirect('dashboardmahasiswa/profile/edit')->with('success', 'Data berhasil di Perbarui');

    }
}