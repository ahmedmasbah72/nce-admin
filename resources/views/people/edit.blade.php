<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="images/NCE_logo.png" type="image/x-icon">
    <title>Modifier un produit</title>
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin-bottom: 10% ;
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

        .container {
            margin-top: 50px;
            max-width: 800px;
            background-color: #ffffff;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            margin-bottom: 1.5rem;
            color: #343a40;
            font-size: 1.75rem;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .alert-danger {
            margin-bottom: 1.5rem;
        }

        #photo {
           
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        footer{
            position: absolute;
            left: 50%;
            transform: translate(-50%, -0%);
            display: flex;
            text-align: center ;
            font-size: 80% ;
            font-family: serif ;
            margin-top: 5%;

        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('people.index') }}">
                <img src="{{ asset('images/NCE_logo2.png') }}" alt="Description de l'image" id="img2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('people.index') }}">Page d'accueil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h2>Modifier un produit</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('people.update', $person->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="reference" class="form-label">Référence</label>
                <input type="text" class="form-control" id="reference" name="reference" value="{{ $person->reference }}" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $person->nom }}" required>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" id="photo">
                @if($person->photo)
                    <img src="{{ asset('images/' . $person->photo) }}" alt="{{ $person->nom }}">
                @else
                    <p class="text-muted">No photo</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="marque" class="form-label">Marque</label>
                <input type="text" class="form-control" id="marque" name="marque" value="{{ $person->marque }}">
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">prix</label>
                <input type="text" class="form-control" id="prix" name="prix" value="{{ $person->prix }}">
            </div>
            <div class="mb-3">
                <label for="serie" class="form-label">serie</label>
                <input type="text" class="form-control" id="serie" name="serie" value="{{ $person->serie }}">
            </div>
            <div class="mb-3">
                <label for="largeur" class="form-label">Largeur</label>
                <input type="text" class="form-control" id="largeur" name="largeur" value="{{ $person->largeur }}">
            </div>
            <div class="mb-3">
                <label for="profondeur" class="form-label">Profondeur</label>
                <input type="text" class="form-control" id="profondeur" name="profondeur" value="{{ $person->profondeur }}">
            </div>
            <div class="mb-3">
                <label for="hauteur" class="form-label">Hauteur</label>
                <input type="text" class="form-control" id="hauteur" name="hauteur" value="{{ $person->hauteur }}">
            </div>
            <div class="mb-3">
                <label for="puissance" class="form-label">Puissance</label>
                <input type="text" class="form-control" id="puissance" name="puissance" value="{{ $person->puissance }}">
            </div>
            <div class="mb-3">
                <label for="feux" class="form-label">Feux</label>
                <input type="text" class="form-control" id="feux" name="feux" value="{{ $person->feux }}">
            </div>
            <div class="mb-3">
                <label for="tension" class="form-label">Tension</label>
                <input type="text" class="form-control" id="tension" name="tension" value="{{ $person->tension }}">
            </div>
            <div class="mb-3">
                <label for="plaque" class="form-label">Plaque</label>
                <input type="text" class="form-control" id="plaque" name="plaque" value="{{ $person->plaque }}">
            </div>
            <div class="mb-3">
                <label for="volume" class="form-label">Volume</label>
                <input type="text" class="form-control" id="volume" name="volume" value="{{ $person->volume }}">
            </div>
            <div class="mb-3">
                <label for="broche" class="form-label">Broche</label>
                <input type="text" class="form-control" id="broche" name="broche" value="{{ $person->broche }}">
            </div>
            <div class="mb-3">
                <label for="porte" class="form-label">Porte</label>
                <input type="text" class="form-control" id="porte" name="porte" value="{{ $person->porte }}">
            </div>
            <div class="mb-3">
                <label for="temperature" class="form-label">Température</label>
                <input type="text" class="form-control" id="temperature" name="temperature" value="{{ $person->temperature }}">
            </div>
            <div class="mb-3">
                <label for="bac" class="form-label">Bac</label>
                <input type="text" class="form-control" id="bac" name="bac" value="{{ $person->bac }}">
            </div>
            <div class="mb-3">
                <label for="niveau" class="form-label">Niveau</label>
                <input type="text" class="form-control" id="niveau" name="niveau" value="{{ $person->niveau }}">
            </div>
            <div class="mb-3">
                <label for="num_pizza" class="form-label">Numéro de pizza</label>
                <input type="text" class="form-control" id="num_pizza" name="num_pizza" value="{{ $person->num_pizza }}">
            </div>
            <div class="mb-3">
                <label for="dim_plaque" class="form-label">Dimensions de la plaque</label>
                <input type="text" class="form-control" id="dim_plaque" name="dim_plaque" value="{{ $person->dim_plaque }}">
            </div>
            <div class="mb-3">
                <label for="num_cylindre" class="form-label">Numéro du cylindre</label>
                <input type="text" class="form-control" id="num_cylindre" name="num_cylindre" value="{{ $person->num_cylindre }}">
            </div>
            <div class="mb-3">
                <label for="dim_rouleaux" class="form-label">Dimensions des rouleaux</label>
                <input type="text" class="form-control" id="dim_rouleaux" name="dim_rouleaux" value="{{ $person->dim_rouleaux }}">
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Modèle</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ $person->model }}">
            </div>
            <div class="mb-3">
                <label for="capacite_l" class="form-label">Capacité (litres)</label>
                <input type="text" class="form-control" id="capacite_l" name="capacite_l" value="{{ $person->capacite_l }}">
            </div>
            <div class="mb-3">
                <label for="capacité_kg" class="form-label">Capacité (kg)</label>
                <input type="text" class="form-control" id="capacité_kg" name="capacité_kg" value="{{ $person->capacité_kg }}">
            </div>
            <div class="mb-3">
                <label for="production" class="form-label">Production</label>
                <input type="text" class="form-control" id="production" name="production" value="{{ $person->production }}">
            </div>
            <div class="mb-3">
                <label for="lame" class="form-label">Lame</label>
                <input type="text" class="form-control" id="lame" name="lame" value="{{ $person->lame }}">
            </div>
            <div class="mb-3">
                <label for="soud" class="form-label">Soudure</label>
                <input type="text" class="form-control" id="soud" name="soud" value="{{ $person->soud }}">
            </div>
            <button type="submit" class="btn btn-primary" >Enregistrer les modifications</button>
        </form>
    </div>
</body>
<footer>
    <p>© 2024 NCE DEV - New Consept Equipement <br> All rights Reserved</p>
</footer>
</html>
