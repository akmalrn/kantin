<html>
    <head>
        <title>
            Halaman Login Pembeli
        </title>
            <style>
        body {
            background-image: url('/gambar/Foto Amay.jpg');
        background-size: 100% 100%;
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        footer{background-color: #FFA500;
                    padding: 10px;
                    position: fixed;
                            bottom: 0;
                        width: 100%;}

                    header{background-color: #FFA500;
                    padding: 10px;
                            top: 0;
                        width: 100%;}

                        .home{
            position: fixed;
            top: 7%;
            left: 1%;
            color: white;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        .arrowleft{
        border: solid white;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
        transform: rotate(135deg);
        -webkit-transform: rotate(135deg);
        } 
            </style>
    </head>
    <body>

@if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div  class="home" >
        <a href="{{ route('Pembelian') }}"><i class="arrowleft"></i></a>
        </div>  
    <header>@ Amay Kantin</header>
<form method="POST" action="{{ route('HalamanLoginPembeli') }}">
    @csrf
    <h1>Pembeli Log In</h1>
    <label for="email">Username:</label>
    <input type="text" name="nama_pembeli" required>

    <label for="password">Password:</label>
    <input type="password" name="password_pembeli" required>

    <button type="submit">Login</button>
</form>

@if(session('error'))
    <div>{{ session('error') }}</div>
@endif
</body>
<footer>
    Hak Cipta &copy; Kantin Amay 2024.
</footer>
</html>