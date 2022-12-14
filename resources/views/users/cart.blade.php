@extends('master.index_user')
@section('title', 'Cart')

@section('content')
        
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Cart</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        
                        @if(isset($cart))
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">No</th>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                    
                                @foreach ($cart as $c)
                                <?php
                                $harga = $c->product->price * $c->quantity;
                                $total += $harga;
                                ?>
                                    @csrf
                                    <tr>
                                      <td>
                                        {{ $loop->iteration }}
                                      </td>
                                        <td class="product-thumbnail">
                                            <img src="{{ asset('storage/' . $c->product->image) }}" alt="Image"
                                                class="img-fluid">
                                            {{-- dd($c->product->image) --}}
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $c->product->product_name }}</h2>
                                        </td>
                                        <td>Rp{{ $c->product->price }}</td>
                                        <td> {{ $c->quantity }} </td>
                                        <td> Rp{{ $harga }} </td>
                              
                                        <td>
                                            <a href="/cart/{{ $c->id }}" class="btn btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this item ?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd"
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg>
                                            </a>
                                        </td>

                                    
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @endif
                        @if(!isset($cart))
                        choose tools to checkout
                        @endif
                        
                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-primary btn-md btn-block">Update Cart</button>
                        </div>
                        {{-- <div class="col-md-6">
                            <button class="btn btn-outline-primary btn-md btn-block">Continue Shopping</button>
                        </div> --}}
                    </div>
                 
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                {{-- <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">Rp{{ $c->product->price }}</strong>
                                </div> 
                            </div> --}}
                            
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Jumlah hari</span>
                                </div>
                                <div class="col-md-6 text-right">
                                <input type="hidden" value="{{ $total }}" id="datatotal">
                                    <input type="hidden" value="{{ Auth::user()->name}}" id="namepay">
                                    <input type="hidden" value="{{ Auth::user()->id}}" id="idpay">
                                    <div class="input-group mb-3" style="max-width: 220px;">
                                        <div class="input-group-prepend">
                                            <button id="kuranghari" class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                                        </div>
                                        <input id="jumlah" type="text" class="form-control text-center" value="1" placeholder=""
                                            aria-label="Example text with button addon" aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button id="tambahhari" class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Sub total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">Rp. {{ $total }}</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Ongkir</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black">Rp. 15.000</strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black" id="totalbayar">Rp. {{ $total+15000 }}</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="cekout" class="btn btn-primary btn-lg btn-block">Proceed To
                                        Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            var token = "";
            let fitotal;
            $("#tambahhari").click(function(){
                var jumlahhari = $("#jumlah").val();
                
                var total = $("#datatotal").val();
                console.log(jumlahhari);
                 fitotal = jumlahhari*total+parseInt(total)+15000;
                $('#totalbayar').html("Rp. "+fitotal);
            });
            $("#kuranghari").click(function(){
                var jumlahhari = $("#jumlah").val();
                
                var total = $("#datatotal").val();
                console.log(jumlahhari);
                 fitotal = jumlahhari*total+parseInt(total)+15000;
                $('#totalbayar').html("Rp. "+fitotal);
            });
            $("#cekout").click(function(){
                var total = fitotal;
                var name = $("#namepay").val();
                var id = $("#idpay").val();
                $.ajax({url: "http://127.0.0.1:8000/cartpay?total="+total+"&name="+name, success: function(result){
                  token = result;
                    $.ajax({url: "http://127.0.0.1:8000/updatetoken?token="+token+"&id="+id, success: function(resulttoken){
                    console.log(resulttoken);
                    }});
                  window.snap.pay(result, {
                    onSuccess: function(result){
                        /* You may add your own implementation here */
                        alert("payment success!"); console.log(result);
                        $.ajax({url: "http://127.0.0.1:8000/updatestatus?id="+id, success: function(resultstatus){
                        console.log(resultstatus);
                        }});
                    },
                    onPending: function(result){
                        /* You may add your own implementation here */
                        alert("wating your payment!"); console.log(result);
                    },
                    onError: function(result){
                        /* You may add your own implementation here */
                        alert("payment failed!"); console.log(result);
                    },
                    onClose: function(){
                        /* You may add your own implementation here */
                        alert('you closed the popup without finishing the payment');
                    }
                    })
                }});
                console.log(token);
            });
        });
    </script>
    <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            alert("payment success!"); console.log(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            alert("wating your payment!"); console.log(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            alert("payment failed!"); console.log(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
        // customer will be redirected after completing payment pop-up
      });
  </script> 
@endsection
