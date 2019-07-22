<?php

use App\Pegawai;
use App\Staf;
use App\Pimpinan;
use App\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //seeder admin
        DB::table('superadmins')->insert([
            'username' => 'superadmin',
            'password' => bcrypt('superadmin')
        ]);

        //seeder instansi 1
        DB::table('instansis')->insert([
            'nama_instansi' => 'Kementerian Luar Negeri'
        ]);

        //seeder instansi 2
        DB::table('instansis')->insert([
            'nama_instansi' => 'Kementerian Kesehatan'
        ]);

        //seeder sektor 1
        DB::table('sektors')->insert([
            'nama_sektor' => 'Pendidikan'
        ]);

        //seeder sektor 2
        DB::table('sektors')->insert([
            'nama_sektor' => 'Kebudayaan'
        ]);

        //seeder sektor 3
        DB::table('sektors')->insert([
            'nama_sektor' => 'Ilmu Pengetahuan'
        ]);

        //seeder sektor 4
        DB::table('sektors')->insert([
            'nama_sektor' => 'Komunikasi dan Informasi'
        ]);

        //seeder staf baru
        $staf = new Staf();
        $staf->save();
        $pegawai =  new Pegawai();
        $pegawai->nama_pegawai = 'Donna';
        $pegawai->nip = '3275052410960014';
        $pegawai->email_pegawai = 'donna@gmail.com';
        $pegawai->no_telp_pegawai = '0821128747595';
        $pegawai->password = bcrypt('secret');
        $pegawai->jabatanable()->associate($staf);
        $pegawai->save();

        //seeder staf baru
        $staf = new Staf();
        $staf->save();
        $pegawai =  new Pegawai();
        $pegawai->nama_pegawai = 'Windu';
        $pegawai->nip = '3275052412690014';
        $pegawai->email_pegawai = 'windu@gmail.com';
        $pegawai->no_telp_pegawai = '0821876547595';
        $pegawai->password = bcrypt('secret');
        $pegawai->jabatanable()->associate($staf);
        $pegawai->save();

        //seeder staf baru
        $staf = new Staf();
        $staf->save();
        $pegawai =  new Pegawai();
        $pegawai->nama_pegawai = 'Gading';
        $pegawai->nip = '3275052112870014';
        $pegawai->email_pegawai = 'gading@gmail.com';
        $pegawai->no_telp_pegawai = '0821123447595';
        $pegawai->password = bcrypt('secret');
        $pegawai->jabatanable()->associate($staf);
        $pegawai->save();

        //seeder admin baru
        $admin = new Admin();
        $admin->save();
        $pegawai =  new Pegawai();
        $pegawai->nama_pegawai = 'Karna';
        $pegawai->nip = '3275051101870015';
        $pegawai->email_pegawai = 'karna@gmail.com';
        $pegawai->no_telp_pegawai = '082112999987';
        $pegawai->password = bcrypt('secret');
        $pegawai->jabatanable()->associate($admin);
        $pegawai->save();

        //seeder pimpinan baru
        $pimpinan = new Pimpinan();
        $pimpinan->save();
        $pegawai =  new Pegawai();
        $pegawai->nama_pegawai = 'Desi';
        $pegawai->nip = '3275051010970014';
        $pegawai->email_pegawai = 'desi@gmail.com';
        $pegawai->no_telp_pegawai = '0821128740987';
        $pegawai->password = bcrypt('secret');
        $pegawai->jabatanable()->associate($pimpinan);
        $pegawai->save();

    }
}
