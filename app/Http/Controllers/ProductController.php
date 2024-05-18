<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'delete', 'update', 'create', 'edit']);
    }

    /**
     * Display a listing of the resource
     */
    public function index()
    {
        $products = Product::latest()->simplePaginate(3);
        return view('products.index', compact('products'))
               ->with('i', (request()->input('page', 1)-1)*3);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name'=>'required',
            'details'=>'required',
            'image'=>'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048'
        ]);
        $input=$request->all();
        if ($image=$request->file('image')) {
            $destinationpath = 'images/';
            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationpath, $profileImage);
            $input['image']=$profileImage;
        }
        Product::create($input);
        return redirect()->route('products.index')
                ->with('success', 'products added successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'details'=>'required'
        ]);
        $input=$request->all();
        if ($image=$request->file('image')) {
            $destinationpath = 'images/';
            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationpath, $profileImage);
            $input['image']=$profileImage;
        }
        else {
            unset($input['image']);
        }
        $product->update($input);
        return redirect()->route('products.index')
                ->with('success', 'products updated successfuly');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
        ->with('success', 'products deleted successfuly');
    }
}
