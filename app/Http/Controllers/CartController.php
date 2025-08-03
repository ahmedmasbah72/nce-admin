<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Quote;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{

    public function addToCart(Request $request, $id)
    {
        $product = Person::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->nom,
                "quantity" => 1,
                "price" => $product->prix, // Initial price from the product
                "initial_price" => $product->prix,
                "photo" => $product->photo
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('people.index')->with('success', 'Produit ajouté au panier!');
    }




    public function showCart()
    {
        $cart = session()->get('cart', []);
    
        foreach ($cart as $id => $details) {
            $product = Person::find($id);
            if ($product) {
                $cart[$id]['initial_price'] = $product->prix;
                if (!isset($cart[$id]['price'])) {
                    $cart[$id]['price'] = $product->prix;
                }
            }
        }
    
        session()->put('cart', $cart);
    
        return view('cart.index', compact('cart'));
    }



    

    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity && $request->price) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            $cart[$request->id]["price"] = $request->price; // Mise à jour du nouveau prix
            $cart[$request->id]["discount"] = $request->discount ?? 0; // Mise à jour de la remise
            session()->put('cart', $cart);
            session()->flash('success', 'Panier mis à jour avec succès');
        }
        return redirect()->route('cart.index');
    }

    public function removeFromCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Produit retiré du panier avec succès');
        }
        return redirect()->route('cart.index');
    }

    


    public function generateQuote(Request $request)
    {
        $cart = session()->get('cart', []);
        
        // Vérifier les détails du panier
        foreach ($cart as $id => $details) {
            if (!isset($details['name']) || !isset($details['quantity']) || !isset($details['price'])) {
                return redirect()->route('cart.index')->withErrors(['message' => 'Certaines informations nécessaires manquent dans les articles du panier.']);
            }
        }
    
        // Générer le numéro de devis
        $lastQuote = Quote::orderBy('id', 'desc')->first();
        if ($lastQuote) {
            $lastNumber = (int) substr($lastQuote->quote_number, 7); // Ajusté pour commencer à l'index 7 pour "DVAPPLI"
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $quoteNumber = 'DVAPPLI' . $newNumber;
    
        $quote = new Quote();
        $quote->quote_number = $quoteNumber;
        $quote->save();
    
        // Récupérer les informations du client
        $clientName = $request->input('clientName');
        $clientNumber = $request->input('clientNumber');
    
        // Calculer les totaux avec réduction
        $totalHT = 0;
        $totalTVA = 0;
        $totalTTC = 0;
        $tvaRate = 20; // Taux de TVA en pourcentage
    
        foreach ($cart as $item) {
            $quantity = $item['quantity'];
            $price = $item['price'];
            $discount = $item['discount'] ?? 0;
            $discountedPrice = $price - ($price * $discount / 100);
            $lineTotalHT = $quantity * $discountedPrice;
            $lineTotalTVA = $lineTotalHT * $tvaRate / 100;
            $lineTotalTTC = $lineTotalHT + $lineTotalTVA;
    
            $totalHT += $lineTotalHT;
            $totalTVA += $lineTotalTVA;
            $totalTTC += $lineTotalTTC;
        }
    
        // Diviser les produits en groupes de 8
        $productsChunks = collect($cart)->chunk(7);
    
        // Passer les données à la vue
        $pdf = PDF::loadView('cart.quote', [
            'productsChunks' => $productsChunks,
            'quoteNumber' => $quoteNumber,
            'clientName' => $clientName,
            'clientNumber' => $clientNumber,         
            'totalHT' => $totalHT,
            'totalTVA' => $totalTVA,
            'totalTTC' => $totalTTC,
            'pageNumber' => 1 // Initialisation du numéro de page
        ]);
    
        // Réinitialiser le panier
        session()->forget('cart');
    
        return $pdf->download('devisNCE.pdf');
    }
    
    
}
