<html>
<head>
    <title>Halaman Login Admin</title>
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

        footer{
                background-color: #FFA500;
                padding: 5px;
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;}

         header{
                background-color: #FFA500;
                text-align: center;
                padding: 5px;
                top: 0;
                width: 100%;}
    </style>
</head>
<body>
    <header>@ Amay Kantin</header>
<form method="POST" action="{{ route('HalamanLoginUser') }}">
    @csrf

        <h1>Admin ?????</h1>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

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