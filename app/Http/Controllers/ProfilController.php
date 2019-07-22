<?php

namespace App\Http\Controllers;

use App\Arsip;
use App\Disposisi;
use App\Surat;
use App\Pegawai;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    //view profile
    public function profil()
    {
        return view('profilPegawai');
    }

    //update data
    public function updateProfil(request $request, $id)
    {
        //Authenticate User yang sedang login
	    $pegawai = Pegawai::find($id);
	    //Update data
	    $pegawai->update([
	         'nama_pegawai'         => $request->input('nama_pegawai'),
	         'email_pegawai'        => $request->input('email_pegawai'),
	         'no_telp_pegawai'      => $request->input('no_telp_pegawai'),
	         'nip'					=> $request->input('nip'),
	         'password'				=> bcrypt($request->input('password'))
	    ]);
	    $data = Pegawai::find($id);
	    Session::put('data', $data);

	    return redirect()->back();
    }

    //update avatar
    public function updateAvatar(request $request, $id)
    {
    	//current foto
    	$foto = Session::get('data')->foto_pegawai;
	    if($foto) {
	      Storage::delete($foto);
	    }

	    //upload gambar
	    $image  = $request->file('foto_pegawai')->store('avatars');

	    //Authenticate User yang sedang login
	    $pegawai = Pegawai::find($id);
	    //Update
	    $pegawai->update([
	         'foto_pegawai'        => $image
	    ]);

	    $data = Pegawai::find($id);
	    Session::put('data', $data);

	    return redirect()->back();
    }

}
