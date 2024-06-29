<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use App\Models\Cart;

class StripeController extends Controller
{
    /**
     * Show the payment form.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = auth()->user();
        $total = Cart::where('phone', $user->phone)->sum('price');

        // Pass the total to the view
        return view('stripe.payment', compact('total'));
    }

    /**
     * Handle payment processing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function payment(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create a charge on Stripe's servers - this will charge the card
            $charge = Stripe\Charge::create([
                "amount" => $request->amount * 100, // Amount in cents
                "currency" => "usd", // Adjust currency as needed
                "source" => $request->stripeToken,
                "description" => "Payment from " . $request->email,
            ]);

            // Example of saving order details to your database
            // $order = new Order();
            // $order->amount = $request->amount;
            // $order->currency = 'usd'; // Adjust currency as needed
            // $order->email = $request->email;
            // $order->save();

            // Redirect back with success message
            return back()->with('success_message', 'Payment successful!');
        } catch (\Exception $e) {
            // Handle Stripe API exceptions and errors
            return back()->with('error_message', 'Payment failed: ' . $e->getMessage());
        }
    }
}
