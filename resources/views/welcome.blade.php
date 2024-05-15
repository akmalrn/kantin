<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>


        <!-- Styles -->
        <style>
                footer{background-color: #FFA500;
                    padding: 20px;
                    position: fixed;
                            bottom: 0;
                        width: 100%;}

                    header{background-color: #FFA500;
                    padding: 20px;
                    position: fixed;
                            top: 0;
                        width: 100%;}

          
            .container1 {position: fixed;
                        background-color: #7C0016;
                        padding:20px;
                        margin:20% 0% 20% 35%;}
            .container2{position:fixed;
                        background-color: #7C0016;
                        padding:20px;
                        margin:20% 0% 20% 50%;}
            .karakter{padding:20px;
                        margin:15% 0% 20% 41%;
                        position:fixed;}
            a{color:white;}
            a:hover{color: black;}
        </style>
    </head>
<header>@ Amay Kantin</header>
    <body>
        <div class="karakter">Pilih Karakter Anda</div>
                   <div class="container1">
                        <a href="{{ route('HalamanLoginPembeli') }}" >Login_Pembeli</a>
                   </div>
                   <div class="container2">
                        <a href="{{ route('HalamanLoginPenjual') }}">Login_Penjual</a>
                   </div>
                
            
    </body>
    <footer># Kantin Amay</footer>
</html>
