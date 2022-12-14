<?php

namespace App\Http\Controllers;

use App\Models\transactions;
use App\Models\transaction_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Veritrans;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        ////
        
        $total = $request->query('total');
        $name = $request->query('name');
        // // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-tbxZcKbGDBZvnJfKqFUvEA56';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $name,
                'last_name' => '',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($snapToken);
        return $snapToken;
    }

    public function index2(){
        $total = 0;
        $harga = 0;
        $getIdTrans = transactions::all()->where('customer_id',Auth::user()->id)->where('status', 'unpaid')->first();
        if($getIdTrans==null){
            ////
            // // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = 'SB-Mid-server-tbxZcKbGDBZvnJfKqFUvEA56';
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
            
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => 10000,
                ),
                'customer_details' => array(
                    'first_name' => 'budi',
                    'last_name' => 'pratama',
                    'email' => 'budi.pra@example.com',
                    'phone' => '08111222333',
                ),
            );
            
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            return view('users.cart', compact ('snapToken', 'total','harga'));
        }
        
        $cart = transaction_detail::all()->where('transactions_id',$getIdTrans->id);
        $cartnumb = transaction_detail::all()->where('transactions_id',$getIdTrans->id)->count();
        ////
        // // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-tbxZcKbGDBZvnJfKqFUvEA56';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );
        
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        
        return view('users.cart', compact ('cart','snapToken', 'total','harga'));

    }
    public function cartcount() {
        $getIdTrans = transactions::all()->where('customer_id',Auth::user()->id)->where('status', 'unpaid')->first();

        $cartnumb = transaction_detail::all()->where('transactions_id',$getIdTrans->id)->count();
        return $cartnumb;
    }
     public function updatetoken(Request $request) {
         $id = $request->query('id');
         $token = $request->query('token');
         transactions::where('customer_id', $id)
               ->first()
               ->update(['token' => $token]);
         return "success";
      }
    public function updatestatus(Request $request) {
        $id = $request->query('id');
        transactions::where('customer_id', $id)
              ->first()
              ->update(['status' => 'orderin']);
        return "success";
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $cart = transaction_detail::find($id);
        $cartId =$cart->transactions_id;
        $cart->delete();
        $datatransId = transaction_detail::all()->where('transactions_id',$cartId)->first();
        if($datatransId==null){
            $transTemp = transactions::find($cartId);
            $transTemp->delete();
        }
        return redirect()->route('cart.index2')->with('success', 'Data berhasil dihapus !');
    }

    public function addtocard(Request $request){
        $lastid = "";
        $idproduct = $request->query('products');
        $quantity = $request->query('qua');
        $userid = $request->query('userid');
        // dd()
        $datatransaction = transactions::all();
        foreach ($datatransaction as $a) {
            // dd('aaaa');
            if ($a['customer_id']==$userid && $a['status']=='unpaid'){
                transaction_detail::create([
                    'products_id' => $idproduct,
                    'transactions_id'=>$a['id'],
                    'quantity'=>$quantity,
                    'note'=>'testnote'
                ]);
                return redirect('/store');
            }
        }
        // dd('end foreach');
        $datatrans=transactions::create([
            'customer_id' => $userid,
            'rent_date'=>date('Y-m-d'),
            'return_date'=>date('Y-m-d'),
            'status'=>'unpaid',
            'token'=>'token'
        ]);

        // dd($datatrans->id);

        transaction_detail::create([
            'products_id' => $idproduct,
            'transactions_id'=>$datatrans->id,
            'quantity'=>$quantity,
            'note'=>'testnote'
        ]);
        // dd('each');
        return redirect('/cart');
    }
}

