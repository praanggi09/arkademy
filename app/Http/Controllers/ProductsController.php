<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $products = Product::all();
    return view('products.index', ['products' => $products]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('products.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'nama_produk' => 'required',
      'keterangan' => 'required',
      'harga' => 'required',
      'jumlah' => 'required'
    ]);

    Product::create($request->all());

    return redirect('/products')->with('status', 'Data Produk Berhasil Ditambahkan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function show(Product $product)
  {
    return view('products.show', compact('product'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit(Product $product)
  {
    return view('products.edit', compact('product'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Product $product)
  {
    $request->validate([
      'nama_produk' => 'required',
      'keterangan' => 'required',
      'harga' => 'required',
      'jumlah' => 'required'
    ]);

    Product::where('id', $product->id)
      ->update([
        'nama_produk' => $request->nama_produk,
        'keterangan' => $request->keterangan,
        'harga' => $request->harga,
        'jumlah' => $request->jumlah,
      ]);

    return redirect('/products')->with('status', 'Data Produk Berhasil Diubah!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(Product $product)
  {
    Product::destroy($product->id);
    return redirect('/products')->with('status', 'Data Produk Berhasil Dihapus!');
  }
}
