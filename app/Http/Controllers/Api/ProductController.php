<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
  public function index()
  {
    $products =  Product::all();

    return response()->json($products);
  }


  public function create(Request $request)
  {
    //prende i dati dalla chiamata API
    $data =  $request->all();

    //salvataggio dei dati nel DB
    $validatedData =  $request->validate([
      'name'=> 'required',
      'description'=> 'required',
      'serial_number'=> 'required'
    ]);

    $newProduct = new Product;
    $newProduct->fill($validatedData);
    $newProduct->save();

    //ritorna la rappresentazione del nuovo oggetto
    return response()->json($newProduct);
  }


  public function show($id)
  {
    //prende l'id e recupere l'istanza con quell'id
    $product =  Product::find($id);

    //se c'è ritorna la rappresentazione di esso
    if (empty($product))
    {
      return response()->json([
        'error' => 'Hai inserito un ID inesistente'
      ]);
    }
    return response()->json($product);
  }

  public function update(Request $request, $id)
  //quando salviamo in database Request c'è sempre altrimenti non possiamo prendere i dati
  {
    $data = $request->all();

    dd($data);

    //prende i dati di update e l'id del prodotto da aggiornare
    //controllare che il prodotto esista. Se esiste fa update altrimenti ritorna errore
  }

}
