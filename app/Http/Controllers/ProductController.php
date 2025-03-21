<?php

namespace App\Http\Controllers;

//import model product
use App\Models\Product; 

//import return type View
use Illuminate\View\View;

//import return type RedirectResponse
use Illuminate\Http\RedirectResponse;

//import request
use Illuminate\Http\Request;

//import facades
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all products
        $products = Product::latest()->paginate(10);

        //render view with products
        return view('products.index', compact('products'));
    }

    /**
     * create
     * 
     * @return View
     */
    public function create() : View
    {
        return view('products.create');
    }

    /**
     * store
     * 
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',  
            'stock' => 'required|numeric',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('products', $image->hashName());

        //create product
        Product::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     * 
     * @param  mixed $id
     * @return View
     */

     public function show(string$id) : View
     {
        //find product by ID
        $product = Product::findOrFail($id);

        //render view with product
        return view('products.show', compact('product'));
     }

     /**
      * edit
      * 
      * @param  mixed $id
      * @return View
      */
     public function edit(string $id) : View
     {
        //find product by ID
        $product = Product::findOrFail($id);
      
        //render view with product
        return view('products.edit', compact('product'));
     }

     /**
      * update
      * 
      * @param  mixed $request
      * @param  mixed $id
      * @return RedirectResponse
      */
     public function update(Request $request, string $id) : RedirectResponse
     {
        //validate form
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'price' => 'required|numeric',  
            'stock' => 'required|numeric',
        ]);

        //get product by ID
        $product = Product::findOrFail($id);

        //check if image is uploaded
        if($request->hasFile('image'))
        {
            //delete old image
            Storage::delete('products/'.$product->image);
            //upload new image
            $image = $request->file('image');
            $image->storeAs('products', $image->hashName());

            //update product with new image
            $product->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
            ]);
        }
        else
        {
            //update product without image
            $product->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
            ]);
        }

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diupdate!']);
     }

     /**
      * destroy
      * 
      * @param  mixed $id
      * @return RedirectResponse
      */
     public function destroy(string $id) : RedirectResponse
     {
        //find product by ID
        $product = Product::findOrFail($id);

        //delete image
        Storage::delete('products/'.$product->image);

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}