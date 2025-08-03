<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/NCE_logo2.png" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Listes des produits NCE</title>
    <style>
        .svgIcon {
            width: 12px;
            transition-duration: 0.3s;
        }
        .svgIcon path {
            fill: white;
        }
        .button:hover {
            transition-duration: 0.3s;
            background-color: rgb(255, 69, 69);
            align-items: center;
            gap: 0;
        }
        .bin-top {
            transform-origin: bottom right;
        }
        .button:hover .bin-top {
            transition-duration: 0.5s;
            transform: rotate(160deg);
        }
        .navbar {
            background-color: #ffffff;
            padding: 0.5rem 1rem;
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
        #search {
            width: 50ch;
            max-width: 100%;
            border-radius: 20px;
        }
        .nav-link {
            margin-right: 20px;
        }
        #img2 {
            height: 60px;
        }

        .button-search {
            background-color: #FF0000;
            color: #ffffff;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            margin: 0px;  /* Ajouter une marge */
            padding: 1% 5%;  /* Ajouter un padding */
        }

        .button-search:hover {
            background-color: #B22222;
        }

        .button-search:active {
            background-color: #8B0000;
        }

        #head1 {
            color: #B22222;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            padding: 1%;
            margin-bottom: 2%;
        }
        #ADD-btn, #btn_edit, #btn_show, #btn_supp, #cart-btn {
            border-radius: 10px;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #ADD-btn { background-color: #FF0000; }
        #ADD-btn:hover { background-color: #B22222; }
        #ADD-btn:disabled, #btn_edit:disabled, #btn_show:disabled, #btn_supp:disabled, #cart-btn:disabled {
            background-color: #968fae;
            cursor: not-allowed;
        }
        #btn_edit { background-color: #4c68af; }
        #btn_edit:hover { background-color: #2653b4; }
        #btn_edit i { margin-right: 8px; }
        #btn_show { background-color: #4CAF50; }
        #btn_show:hover { background-color: #45a049; }
        #btn_supp { background-color: #FF0000; }
        #btn_supp:hover { background-color: #B22222; }
        #cart-btn { background-color: #ff9900; float: right; position: relative;  }
        #cart-btn:hover { background-color: #d58836; }
        footer {
            position: relative;
            text-align: center;
            font-size: 80%;
            font-family: serif;
            margin-top: 5%;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar .nav-link {
                
                margin-bottom: 10px;
                
            }
            
            
            #search {
                width: 100%;
            }
            #img2 {
                height: 50px;
            }
        }
        @media (max-width: 100%) {
            .navbar .navbar-brand img {
                height: 40px;
            }
            .navbar .form-control {
                width: 100%;
            }
            .navbar .button-search {
                font-size: 14px;
            }
            #head1 {
                font-size: 1.5rem;
            }
            .table thead th {
                font-size: 0.75rem;
            }
            .table td, .table th {
                padding: 0.5rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark navbar-toggler">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.view') }}">
                <img src="{{ asset('images/NCE_logo2.png') }}" alt="Description de l'image" id="img2">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active " aria-current="page"  href="{{route('welcome')}}">connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  collapse">Contact</a>
                    </li>
                </ul>
                <form class="d-flex flex-column flex-sm-row align-items-center">
                    <input class="form-control me-2 mb-2 mb-sm-0" type="search" name="search" placeholder="Vous recherchez ..." aria-label="Search" id="search" value="{{ request()->input('search') }}">
                    <button class="button-search" type="submit">
                        <i class="fas fa-search"></i> Rechercher
                    </button>
                </form>
                <a href="{{ route('admin.admincart') }}" class="btn btn-danger ms-3 mt-2 mt-sm-0" id="cart-btn">
                    <i class="fas fa-shopping-cart"></i> Mon Panier
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h2 id="head1">Listes des Produits :</h2>
        <a href="{{ route('people.create') }}" class="btn" id="ADD-btn">
            <i class="fas fa-plus"></i> Ajouter un produit
        </a>
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
        <table class="table mt-3">
            <thead>
                <tr class="table-danger">
                    <th scope="col">Reference</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Marque</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Consulter</th>
                    <th scope="col">Actions</th>
                    <th scope="col">Ajouter au panier</th>
                </tr>
            </thead>
            <tbody>
                @foreach($people as $person)
                    <tr class="table">
                        <td>{{ $person->reference }}</td>
                        <td>{{ $person->nom }}</td>
                        <td>{{ $person->marque }}</td>
                        <td>
                            @if($person->photo)
                                <img src="{{ asset('images/' . $person->photo) }}" alt="{{ $person->nom }}" style="max-width: 90px;">
                            @else
                                No photo
                            @endif
                        </td>
                        <td>
                            <a class="btn" id="btn_show" href="{{ route('people.show', $person->id) }}">
                                <i class="fas fa-eye"></i> Consulter
                            </a>
                        </td>
                        <td>
                            <form method="POST" action="/api/delete/{{$person->id}}">
                                <a href="{{ route('people.edit', $person->id) }}" class="btn" id="btn_edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                @csrf
                                @method('DELETE')
                                <button class="btn" id="btn_supp">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admincart.add', $person->id) }}" method="POST">
                                @csrf
                                <button class="btn" id="cart-btn" type="submit">
                                    <i class="fas fa-cart-plus"></i> Ajouter au panier
                                </button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYSk2m1p6rZ9e7d4KX1p4HgUgSK3AJzQNiw1i6dnX/A3/5d03E9Pb32LX" crossorigin="anonymous"></script>
</body>
<footer class="d-none d-md-block">
    <p>© 2024 NCE DEV - New Consept Equipement <br> All rights Reserved</p>
</footer>
</html>
