<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderCheckoutService
{
    /**
     * Process checkout and create an order
     *
     * @param int $userId
     * @param array $cartIds
     * @param array $checkoutDetails
     * @return Order|null
     */
    public function processCheckout(int $userId, array $cartIds, array $checkoutDetails): ?Order
    {
        $cartItems = Cart::with('product')
            ->where('user_id', $userId)
            ->whereIn('id', $cartIds)
            ->get();

        if ($cartItems->isEmpty()) {
            return null;
        }

        return DB::transaction(function () use ($userId, $cartItems, $cartIds, $checkoutDetails) {
            // Kalkulasi harga
            $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
            $ongkir = (int) ($checkoutDetails['pengiriman'] ?? 15000);
            $proteksi = ($checkoutDetails['proteksi'] ?? 0) == 1 ? 45000 : 0;
            $biayaLayanan = 1000;
            $diskonVoucher = ($checkoutDetails['voucher'] ?? '') === 'DISKON50' ? 50000 : 0;

            $total = $subtotal + $ongkir + $proteksi + $biayaLayanan - $diskonVoucher;

            // Buat order
            $order = Order::create([
                'user_id' => $userId,
                'total'   => $total,
                'status'  => 'diproses',
            ]);

            // Tambahkan order items
            $orderItems = $cartItems->map(function ($item) {
                return [
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ];
            });

            $order->items()->createMany($orderItems->toArray());

            // Bersihkan keranjang
            Cart::whereIn('id', $cartIds)->delete();

            return $order;
        });
    }
}
