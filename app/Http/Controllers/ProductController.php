<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use function Symfony\Component\String\s;

class ProductController extends Controller
{
    function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    function show($id)
    {

        $productKey = 'product_' . $id;

        // Kiểm tra Session của sản phẩm có tồn tại hay không.
        // Nếu không tồn tại, sẽ tự động tăng trường view_count lên 1 đồng thời tạo session lưu trữ key sản phẩm.
        if (!Session::has($productKey)) {
            Product::where('id', $id)->increment('view_count');
            Session::put($productKey, 1);
        }

        // Sử dụng Eloquent để lấy ra sản phẩm theo id
        $product = Product::find($id);

        // Trả về view
        return view('show', compact('product'));
    }

    function cart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart');
        if (!$cart) {
            $cart =
                [
                    $id =>
                        [
                            'name' => $product->name,
                            'quantity' => 1,
                            'description' => $product->description,
                            'price' => $product->price,
                            'total'=>$product->price
                        ]
                ];

            session()->put('cart', $cart);

        } else if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        } else {
            $cart[$id] =
                [
                    'name' => $product->name,
                    'quantity' => 1,
                    'description' => $product->description,
                    'price' => $product->price,
                    'total'=>$product->price
                ];

            session()->put('cart', $cart);
        }

        return redirect()->route('show-cart');

    }


    function destroyCart(Request $request): \Illuminate\Http\RedirectResponse
    {
        if (isset($request->key)) {
            $keys = $request->input('key');
            $cart = session()->get('cart');

            foreach ($keys as $key) {
                if (isset($cart[$key])) {
                    unset($cart[$key]);
                    session()->put('cart', $cart);
                }
            }
        }

        return redirect()->route('show-cart');
    }

    function updateCart(Request $request)
    {
        ;
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            $cart[$request->id]['total'] = $request->total;
            session()->put('cart', $cart);
        }

        return redirect()->route('show-cart');
    }

    function showCart()
    {
        return view('cart');
    }


}
