<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['nom' , 'photo' , 'reference' , 'largeur' , 'profondeur' , 'hauteur' ,    'puissance' , 'feux' , 'tension' , 'plaque' , 'volume' , 'broche' , 'porte' , 'temperature' , 'bac' , 'niveau' , 'num_pizza' , 'dim_plaque' , 'num_cylindre' , 'dim_rouleaux' , 'model' , 'capacite_l', 'capacité_kg' , 'production' , 'lame' , 'soud' , 'marque','prix','serie','initial_price','new_price',];
}
