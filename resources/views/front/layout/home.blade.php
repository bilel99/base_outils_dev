<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />

        <title>{{\Config::get('constante.nom_code')}}</title>

        <!-- Vendor Styles -->


        <!-- App Styles -->





        <!-- Vendor JS -->
        <script src="{{ asset('front/js/jquery-1.11.3.min.js') }}"></script>

        <!-- App JS -->




    </head>
    <body>




        @include('front.layout.nav')


        @yield('content')


        @include('front.layout.footer')



    </body>
</html>