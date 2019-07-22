<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Anak IT -  Tutorial Login, Register, Validasi dengan Laravel 5.4</h1>
            <p>Hallo, {{Session::get('nama_pegawai')}}. Apakabar?</p>

            <h2>* Email kamu : {{Session::get('email_pegawai')}}</h2>
            <h2>* Status Login : {{Session::get('login')}}</h2>
            
            <h2>{{$staf}}</h2>
            <h2>{{$pimpinan}}</h2>
            
            <a href="/logout" class="btn btn-primary btn-lg">Logout</a>

        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->

</body>
</html>
    
