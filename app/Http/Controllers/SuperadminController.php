<?php

namespace App\Http\Controllers;

use App\Superadmin;
use App\Admin;
use App\Pegawai;
use App\Pimpinan;
use App\Staf;
use App\Surat;
use App\Dokumen;
use App\Instansi;
use App\Sektor;
use App\Arsip;
use App\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SuperadminController extends Controller
{
    //halaman login
    public function login(){
        return view('superadmin_login');
    }

    //setelah pencet tombol login
    public function loginPost(Request $request){

        $username = $request->username;
        $password = $request->password;

        $data = Superadmin::where('username', $username)->first();
        if($data){ //apakah username tersebut ada atau tidak
            if(Hash::check($password, $data->password)){
                Session::put('username', $data->username);
                Session::put('login', TRUE);
                return redirect('superadmin_dataPegawai');
            }
            else {
                return redirect('superadmin')->with('alert','Password atau Email, Salah !');
            }
        }
        else{
            return redirect('superadmin')->with('alert','Password atau Email, Salah!');
        }
    }

    //logout session flush, redirect to login page
    public function logout(){
        Session::flush();
        return redirect('superadmin')->with('alert','Kamu sudah logout');
    }

    //data pegawai
    public function dataPegawai()
    {
        //send all user data to data pegawai page
        $dataPegawai = Pegawai::all();
        return view('superadmin_dataPegawai', compact('dataPegawai'));
    }

    //menjadikan admin
    public function setAdmin($id)
    {
    	//locate record pegawai
        $pegawai =  Pegawai::find($id);

        //cek apakah staf atau pimpinan
        if ($pegawai->jabatanable_type == 'App\Pimpinan') { //jika pimpinan
        	//buat admin baru
	        $admin = new Admin();
	        $admin->save();
	        
	        //hapus pegawai dari daftar pimpinan
	        $delete = Pimpinan::find($pegawai->jabatanable_id);
	        $delete->delete();
	        //asosiasi admin baru di tabel pegawai
	        $pegawai->jabatanable()->associate($admin);
	        $pegawai->save();
        } else {	//jika staf
        	//buat admin baru
	        $admin = new Admin();
	        $admin->save();
	        
	        //hapus pegawai dari daftar staf
	        $delete = Staf::find($pegawai->jabatanable_id);
	        $delete->delete();
	        //asosiasi admin baru di tabel pegawai
	        $pegawai->jabatanable()->associate($admin);
	        $pegawai->save();
        }

        return redirect()->back();
    }

    //menjadikan pimpinan
    public function setPimpinan($id)
    {
        //locate record pegawai
        $pegawai =  Pegawai::find($id);

        //cek apakah admin atau staf
        if ($pegawai->jabatanable_type == 'App\Admin') { //jika admin
        	//buat pimpinan baru
	        $pimpinan = new Pimpinan();
	        $pimpinan->save();
	        
	        //hapus pegawai dari daftar admin
	        $delete = Admin::find($pegawai->jabatanable_id);
	        $delete->delete();
	        //asosiasi pimpinan baru di tabel pegawai
	        $pegawai->jabatanable()->associate($pimpinan);
	        $pegawai->save();
        } else {	//jika staf
        	//buat pimpinan baru
	        $pimpinan = new Pimpinan();
	        $pimpinan->save();
	        
	        //hapus pegawai dari daftar staf
	        $delete = Staf::find($pegawai->jabatanable_id);
	        $delete->delete();
	        //asosiasi pimpinan baru di tabel pegawai
	        $pegawai->jabatanable()->associate($pimpinan);
	        $pegawai->save();
        }

        return redirect()->back();
    }

    //menjadikan staf
    public function setStaf($id)
    {
        //locate record pegawai
        $pegawai =  Pegawai::find($id);

        //cek apakah admin atau pimpinan
        if ($pegawai->jabatanable_type == 'App\Admin') { //jika admin
        	//buat staf baru
	        $staf = new Staf();
	        $staf->save();
	        
	        //hapus pegawai dari daftar admin
	        $delete = Admin::find($pegawai->jabatanable_id);
	        $delete->delete();
	        //asosiasi staf baru di tabel pegawai
	        $pegawai->jabatanable()->associate($staf);
	        $pegawai->save();
        } else {	//jika pimpinan
        	//buat staf baru
	        $staf = new Staf();
	        $staf->save();
	        
	        //hapus pegawai dari daftar pimpinan
	        $delete = Pimpinan::find($pegawai->jabatanable_id);
	        $delete->delete();
	        //asosiasi staf baru di tabel pegawai
	        $pegawai->jabatanable()->associate($staf);
	        $pegawai->save();
        }

        return redirect()->back();
    }

    //menghapus akun user
    public function destroyUser($id)
    {
        $pegawai = Pegawai::find($id);
        if ($pegawai->jabatanable_type == 'App\Staf') {
            $delete = Staf::find($pegawai->jabatanable_id);
            $delete->delete();
        } elseif ($pegawai->jabatanable_type == 'App\Pimpinan') { 
            $delete = Pimpinan::find($pegawai->jabatanable_id); 
            $delete->delete();
        } else {
        	$delete = Admin::find($pegawai->jabatanable_id); 
            $delete->delete();
        }
        $delete = Pegawai::find($id);
        $delete->delete();

        return redirect()->back();
    }

}