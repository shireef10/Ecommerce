<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\products;
use App\Models\carts;
use App\Models\order;
use App\Models\category;
use App\Models\ProductRating;
use Carbon\Carbon;


use Illuminate\Support\Facades\Mail;





class HomeController extends Controller
{
    public function redirect()
    {
        $userType = Auth::user()->userType;

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

    public function index()
    {
        $data = Products::all(); // Assuming this is the correct model name
        $count = 0;
        $categories = Category::all();
        $total = 0;

        if (auth()->check()) {
            $user = auth()->user();
            $count = Cart::where('phone', $user->phone)->count(); // Assuming "Cart" is the correct model name
            $total = Cart::sum('price');
        }

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

        return view('user.home', compact('data', 'count', 'total', 'categories', 'topRatedProducts', 'averageRatings'));
    }



    public function searchProducts(Request $request)
    {
        $total = 0;
        $count = 0;
        $searchTerm = $request->input('search');
        $category = $request->input('category');
        $priceRange = $request->input('price_range');
        $user = auth()->user();

        $query = Products::query();

        if (!empty($searchTerm)) {
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }

        if (!empty($category)) {
            $query->where('category', $category);
        }

        if (!empty($priceRange)) {
            [$minPrice, $maxPrice] = explode('-', $priceRange);
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        $searchResults = $query->get();
        // Now, let's load the rest of the data

        $data = Products::all(); // Load your products data here
        if (auth()->check()) {

            $total = Cart::sum('price');
            $count = Cart::where('phone', $user->phone)->count();
        }
        $averageRatings = $data->map(function ($product) {
            $averageRating = $product->ratings->avg('rating');
            return [
                'product' => $product,
                'averageRating' => $averageRating,
            ];
        });

        // Sort products by average rating in descending order
        $topRatedProducts = $averageRatings->sortByDesc('averageRating');

        $categories = Category::all();

        // Continue with your existing code to load averageRatings, topRatedProducts, etc.

        return view('user.home', compact('data', 'categories', 'count', 'total', 'averageRatings', 'topRatedProducts', 'searchResults'));
    }



    public function product_detail($id)
    {
        $total = 0;
        $count = 0;
        $product = Products::with('ratings')->find($id); // Replace 'Product' with your actual model name
        $user = auth()->user();
        if (auth()->check()) {
            $count = cart::all();
            $total = cart::sum('price');
        }
        $categories = Category::all();

        // Calculate the average rating
        $averageRating = $product->ratings->avg('rating');

        return view('user.product_detail', compact('product', 'categories', 'count', 'total', 'averageRating'));
    }


    public function add_to_cart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = auth()->user();
            $product = products::find($id);

            $quantity = $request->input('quantity');

            for ($i = 0; $i < $quantity; $i++) {
                $cart = new cart;
                $cart->name = $user->name;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->product_title = $product->title;
                $cart->price = $product->price;
                $cart->save();
            }

            return redirect()->back()->with('message', 'Product added to the cart successfully');
        } else {
            return redirect('login');
        }
    }


    public function addcart(Request $request, $id)
    {
        if (Auth::id()) {
            $user = auth()->user();
            $cart = new cart;
            $product = products::find($id);
            $cart->name = $user->name;
            $cart->phone = $user->phone;
            $cart->address = $user->address;

            $cart->product_title = $product->title;
            $cart->price = $product->price;
            $cart->quantity = $product->quantity;
            $cart->save();



            return redirect()->back()->with('message', 'product added successfully');
        } else {
            return redirect('login');
        }
    }

    public function showcart()
    {
        $total = 0;
        $count = 0;
        $user = auth()->user();
        $cart = cart::where('phone', $user->phone)->get();
        if (auth()->check()) {

            $count = cart::where('phone', $user->phone)->count();
            $total = cart::sum('price');
        }
        $categories = Category::all();
        return view('user.showcart', compact('categories', 'cart', 'count', 'total'));
    }
    public function deletecart($id)
    {
        $data = cart::find($id);

        if ($data) {
            $data->delete();
            return redirect()->back()->with('message', 'Product deleted successfully');
        } else {
            return redirect()->back()->with('message', 'Product not found or already deleted');
        }
    }


    public function orders(Request $request)
    {
        $user = auth()->user();
        $name = $user->name;
        $phone = $user->phone;
        $address = $user->address;

        foreach ($request->input('productname') as $key => $productname) {
            $order = new Order;
            $order->product_title = $productname;
            $order->price = $request->input('price')[$key];
            $order->name = $name;
            $order->phone = $phone;
            $order->address = $address;
            $order->status = 'Not Delivered';
            $order->save();
        }
        cart::where('phone', $phone)->delete();

        // Mail::to($user->email)->send(new OrderConfirmation());

        return redirect()->back();
    }
    public function ElectronicsMobiles()
    {
        $total = 0;
        $count = 0;
        $products = Products::where('category', '1')->get();
        if (auth()->check()) {
            $user = auth()->user();
            $count = cart::where('phone', $user->phone)->count();
            $total = cart::sum('price');
        }
        $categories = category::all();

        return view('user.Electronics&Mobiles', compact('products', 'count', 'total', 'categories'));
    }

    public function HealthBeauty()
    {
        $total = 0;
        $count = 0;
        $products = Products::where('category', '2')->get();
        if (auth()->check()) {
            $user = auth()->user();
            $count = cart::where('phone', $user->phone)->count();
            $total = cart::sum('price');
        }
        $categories = category::all();

        return view('user.Health&Beauty', compact('products', 'count', 'total', 'categories'));
    }

    public function CarAccessories()
    {
        $total = 0;
        $count = 0;
        $products = Products::where('category', '3')->get();
        if (auth()->check()) {
            $user = auth()->user();
            $count = cart::where('phone', $user->phone)->count();
            $total = cart::sum('price');
        }
        $categories = category::all();

        return view('user.CarAccessories', compact('products', 'count', 'total', 'categories'));
    }

    public function SportsFitness()
    {
        $total = 0;
        $count = 0;
        $products = Products::where('category', '4')->get();
        if (auth()->check()) {
            $user = auth()->user();
            $count = cart::where('phone', $user->phone)->count();
            $total = cart::sum('price');
        }
        $categories = category::all();

        return view('user.Sports&Fitness', compact('products', 'count', 'total', 'categories'));
    }
    public function showCategories()
    {
        $categories = category::all();
        return view('user.categories', compact('categories'));
    }

    public function submitRating(Request $request, $id)
    {
        // Validate the user's input
        $request->validate([
            'rating' => 'required|integer|between:1,5', // Assuming ratings are from 1 to 5.
        ]);

        // Find the product by ID
        $product = Products::find($id);

        if (!$product) {
            // Handle the case where the product is not found (you can return an error response or redirect back).
        }

        // Add the user's rating to the product
        $product->ratings()->create([
            'user_id' => auth()->user()->id, // Assuming you have user authentication.
            'rating' => $request->input('rating'),
        ]);


        // Optionally, you can calculate and update the product's average rating here.

        return redirect()->back()->with('success', 'Rating submitted successfully');
    }
}
