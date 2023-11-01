<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siap Undip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap"
    />
    <style>
        .logo-undip {
            position: absolute;
            top: 12;
            left: 12;
            width: 56px;
            height: 56px;
            object-fit: cover;
        }
        .ap {
            color: #211792;
        }
        .siap-undip {
            position: absolute;
            top: 14px;
            left: 66px;
        }
    </style>
</head>

<body style="background-color:#bfdeeb">
    <div style="position: relative;">
        <img src="{{ asset('images/logo.png') }}" alt="Informatika Undip" width="200" class="logo-undip">
        <h5 style="font-family: 'Poppins';" class="siap-undip">
          <span>Sistem Monitoring Mahasiswa</span>
          <br>
          <span class="ap">UNDIP</span>
        </b>
    </div>   
    
    <br><br><br><br>
    <div class="container d-flex justify-content-center">
        <div class="card mt-4" style="width: 490px; height: 430px; border-radius: 16px; background-color: #083c7859;" style="box-shadow: 2px 2px rgb(69, 67, 67);">
            <section class="jumbotron text mt-4">
                <br>
                <h3 class="display-10 mt-2" style="text-size-adjust: 30.7px; margin-left: 20px; font-family: 'Poppins';"><b>Selamat Datang</b></h3>
                <h6 class="display-10" style="margin-left: 20px; font-family: 'Poppins';">Silakan login menggunakan user anda</h6>
                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-4" style="display: print-inline;">           
                </h6>
            </section>
            @if (session()->has('logingagal'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('logingagal') }}
            </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-auto">
                    <form class="user" action="/" method="POST">
                        <table style="width:auto">
                            @csrf
                            <tr>
                                <td style="width: 150px; font-family: 'Poppins';">
                                    <b>Email</b>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="email" name="email" style="font-family: 'Poppins';" class="form-control mb-2"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            id="email" placeholder="Email Address" required
                                            value="{{ old('email') }}" autofocus>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <br>
                            <tr>
                                <td style="font-family: 'Poppins';">
                                    <b>Password</b>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="password" name="password" style="font-family: 'Poppins';"  class="form-control mb-2"
                                        class="form-control form-control-user @error('password') is-invalid @enderror"
                                        id=" password" placeholder="Input your password" required>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                                
                            </tr>
                        </table>

                        <br>    
                        <div class="col-md-12 text-center">
                            <button class="btn ps-5 pe-5 pb-2 pt-2 text-center text-light" name= "submit" style="background-color: #101E31; font-family: 'Poppins';" type="submit">
                                Login
                            </button>
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>