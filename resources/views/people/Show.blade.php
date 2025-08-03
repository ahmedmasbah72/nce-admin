<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="images/NCE_logo.png" type="image/x-icon">
    <title>Produit consulté</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #ffffff;
            font-size: 120%;
            padding: -3%;
            margin: 1%;
            margin-left: 5%;
            margin-right: 5%;
            margin-bottom: -1%;
        }
        .navbar .nav-link, .navbar .navbar-brand, .navbar .form-control {
            color: #B22222 !important;
        }
        .navbar .nav-link:hover, .navbar .navbar-brand:hover {
            color: #FF0000 !important;
        }
        .navbar .form-control:focus {
            border-color: #ffcccc;
            box-shadow: 0 0 0 0.2rem rgba(255, 204, 204, 0.25);
        }
        .nav-link {
            margin-right: 60px;
            margin-left: 60px;
        }
        #img2 {
            height: 80px;
        }

        .profile-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .profile-container img {
            border-radius: 50%;
            width: 250px;
            height: 250px;
            margin-bottom: 20px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-name {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .profile-section {
            font-size: 18px;
            color: #777;
            margin-bottom: 20px;
        }

        .profile-contact p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            text-align: left;
        }

        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #333;
            color: white;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .button:hover {
            width: 140px;
            border-radius: 25px;
            background-color: #5c5c5c;
        }

        .button:hover .svgIcon {
            transform: translateY(-200%);
        }

        .svgIcon {
            width: 12px;
            transition: all 0.3s ease;
        }

        .svgIcon path {
            fill: white;
        }

        .button::before {
            position: absolute;
            bottom: -20px;
            content: "Retour";
            color: white;
            font-size: 0px;
            transition: all 0.3s ease;
        }

        .button:hover::before {
            font-size: 14px;
            opacity: 1;
            bottom: 12px;
        }
        
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="{{ asset('images/NCE_logo2.png') }}" alt="Description de l'image" id="img2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
    </div>
</nav>

<div class="profile-container">
    <a href="javascript:history.back()">
        <button class="button">
            <svg class="svgIcon" viewBox="0 0 384 512">
                <path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"></path>
            </svg>
        </button>
    </a>
    
    <img src="{{ asset('images/' . $user->photo) }}" alt="Profile Image">
    <div class="profile-name">{{ $user->nom }}</div>
    <div class="profile-section">{{ $user->reference }}</div>
    <div class="profile-contact">
        <p>Nom: {{ $user->nom }}</p>
        <p>Marque: {{ $user->marque }}</p>
    </div>
    
    <table class="table">
        <tbody>
            @foreach(['largeur', 'profondeur', 'hauteur', 'puissance', 'feux', 'tension', 'plaque', 'volume', 'broche', 'porte', 'temperature', 'bac', 'niveau', 'num_pizza', 'dim_plaque', 'num_cylindre', 'dim_rouleaux', 'model', 'capacite_l', 'capacité_kg', 'production', 'lame', 'soud', 'marque','prix','serie'] as $attribute)
                @if(!is_null($user->$attribute) && $user->$attribute != 0)
                    <tr>
                        <td><strong>{{ ucfirst(str_replace('_', ' ', $attribute)) }}:</strong></td>
                        <td>{{ $user->$attribute }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
