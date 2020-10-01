@extends('layouts.master')

@section('content')
<script type="text/javascript">
    var URL = "<?=env("APP_URL")?>";
</script>
    <div class="container" style="margin-top: 50px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
        @if(session()->has('success_msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('alert_msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endif
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endforeach
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <br>
                @if(\Cart::getTotalQuantity()>0)
                    <h4>{{ \Cart::getTotalQuantity()}} Product(s) In Your Cart</h4><br>
                @else
                    <h4>No Product(s) In Your Cart</h4><br>
                    <a href="/transaction" class="btn btn-dark">Continue Shopping</a>
                @endif

                <input type="hidden" value="{{$totalQuantity}}" name="total" id="total">
                @foreach($cartCollection as $item)
                    <input type="hidden" value="{{$item->id}}" name="ids[]" id="ids[]">
                    <input type="hidden" value="{{$item->name}}" name="names[]" id="names[]">
                    <input type="hidden" value="{{$item->quantity}}" name="stocks[]" id="stocks[]">
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="{{ $item->attributes->image_url != null ? '/uploads/product/'.$item->attributes->image_url : 'https://faculty.iiit.ac.in/~indranil.chakrabarty/images/empty.png'}}" class="img-thumbnail" width="200" height="200">
                        </div>
                        <div class="col-lg-5">
                            <p>
                                <b><a href="/shop/{{ $item->attributes->stock }}">{{ $item->name }}</a></b><br>
                                {{ $item->attributes->stock }} <b>stock available</b><br>
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <form action="{{ route('cart.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                        <input type="number" class="form-control form-control-sm" value="{{ $item->quantity }}"
                                               id="quantity" name="quantity" style="width: 70px; margin-right: 10px;">
                                        <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>
                                    </div>
                                </form>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $item->id }}" id="id" name="id">
                                    <button class="btn btn-dark btn-sm" style="margin-right: 10px;"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if(count($cartCollection)>0)
                    <form action="{{ route('cart.clear') }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-secondary btn-md">Clear Cart</button>
                    </form>
                @endif
            </div>
            @if(count($cartCollection)>0)
                <div class="col-lg-5">
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Total Qty: </b>{{ \Cart::getTotalQuantity() }}</li>
                        </ul>
                    </div>
                    <br><a href="/transaction" class="btn btn-dark">Continue Shopping</a>
                    <a id="send" href="#" class="btn btn-dark">Checkout</a>
                </div>
            @endif
        </div>
        <br><br>
    </div>
@endsection

@section('script')
    <script>
   
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
           $(document).on('click', "#send", function() {
               ids = $("input[name='ids[]']").map(function(){return $(this).val();}).get();
               names = $("input[name='names[]']").map(function(){return $(this).val();}).get();
               stocks = $("input[name='stocks[]']").map(function(){return $(this).val();}).get();
               total = $("input[name='total']").val();
               
               $.ajax({
                   url: URL+"/transaction",
                   method: "POST",
                   data: {ids: ids, names:names,stocks:stocks,total:total},
                   dataType: 'json',
                   success: function(data) {
                       if (data.status > 0) {
                           location.href = '/transaction'
                       }
                       console.log(data);
                   }
               })
           })
    </script>
@endsection