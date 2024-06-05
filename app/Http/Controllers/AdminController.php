<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\products;

use App\Models\order;

use Carbon\Carbon;
use App\Models\cart;

use App\Models\category;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function redirect()
    {
        $userType = Auth::User()->userType;
        if ($userType == '1') {
            $products = Products::all();
            $today = Carbon::today();
            $dailyRevenue = Products::whereDate('created_at', $today)->sum('price');
            return view('admin.home', compact('products', 'dailyRevenue'));
        } else {
            $count = 0;
            $total = 0;
            $data = Products::all(); // Assuming this is the correct model name
            $user = auth()->user();
            if (auth()->check()) {
                $count = Cart::where('phone', $user->phone)->count();
                $total = Cart::sum('price');
            }
            $categories = Category::all();

            // Calculate average ratings for products
            $averageRatings = $data->map(function ($product) {
                $averageRating = $product->ratings->avg('rating');
                return [
                    'product' => $product,
                    'averageRating' => $averageRating,
                ];
            });

            // Sort products by average rating in descending order
            $topRatedProducts = $averageRatings->sortByDesc('averageRating');

            return view('user.home', compact('data', 'count', 'total', 'categories', 'averageRatings', 'topRatedProducts'));
        }
    }
    function products()
    {
        $categories = Category::all(); // Assuming you have a "Category" model

        return view('admin.products', compact('categories'));
    }

    public function index()
    {
        // Retrieve the products from the database
        $products = Products::all();
        $categories = Category::all(); // Assuming you have a "Category" model

        // Return the view with the products data
        return view('admin.products_table', compact('products', 'categories'));
    }



    function uploadProducts(Request $request)
    {
        $data = new Products();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('productImage'), $imageName);
            $data->image = $imageName;
        }
        $data->title = $request->title;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->quantity = $request->quantity;
        $categories = Category::all();

        // Save the category ID
        $data->category = $request->input('category_id');

        $data->save();

        return view('admin.products', compact('categories'))
            ->with('messages', 'Product Added Successfully');
    }


    function vieworders()
    {
        $order = order::all();
        return view('admin.orders', compact('order'));
    }
    function updatestatus($id)
    {
        $order = order::find($id);

        $order->status = 'Delivered';
        $order->save();
        return redirect()->back()->with('messages', 'Product Added Successfully'); // Change 'message' to 'messages'
    }

    public function updateProduct(Request $request, Products $product)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id', // Adjust the validation rule based on your Category model
        ]);

        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->category_id = $request->input('category_id');

        $product->save();

        return redirect()->back()->with('messages', 'Product Updated Successfully');
    }

    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->back()->with('messages', 'Product Deleted Successfully');
    }
    public function edit($id)
    {
        // Find the product to edit
        $product = Products::findOrFail($id);
        $categories = Category::all();

        return view('admin.products-edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Find the product to update
        $product = Products::findOrFail($id);

        // Validate the request data
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Update the product details
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->category = $request->input('category_id');

        // Handle image update if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('productImage'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }
}
