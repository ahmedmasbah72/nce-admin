<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/NCE_logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Panier</title>
    <style>
        .navbar {
            background-color: #ffffff;
            font-size: 120%;
            margin: 1% 5% -1% 5%;
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
            margin: 0 60px;
        }
        #img2 {
            height: 80px;
        }
        #h2 {
            color: #B22222;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            padding: 1%;
            margin-bottom: 2%;
        }
        .table img {
            max-width: 90px;
        }
        .table .form-control {
            width: auto;
            display: inline-block;
        }
        .item-total {
            min-width: 100px;
            display: inline-block;
        }
        .text-right h4 {
            margin-top: 20px;
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
                <img src="{{ asset('images/NCE_logo2.png') }}" alt="Logo" id="img2">
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
    <div class="container mt-3">
        <h2 id="h2">Votre Panier :</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr class="table-danger">
                    <th>Produit</th>
                    <th>Photo</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Remise (%)</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $details)
                <tr>
                    <td>{{ $details['name'] ?? 'N/A' }}</td>
                    <td><img src="{{ asset('images/' . ($details['photo'] ?? '')) }}" alt="{{ $details['name'] ?? 'Product Image' }}"></td>
                    <td>
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control quantity" min="1">
                    </td>
                    <td>
                            <input type="number" name="price" value="{{ $details['price'] ?? $details['initial_price'] }}" class="form-control price" step="0.01">
                    </td>
                    <td>
                            <input type="number" name="discount" value="{{ $details['discount'] ?? 0 }}" class="form-control discount" step="0.01" min="0" max="100">
                    </td>
                    <td class="item-total">
                        {{ isset($details['quantity']) && isset($details['price']) ? ($details['quantity'] * ($details['price'] - ($details['price'] * ($details['discount'] ?? 0) / 100))) : 'N/A' }}
                    </td>
                    <td>
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        </form>
                        <form action="{{ route('cart.remove') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="btn btn-danger">Retirer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <h4>Total: <span id="total-amount">0</span> DH</h4>
        </div>
        <div class="container mt-3">
            <form action="{{ route('cart.generateQuote') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="clientName" class="form-label">Nom du Client</label>
                    <input type="text" class="form-control" id="clientName" name="clientName" required>
                </div>
                <div class="mb-3">
                    <label for="clientNumber" class="form-label">Numéro du Client</label>
                    <input type="text" class="form-control" id="clientNumber" name="clientNumber" required>
                </div>
                <button type="submit" class="btn btn-success">Générer le devis</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-mAxD1f89xf2+U8sa2BQq2lkaxJnx8DLyo1tlbvD9r/nuGppHe2o4BRjOe2D1/8bP" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInputs = document.querySelectorAll('.quantity');
            const priceInputs = document.querySelectorAll('.price');
            const discountInputs = document.querySelectorAll('.discount');
            const totalAmountEl = document.getElementById('total-amount');

            function updateTotal() {
                let total = 0;
                document.querySelectorAll('tbody tr').forEach(function (row) {
                    const quantity = parseFloat(row.querySelector('.quantity').value);
                    const price = parseFloat(row.querySelector('.price').value);
                    const discount = parseFloat(row.querySelector('.discount').value) || 0;
                    const discountedPrice = price - (price * discount / 100);
                    const itemTotal = quantity * discountedPrice;
                    row.querySelector('.item-total').textContent = itemTotal.toFixed(2);
                    total += itemTotal;
                });
                totalAmountEl.textContent = total.toFixed(2);
            }

            quantityInputs.forEach(function (input) {
                input.addEventListener('input', updateTotal);
            });

            priceInputs.forEach(function (input) {
                input.addEventListener('input', updateTotal);
            });

            discountInputs.forEach(function (input) {
                input.addEventListener('input', updateTotal);
            });

            updateTotal(); // Initial total calculation
        });
    </script>
</body>
<footer>
    <p>© 2024 NCE DEV - New Consept Equipement <br> All rights Reserved</p>
</footer>
</html>
