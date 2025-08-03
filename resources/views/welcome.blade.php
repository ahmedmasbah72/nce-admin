<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Consept Equipement</title>
    <link rel="icon" href="images/NCE_logo2.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
       
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #000;
            background-color: #fff;
            background-size: cover;
            background-attachment: fixed;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-image: url('{{ asset('images/mm.jpg') }}');
        
        }

        #div1 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        #p1 {
            color: #000;
            text-align: center;
            font-family: 'Cursive', cursive;
            font-size: 3rem;
            margin: 20px;
            background: rgba(255, 255, 255, 0.8);
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        #p1:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        #img1 {
            width: 90px;
            height: auto;
            vertical-align: middle;
        }

        .auth-form {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
            border: 1px solid #dc3545;
            max-width: 400px;
            width: 100%;
        }

        .auth-form:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .auth-form h2 {
            margin-bottom: 20px;
            color: #dc3545;
        }

        .form-label {
            margin-bottom: 10px;
            display: block;
            color: #000;
            font-family: 'Times New Roman', Times, serif
        }

        .form {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form:focus {
            border-color: #dc3545;
            outline: none;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5);
        }

        .btn {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn:hover {
            background: #c82333;
            transform: scale(1.05);
        }

        .error-message {
            color: #dc3545;
            text-align: center;
            margin-top: 10px;
        }

        footer {
            position: fixed;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            font-size: 0.8rem;
            font-family: serif;
            padding: 5px 10px;
            border-radius: 10px;
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>

<body>
    <div id="div1">
        <p id="p1">Un mot un geste <img src="{{ asset('images/NCE_logo2.png') }}" alt="" id="img1"> fait le reste</p>
    </div>

    <form action="{{ route('auth.authenticate') }}" method="POST" class="auth-form">
        @csrf
        <h2>Connexion</h2>
        <label for="password" class="form-label">Mot de passe:</label>
        <input type="password" id="password" name="password" class="form" required>
        <button type="submit" class="btn">Se connecter</button>
    </form>

    @if(session('error'))
    <p class="error-message">{{ session('error') }}</p>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

<footer class="d-none d-md-block">
    <p>© 2024 NCE DEV - New Consept Equipement <br> All rights Reserved</p>
</footer>

</html>
