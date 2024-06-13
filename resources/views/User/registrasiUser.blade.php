<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Registrasi User</title>
    <style>
       body {
            background-image: url('/gambar/Foto Amay.jpg');
            background-size: 100% 100%;
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

        h2 {
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
            background-color: #7C0016;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        header{background-color: #FFA500;
                padding: 10px;}

        footer{background-color: #FFA500;
                padding: 10px;}
                .home {
            position: fixed;
            top: 8%;
            left: 1%;
            color: white;
            background-color: #337ab7;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        .arrowleft {
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
    <header>
        @ Amay Kantin
</header>
<div class="home">
    <a href="{{ route('halamanUser') }}"><i class="arrowleft"></i></a>
</div>
    <form method="post" action="{{ route('HalamanRegistrasiUser') }}">
        @csrf

        <h2>Wehehehe :></h2>

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" name="password_confirmation" required>

        <label for="role">Role:</label>
        <select name="role" id="role">
            <option value="admin">admin</option>
            <option value="pembeli">pembeli</option>
            <option value="penjual">penjual</option>
        </select><br><br>

        <button type="submit">Register</button>
    </form>

    <footer>
    Hak Cipta &copy; Kantin Amay 2024.
</footer>
</body>

</html>
