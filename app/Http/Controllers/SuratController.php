<?php

namespace App\Http\Controllers;

use App\Surat;
use App\Admin;
use App\Pegawai;
use App\Instansi;
use App\Sektor;
use App\Disposisi;
use App\Arsip;
use App\Dokumen;
use DB;
use ZipArchive;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class SuratController extends Controller
{
    //get form surat baru
    public function createSurat()
    {
        //memanggil form untuk buat surat baru
        $instansis  = Instansi::all();
        $sektors    = Sektor::all();
        return view('unggahSurat', compact('instansis', 'sektors'));
    }

    //simpan form surat baru
    public function storeSurat(Request $request)
    {
        //upload gambar
        $image  = $request->file('image')->store('gambar');
        //check if instansi already exists
        $instansi = Instansi::all()->where('nama_instansi', $request->pengirim_surat)->first();
        //get sektor
        $sektor = Sektor::all()->where('nama_sektor', $request->tujuan_surat)->first();
        //check siapa yang mengunggah
        $jabatan = Session::get('data')->jabatanable_type;
        $id_jabatan = Session::get('data')->jabatanable_id;
        //buat instansi baru jika belum ada
        if (!$instansi) {
            Instansi::create([
                'nama_instansi' => $request->pengirim_surat
            ]);
            $instansi_baru = Instansi::all()->where('nama_instansi', $request->pengirim_surat)->first();
            $id_instansi = $instansi_baru->id_instansi;
        } else { $id_instansi = $instansi->id_instansi; }
        
        //foreign key
        $id_sektor      = $sektor->id_sektor;
        $id_admin = $id_jabatan;

        $surat = Surat::create([
            'no_surat'                => $request->no_surat,
            'perihal_surat'           => $request->perihal_surat,
            'tanggal_surat'           => $request->tanggal_surat,
            'id_sektor'               => $id_sektor,
            'id_instansi'             => $id_instansi,
            'id_admin'                => $id_admin
        ]);

        Dokumen::create([
            'image' => $image,
            'id_surat' => $surat->id_surat
        ]); 

        //redirect halaman daftar surat masuk
        //redirect ke show surat
        return redirect('/surat');
    }

    //show semua surat di database
    public function showSurat(surat $surat)
    {
        //id pegawai yang sedang login
        $pegawais = Pegawai::all()->except(Session::get('data')->id_pegawai);
        //view semua daftar surat
        $surats = Surat::all();
        //jabatan yang sedang login
        $user = Session::get('data')->jabatanable_type;

        $jumlahsuratbaru = $surats->where('status_surat', 'baru')->count(); //jumlah surat baru diupload
        $jumlahsurattinjau = $surats->where('status_surat', 'tinjau')->count(); //jumlah surat sedang ditinjau

        if (Session::get('data')->jabatanable_type == 'App\Admin') {
            return view('admin_suratBaru', compact('surats', 'jumlahsuratbaru', 'jumlahsurattinjau'));    
        } else {
            return view('pimpinan_suratBaru', compact('surats', 'jumlahsuratbaru', 'jumlahsurattinjau', 'pegawais'));
        }
    }

    // proses surat untuk ditinjau pimpinan
    public function prosesSurat($id)
    {
        //update surat
        //update status surat
        $surat = Surat::find($id);
        $surat->status_surat = 'tinjau';
        $surat->save();

        return redirect()->back();

    }

    // cancel surat yang sudah mau ditinjau pimpinan
    public function cancelSurat($id)
    {
        //menurunkan status surat
        $surat = Surat::find($id);
        $surat->status_surat = 'baru';
        $surat->save();

        return redirect()->back();
    }

    // download surat
    public function downloadSurat($id)
    {
        // semua gambar pada surat
        $dokumens = Dokumen::where('id_surat', $id)->get();
        $storage_dir = storage_path();
        $surat = Surat::find($id);
        //zip name
        $zipFileName = $surat->perihal_surat . '.zip';
        //create new zip
        $zip = new ZipArchive;
        if ($zip->open($storage_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
            //add file
            foreach ($dokumens as $dokumen) {
              $zip->addFile(storage_path("app/public/{$dokumen->image}"), $dokumen->id_dokumen . '.pdf');
            }
            //close ziparchive
            $zip->close();
        }
        // Set Header
        $headers = array(
            'Content-Type' => 'application/zip',
        );
        $filetopath=$storage_dir.'/'.$zipFileName;
        // Create Download Response
        if(file_exists($filetopath)){
                return response()->download($filetopath,$zipFileName,$headers);
        }

        // return response()->download(storage_path("app/public/{$dokumen->image}"));
    }

    //get individual surat
    public function detailSurat($id)
    {
        //menampilkan detil informasi setiap surat
        $surat = Surat::find($id);
        $images = Dokumen::all()->where('id_surat', $id);
        $id_current_user = Session::get('data')->jabatanable_id;
        //pengunggah
        $id_admin = $surat->id_admin;
        $admin = Admin::find($id_admin);
        $pegawai = $admin->pegawais;

        return view('detailSurat', compact('surat', 'admin', 'id_current_user', 'images', 'pegawai'));
    }

    //form edit surat
    public function editSurat($id)
    {
        //halaman edit surat
        $instansis  = Instansi::all();
        $sektors    = Sektor::all();
        $surat = Surat::find($id);
        return view('editSurat', compact('surat', 'instansis', 'sektors'));

    }

    //save editan surat
    public function updateSurat(Request $request, $id)
    {
        //check if instansi already exists
        $instansi = Instansi::all()->where('nama_instansi', $request->input('pengirim_surat'))->first();
        //get sektor
        $sektor = Sektor::all()->where('nama_sektor', $request->input('tujuan_surat'))->first();
        //buat instansi baru jika belum ada
        if (!$instansi) {
            Instansi::create([
                'nama_instansi' => $request->input('pengirim_surat')
            ]);
        };

        //foreign key
        $id_sektor      = $sektor->id_sektor;
        $id_instansi    = $instansi->id_instansi;

        //update suratnya
        $surat = Surat::find($id);
        $surat->update([
          'no_surat'                => $request->input('no_surat'),
          'perihal_surat'           => $request->input('perihal_surat'),
          'tanggal_surat'           => $request->input('tanggal_surat'),
          'id_sektor'               => $id_sektor,
          'id_instansi'             => $id_instansi,
        ]);

        return redirect('/surat/detail/' . $id);
    }

    //hapus surat
    public function destroySurat()
    {
        //hapus surat
        $id = $_POST['id_surat'];
        $surat = Surat::find($id);
        $surat->delete();

        return redirect()->back();
    }
}
