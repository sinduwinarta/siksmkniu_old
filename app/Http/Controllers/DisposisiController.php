<?php

namespace App\Http\Controllers;

use App\Disposisi;
use App\Surat;
use App\Pegawai;
use App\Dokumen;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DisposisiController extends Controller
{
    //list semua disposisi
    public function index(disposisi $disposisi)
    {   
        //check if staf logged in
        if (Session::get('data')->jabatanable_type == 'App\Staf') {
            //get disposisi yang sesuai dengan staf yang sedang login
            $disposisis = Disposisi::all()->where('id_staf', Session::get('data')->jabatanable_id);
            $jumlahdisposisi = $disposisis->count(); //hitung semua disposisi
        } elseif (Session::get('data')->jabatanable_type == 'App\Pimpinan') {
            $disposisis = Disposisi::all(); //get semua disposisi
            $jumlahdisposisi = Disposisi::all()->count(); //hitung semua disposisi
        } else {
            $jumlahdisposisi = 0; //bukan staf yang punya disposisi atau pimpinan
        }

        $pimpinans = Pegawai::all()->where('jabatanable_type', 'App\Pimpinan');
        return view('disposisiSurat', compact('disposisis', 'jumlahdisposisi', 'pimpinans'));
    }

    //simpan disposisi baru
    public function storeDisposisi(Request $request)
    {
        //get id staf tujuan disposisi
        $id_staf = Pegawai::all()->where('nama_pegawai', $request->nama_pegawai)->first()->jabatanable_id;

        Disposisi::create([
          'pesan_disposisi'         => $request->pesan_disposisi,
          'id_pimpinan'             => Session::get('data')->jabatanable_id,
          'id_staf'                 => $id_staf,
          'id_surat'                => $request->id_surat
        ]);

        //update status surat
        $surat = Surat::find($request->id_surat);
        $surat->status_surat = 'disposisi';
        $surat->save();

        return redirect()->back();
    }

    //buka salah satu disposisi (details)
    public function detailDisposisi($id)
    {
        $pimpinans = Pegawai::all()->where('jabatanable_type', 'App\Pimpinan');
        $stafs = Pegawai::all()->where('jabatanable_type', 'App\Staf');

        $id_surat = Disposisi::find($id)->surat->id_surat;
        //menampilkan detil informasi surat yang didisposisi
        $surat = Surat::all()->where('id_surat', $id_surat)->first();

        $disposisi = Disposisi::find($id);
        $images = Dokumen::all()->where('id_surat', $id_surat);
        return view('detailDisposisi', compact('surat', 'disposisi', 'pimpinans', 'stafs', 'images'));
    }

    //ubah disposisi
    public function editDisposisi(disposisi $disposisi)
    {
        //
    }

    //update disposisi sudah selesai
    public function updateDisposisi($id)
    {
        $disposisi = Disposisi::find($id);
        $id_surat = $disposisi->surat->id_surat;
        $surat = Surat::find($id_surat);
        $surat->status_surat = 'selesai';
        $surat->save();

        return redirect()->back();
    }

    //hapus disposisi
    public function destroyDisposisi()
    {
        $id = $_POST['id_disposisi'];
        $disposisi = Disposisi::find($id);
        $id_surat = $disposisi->surat->id_surat;
        $surat = Surat::find($id_surat);
        $surat->status_surat = 'tinjau';
        $surat->save();

        //hapus disposisi
        $disposisi->delete();

        return redirect()->back();
    }
}
