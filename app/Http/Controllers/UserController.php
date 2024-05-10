<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use GuzzleHttp\Handler\Proxy;

class UserController extends Controller
{
    

    public function callSession(Request $request){
        return redirect()->back()->with('status', 'Berhasil memanggil sesi');
    }

    public function getAdmin(User $user){
        $products = Product::where('user_id', $user->id)->get();
        return view('admin_page', ['products'=>$products, 'user' =>$user]);
    }

    public function editProduct(Request $request, User $user, Product $product){
        return view('edit_product', ['product'=>$product, 'user'=>$user]);
    }

    public function updateProduct(Request $request, User $user, Product $product){
        if(!$request->filled('image')){
            return redirect()->back()->with('error', 'Error. File image Produk Wajib Diisi');
        }elseif(!$request->filled('name')){
            return redirect()->back()->with('error', 'Error. File name Produk Wajib Diisi');
        }elseif(!$request->filled('weight')){
            return redirect()->back()->with('error', 'Error. File weight Wajib Diisi');
        }
        elseif(!$request->filled('price')){
            return redirect()->back()->with('error', 'Error. File Harga Wajib Diisi');
        }
        elseif(!$request->filled('stock')){
            return redirect()->back()->with('error', 'Error. File stock Wajib Diisi');
        }
        elseif(!$request->filled('condition') || !in_array($request->condition, ['Baru', 'Bekas'])){
            return redirect()->back()->with('error', 'Error. File condition Wajib Diisi');
        }
        elseif(!$request->filled('description')){
            return redirect()->back()->with('error', 'Error. File description Wajib Diisi');
        }
        
        if($product->user_id === $user->id){
            $product->image = $request->image;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->weight = $request->weight;
            $product->condition = $request->condition;
            $product->description = $request->description;
        }
        $product->save();
        return redirect()->route('admin_page', ['user'=>$user->id])->with('message', 'Berhasil update data');
    }

    public function deleteProduct(Request $request, User $user, Product $product){
        if($product->user_id === $user->id){
            $product->delete();
        }
        return redirect()->back()->with('status', 'Berhasil menghapus data produk');
    }

    public function getFormRequest(){
        return view('form_request');
    }

    public function handleRequest(Request $request, User $user){
        return view('handle_request', ['user'=>$user]);
    }

    public function postRequest(Request $request, User $user){
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|string',
            'weight' => 'required|integer',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'condition' => 'required|in:Baru,Bekas',
            'description' => 'required|max:2000',
        ],[
            'image.required' => 'Kolom image harus diisi.',
            'name.required' => 'Kolom name harus diisi.',
            'weight.required' => 'Kolom weight harus diisi.',
            'price.required' => 'Kolom price harus diisi.',
            'stock.required' => 'Kolom stock harus diisi.',
            'condition.required' => 'Kolom condition harus diisi.',
            'description.required' => 'Kolom description harus diisi.',
            'image.image' => 'The image must be an image.',
            'image.mimes' => 'The image must be a file of type: jpg, jpeg, png.',
            'image.max' => 'The image must not be greater than 2048 kilobytes.',
            'description.max' => 'The description must not be greater than 2000 characters.'
        ]);
    
        $imagePath = $request->file('image')->store('product_image', 'public');

        Product::create([
            'user_id' => $user->id,
            'image' => $imagePath,
            'name' => $request->name,
            'condition' => $request->condition,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'price' => $request->price,
            'description' => $request->description,
        ]);
    
        return redirect()->route('admin_page', ['user'=>$user->id]);
    }
    

    public function getProduct(){
        $data = Product::all();
        // $user = User::find(1);
        // $data = $user->products;
        return view('products')->with('products', $data);
    }

    public function getProfile(Request $request, User $user){
        $user = User::with('summarize')->find($user->id);
        return view('profile', ['user'=>$user]);
    }
    
}
