<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Staf;
use App\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PegawaiController extends Controller
{
    //check if session get login / sudah login atau belum
    public function index(){
        if(!Session::get('login')){
            return redirect('login')->with('alert','Kamu harus login dulu');
        }
        else{
            return view('home');
        }
    }

    //halaman login
    public function login(){
        return view('login');
    }

    //setelah pencet tombol login
    public function loginPost(Request $request){

        $email = $request->email_pegawai;
        $password = $request->password;

        $data = Pegawai::where('email_pegawai', $email)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                //put all user data into 1 session variable
                Session::put('data', $data);
                if(Session::get('data')->jabatanable_type == 'App\Admin'){
                    return redirect('unggah')->with('alert','Berhasil login!');
                } elseif (Session::get('data')->jabatanable_type == 'App\Pimpinan'){
                return redirect('surat')->with('alert','Berhasil login!');
                }else {return redirect('disposisi')->with('alert','Berhasil login!');}
            }
            else{
                return redirect('login')->with('alert','Password atau Email, Salah!');
            }
        }
        else{
            return redirect('login')->with('alert','Password atau Email, Salah!');
        }
    }

    //logout session flush, redirect to login page
    public function logout(){
        Session::flush();
        return redirect('login')->with('alert','Kamu sudah logout');
    }

    //panggil register page
    public function register(Request $request){
        return view('register');
    }

    //setelah pencet tombol register
    public function registerPost(Request $request){
        $this->validate($request, [
            'nama_pegawai' => 'required|min:4',
            // 'nip' => 'required|unique:pegawais',
            'email_pegawai' => 'required|min:4|email|unique:pegawais',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ]);
        $staf = new Staf();
        $staf->save();

        $pegawai =  new Pegawai();
        $pegawai->nama_pegawai = $request->nama_pegawai;
        // $pegawai->nip = $request->nip;
        $pegawai->email_pegawai = $request->email_pegawai;
        // $pegawai->no_telp_pegawai = $request->no_telp_pegawai;
        $pegawai->password = bcrypt($request->password);

        
        $pegawai->jabatanable()->associate($staf);
        $pegawai->save();

        return redirect('login')->with('alert-success','Kamu berhasil Register');
    }
}