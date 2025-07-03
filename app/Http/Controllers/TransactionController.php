<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            session(['redirect_url' => $request->fullUrl()]);
            return redirect()->route('login');
        }

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        if ($product->stock < $quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Stok tidak mencukupi.']);
        }

        $totalAmount = $product->price * $quantity;

        return view('checkout.index', compact('product', 'quantity', 'totalAmount'));
    }

    public function processCheckout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $totalAmount = $product->price * $quantity;

        if ($product->stock < $quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Stok tidak mencukupi.']);
        }

        DB::beginTransaction();
        try {
            // Create transaction
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'total_amount' => $totalAmount,
                'status' => 'Menunggu Pembayaran',
            ]);

            // Create transaction item
            TransactionItem::create([
                'transaction_id' => $transaction->transaction_id,
                'product_id' => $product->product_id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);

            // Update product stock
            $product->decrement('stock', $quantity);

            // Store order details in session
            session([
                'last_order_details' => [
                    'product_name' => $product->name,
                    'product_image' => $product->image,
                    'quantity' => $quantity,
                    'total_amount' => $totalAmount,
                ]
            ]);

            DB::commit();

            return redirect()->route('checkout.success', $transaction->transaction_id);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memproses pesanan.']);
        }
    }

    public function success($id)
    {
        $transaction = Transaction::where('transaction_id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $orderDetails = session('last_order_details');
        session()->forget('last_order_details');

        return view('checkout.success', compact('transaction', 'orderDetails'));
    }
}