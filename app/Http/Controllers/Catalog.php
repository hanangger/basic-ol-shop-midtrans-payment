<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use Session;

use App\Veritrans\Veritrans;

class Catalog extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){   
        Veritrans::$serverKey = 'VT-server-1GJmRjYjnQOkcBR86C39GdHM';
        Veritrans::$isProduction = false;

    }

    public function index(Request $request)
    {
        if($request->input('brand') != null || $request->input('price') != null){
            $filter = ['brand'=>$request->input('brand'), 'price'=>explode("-", $request->input('price'))];
            if($request->input('brand') != null && $request->input('price') == null ){
                $items = Items::select('*')
                            ->where(['brand'=>$request->input('brand')])
                            ->get();
            }else if($request->input('brand') == null && $request->input('price') != null){
              $items = Items::select('*')
                            ->where('price', '>', $filter['price'][0]*1000)
                            ->where('price', '<', $filter['price'][1]*1000)
                            ->get();
            }else{

            }

        }else{
           $items = Items::all();
        }
        
       
        return view('commerce/list', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'stock'=> $request->input('stock'),
            'specification'=> $request->input('specification'),
            'image' => $request->file('image')
            ];
            
            if($request->hasFile('image')){
                $extension = $data['image']->extension();
                $image_name = md5(rand()).".".$extension;
                echo $image_name;
                $data['image']->storeAs('uploads', $image_name, 'public');
            }

            $Items = new Items;

            $Items->name = $data['name'];
            $Items->price = $data['price'];
            $Items->stock = $data['stock'];
            $Items->specification = $data['specification'];
            $Items->image = $image_name;

            if($Items->save()){
                //return Redirect::to(public_path().'/catalog/list');
                // redirect -> list
            }
    }

    public function listCart(Request $request){
        $carts = $request->session()->get('cart');
        $cartList = [];
        foreach($carts as $key=>$cart){
            $items = Items::select('name', 'price')
                ->where('id', $cart[0])
                ->get()->toArray();
                $cartList[] = [$cart[0], $items[0]['name'], $items[0]['price'], $cart[3]];
        }
        $request->session()->set('cart', $cartList);
        return view('commerce/cartList', compact('cartList'));
        
    }

    public function addCart(Request $request){
        $request->session()->push('cart', [$request->input('id'), $request->input('name'), $request->input('price'), $request->input('quantity')]);
        $cart = $request->session()->get('cart');
        echo $request->input('name')." Added to your Cart!";
    }

    public function customerDetail(Request $request){
        return view('commerce/customer');
    }

    public function checkoutvtweb(Request $request){
        $vt = new Veritrans;
        $item_details = [];
        $total = 0;
        $carts = $request->session()->get('cart');
        $customer = $request->session()->get('customer');
        foreach($carts as $key=>$cart){
            $item_details[]= [
                    'id'=>$cart[0],
                    'name'=>$cart[1],
                    'price'=>$cart[2],
                    'quantity'=>$cart[3] ?: 1,
                ];
                $total += $cart[2] * $cart[3]; //summing price
        }
        //echo "<pre>",print_r($item_details);die();

        $transaction_details = array(
          'order_id' => rand(),
          'gross_amount' => $total,
          );

        $billing_address = array(
            'first_name'    => $customer['first_name'],
            'last_name'     => $customer['last_name'],
            'address'       => $customer['address'],
            'city'          => $customer['city'],
            'postal_code'   => $customer['postal_code'],
            'phone'         => $customer['phone'],
            'country_code'  => 'IDN'
            );

        // Optional
        $shipping_address = array(
            'first_name'    => $customer['first_name'],
            'last_name'     => $customer['last_name'],
            'address'       => $customer['address'],
            'city'          => $customer['city'],
            'postal_code'   => $customer['postal_code'],
            'phone'         => $customer['phone'],
            'country_code'  => 'IDN'
            );

        // Optional
        $customer_details = array(
            'first_name'    => $customer['first_name'],
            'last_name'     => $customer['last_name'],
            'email'         => $customer['email'],
            'phone'         => $customer['phone'],
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
            );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            'payment_type' => 'vtweb',
            );

        try {
          // Redirect to Veritrans VTWeb page
           $vtweb_url = $vt->vtweb_charge($transaction_data);
           return redirect($vtweb_url);
        }
        catch (Exception $e) {
          return $e->getMessage();
        }
    }

    public function confirm(Request $request){
        $customer = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postal_code')

        ];
        $request->session()->set('customer', $customer);
        $data = [
            'customer' => $customer,
            'cartList' => $request->session()->get('cart')
        ];
        return view('commerce/confirmPayment', compact('data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
