<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            font-size: 12px;
        }

        #img1 {
            width: 100%;
            height: auto;
            background-size: 100%;
            margin-top: -5%;
            position: fixed;
        }

        #head1 {
            text-align: center;
            margin-top: 19%;
        }

        .divider-line {
            border-top: 2px solid red; /* Ligne rouge de 2 pixels d'épaisseur */
            position: fixed;
            bottom: 17mm; /* Position à 20mm du bas de la page */
            left: 5%; /* Décalage à gauche de 5% */
            width: 90%; /* Largeur à 90% de la largeur de la page */
        }

        footer {
            position: fixed;
            bottom: -4%; /* Position fixe à 10mm du bas de la page */
            width: 100%;
            text-align: center;
            font-size: 12px;
        }

        #tab1 {
            float: left;
            text-align: center;
            width: 48%;
            max-height: 3cm;
            font-size: 9px;
        }

        #tab2 {
            float: right;
            margin-left: -6%;
            width: 48%;
            max-height: 2cm;
            font-size: 9px;
        }

        #tab3 {
            margin: 20% auto 0 auto;
            border-collapse: collapse;
            text-align: center;
            padding: 10px;
            width: 100%;
            max-width: 100%;
            font-size: 10px;
            box-sizing: border-box;
            margin-top: 12% ;
        }

        @media (min-width: 768px) {
            #tab3 {
                font-size: 12px;
            }
        }

        @media (min-width: 1024px) {
            #tab3 {
                font-size: 14px;
            }
        }

        #tab3 th, #tab3 td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        #tab3 th {
            background-color: #f4f4f4;
        }

        #table-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            width: 128%;
            box-sizing: border-box;
            margin-left: -12%;
        }

        .page-break {
            page-break-before: always;
        }

        .total-summary {
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <?php
        $path = public_path('images/BARRENCE.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>

    @foreach ($productsChunks as $chunk)
    <div class="page-container">
        <div>
            <img src="{{ $base64 }}" alt="Image" id="img1"> 
        </div>
        
        <div id="div-head">
            <h1 id="head1">Devis</h1>
        </div>
        
        <div class="container mt-3">
            <div class="row" style="justify-content: space-between; display: flex; flex-wrap: wrap;" id="table-container">
                <div>
                    <table class="table table-bordered" id="tab1">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Date</th>
                                <th>Page</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $quoteNumber }}</td>
                                <td> le {{ \Carbon\Carbon::now()->setTimezone('Africa/Casablanca')->format('d/m/Y') }}  à {{ \Carbon\Carbon::now()->setTimezone('Africa/Casablanca')->format('H:i') }}</td>
                                <td>{{ $loop->iteration }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table class="table table-bordered" id="tab2">
                        <tbody>
                            <tr>
                                <td>Nom du Client:</td>
                                <td>{{ $clientName }}</td>
                            </tr>
                            <tr>
                                <td>Numéro du Client:</td>
                                <td>{{ $clientNumber }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <main class="container" id="tab3">
            <div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Remise (%)</th>
                            <th>Total HT</th>
                            <th>Total TTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $chunkTotalHT = 0;
                            $chunkTotalTVA = 0;
                            $chunkTotalTTC = 0;
                            $tvaRate = 20;
                        ?>
                        @foreach($chunk as $details)
                        <?php
                            $discount = $details['discount'] ?? 0;
                            $discountedPrice = $details['price'] - ($details['price'] * $discount / 100);
                            $lineTotalHT = $details['quantity'] * $discountedPrice;
                            $lineTotalTVA = $lineTotalHT * $tvaRate / 100;
                            $lineTotalTTC = $lineTotalHT + $lineTotalTVA;
                            
                            $chunkTotalHT += $lineTotalHT;
                            $chunkTotalTVA += $lineTotalTVA;
                            $chunkTotalTTC += $lineTotalTTC;
                        ?>
                        <tr>
                            <td><img src="{{ $details['photo'] }}" alt="Photo du produit" style="max-width: 50px;"></td>
                            <td>{{ $details['name'] }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>{{ number_format($details['price'], 2, ',', ' ') }} MAD</td>
                            <td>{{ $discount }}</td>
                            <td>{{ number_format($lineTotalHT, 2, ',', ' ') }} MAD</td>
                            <td>{{ number_format($lineTotalTTC, 2, ',', ' ') }} MAD</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
        @if ($loop->last)
        <div class="container total-summary">
            <table class="table">
                <tr>
                    <th>Total HT</th>
                    <td>{{ number_format($totalHT, 2, ',', ' ') }} MAD</td>
                </tr>
                <tr>
                    <th>Total TVA (20%)</th>
                    <td>{{ number_format($totalTVA, 2, ',', ' ') }} MAD</td>
                </tr>
                <tr>
                    <th>Total TTC</th>
                    <td>{{ number_format($totalTTC, 2, ',', ' ') }} MAD</td>
                </tr>
            </table>
            

        </div>
        @endif
        <div class="divider-line"></div>
        <footer>
            <p>Adresse : 123 Rue Exemple, Casablanca, Maroc</p>
            <p>Téléphone : +212 123 456 789 | Email : exemple@example.com</p>
            <p>Site web : www.example.com</p>
        </footer>
    </div>
    @if (!$loop->last)
    <div class="page-break"></div>
    @endif
    @endforeach
</body>
</html>
