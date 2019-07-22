<html>
    <head>

        <meta name="description" content="Ancient Archieve is a website to Archieve and store your Docs" />
        <meta name="author" content="The Unsung Heroes">

        <!-- Mobile Webs -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">
        <meta name="mobile-web-app-capable" content="yes">

        <title>
            Masuk | SIKSM KNIU
        </title>

        <!-- Website Theme -->
        <meta id="theme-color" name="theme-color" content="#1869a0">
        <link rel="stylesheet" href="{{ asset('beranda/css/login.css') }}" />
        <link rel="icon" type="image/png" href="https://4erff29jo03b8uhp4b94vxhq-wpengine.netdna-ssl.com/wp-content/uploads/2015/05/caspio-features-illustr_cloud-data_3_2x.png"/>
    </head>

    <body>
        <div class="se-pre-con"></div>

        <div class="container-head">
            <img class="icon" href="{{ url('/') }}" src="{{ asset('beranda/icon/unesco.png') }}" alt="Login-icon">
        </div>

        <div class="container-body">

            <div class="container-card">
                <p>&nbsp;</p>
                <div class="login-header">
                    <img class="icon" src="{{ asset('beranda/icon/login.png') }}" alt="Login-icon">
                    <h2>Masuk</h2>
                </div>

                <!-- login error -->
                @if(\Session::has('alert'))
                <div class="alert alert-danger">
                    <div>{{Session::get('alert')}}</div>
                </div>
                @endif
                <!-- login berhasil -->
                @if(\Session::has('alert-success'))
                    <div class="alert alert-success">
                        <div>{{Session::get('alert-success')}}</div>
                    </div>
                @endif

                <form action="{{ url('/loginPost') }}" method="POST">
                  @csrf
                    <div>
                        <label for="email_pegawai" ><b>Surel</b></label>
                        <br>
                        <input name="email_pegawai" type="email" autofocus>
                    </div>
                    <div>
                        <label for="password" ><b>Sandi</b></label>
                        <br>
                        <input name="password" type="password">
                    </div>
                    <button class="button">Masuk</button>
                </form>

            </div>

            <h1>Arsip Surat <br> KNIU.</h1>
            <p>Make Your Archive More Secure!</p>
        </div>


        <!-- JQuery -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

        <script>
            $(window).load(function() {
                $(".se-pre-con").fadeOut("slow");;
            });
        </script>

    </body>
</html>
