<html>
    <head>

        <meta name="description" content="SIKSM adalah sistem informasi untuk memudahkan proses arsip surat di KNIU" />
        <meta name="author" content="Joe">

        <!-- Mobile Webs -->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">
        <meta name="mobile-web-app-capable" content="yes">

        <title>
            Arsip Surat KNIU
        </title>

        <!-- Website Theme -->
        <meta id="theme-color" name="theme-color" content="#1968a0">
        <link rel="stylesheet" href="{{ asset('beranda/css/main.css') }}" />
        <link rel="icon" type="image/png" href="https://4erff29jo03b8uhp4b94vxhq-wpengine.netdna-ssl.com/wp-content/uploads/2015/05/caspio-features-illustr_cloud-data_3_2x.png"/>
    </head>

    <body>
        <div class="se-pre-con"></div>

        <div class="container-head">
            <img class="icon" href="{{ url('/') }}" src="{{ asset('beranda/icon/unesco.png') }}" alt="Login-icon">
            <a class="login" href="{{ url('/register') }}">Daftar</a>
            <a> &nbsp;/&nbsp; </a>
            <a class="login" href="{{ url('/login') }}">Masuk</a>
        </div>

        <div class="container-body">
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
