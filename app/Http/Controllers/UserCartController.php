<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Quote;
use Illuminate\Support\Facades\Log;

class UserCartController extends Controller
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
                "price" => $product->prix,
                "initial_price" => $product->prix,
                "photo" => $product->photo
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('user.view')->with('success', 'Produit ajouté au panier!');
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
        
        return view('user.usercart', compact('cart'));
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
        return redirect()->route('usercart.index');
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
        return redirect()->route('usercart.index');
    }

    public function generateQuote(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $id => $details) {
            if (!isset($details['name']) || !isset($details['quantity']) || !isset($details['price'])) {
                return redirect()->route('cart.index')->withErrors(['message' => 'Certaines informations nécessaires manquent dans les articles du panier.']);
            }
        }

        $lastQuote = Quote::orderBy('id', 'desc')->first();
        if ($lastQuote) {
            $lastNumber = (int) substr($lastQuote->quote_number, 7);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        $quoteNumber = 'DVAPPLI' . $newNumber;

        $quote = new Quote();
        $quote->quote_number = $quoteNumber;
        $quote->save();

        $clientName = $request->input('clientName');
        $clientNumber = $request->input('clientNumber');

        $totalHT = 0;
        $totalTVA = 0;
        $totalTTC = 0;
        $tvaRate = 20;

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

        $productsChunks = collect($cart)->chunk(7);

        $pdf = PDF::loadView('cart.quote', [
            'productsChunks' => $productsChunks,
            'quoteNumber' => $quoteNumber,
            'clientName' => $clientName,
            'clientNumber' => $clientNumber,
            'totalHT' => $totalHT,
            'totalTVA' => $totalTVA,
            'totalTTC' => $totalTTC,
            'pageNumber' => 1
        ]);

        session()->forget('cart');

        return $pdf->download('devisNCE.pdf');
    }
    
}
