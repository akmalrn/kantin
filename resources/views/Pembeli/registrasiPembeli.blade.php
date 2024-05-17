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
                    padding: 5px;
                    text-align: center;
                    position: fixed;
                            bottom: 0;
                        width: 100%;}

                    header{background-color: #FFA500;
                    padding: 5px;
                    text-align: center;
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

<header>@ Amay Kantin</header>
<div  class="home" >
        <a href="{{ route('halamanUser') }}"><i class="arrowleft"></i></a>
        </div>  
<form method="POST" action="{{ route('HalamanRegistrasiPembeli') }}">
    <table>
    @csrf
    <h1>Registrasi Pembeli</h1>
    <tr>
        <td><label for="nama_pembeli">Nama:</label></td>
        <td><input type="text" name="nama_pembeli" id="nama_pembeli" value="{{ old('nama_pembeli') }}" required autofocus></td>
    </tr>

    <tr>
        <td><label for="password_pembeli">Password:</label></td>
        <td><input type="password" name="password_pembeli" id="password_pembeli" required></td>
    </tr>

    <tr>
        <td><label for="alamat_pembeli">Alamat:</label></td>
        <td><input type="text" name="alamat_pembeli" id="alamat_pembeli" required></td>
    </tr>

    <tr>
        <td><label for="no_hp_pembeli">Nomor Hp:</label></td>
        <td><input type="number" name="no_hp_pembeli" id="no_hp_pembeli" required></td>
    </tr>

    <tr>
    <td><label for="jk_pembeli">Jenis Kelamin:</label></td>
    <td><select name="jk_pembeli" id="jk_pembeli">
           <option value="Laki-laki">Laki-laki</option>
           <option value="Perempuan">Perempuan</option>
            </select></td>
    </tr>


    <tr>
        <td></td>
        <td><button type="submit">Daftar</button></td>
    </tr>   
        </table>
    </tr>
</form>
<footer>
    Hak Cipta &copy; Kantin Amay 2024.
</footer>