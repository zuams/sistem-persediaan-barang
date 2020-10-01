@if(count(\Cart::getContent()) > 0)
    <div style="overflow-y: scroll;height:250px;">
    @foreach(\Cart::getContent() as $item)
        <li class="list-group-item">
            <div class="row">
                <div class="col-lg-3">
                    <img src="{{ $item->attributes->image_url != null ? '/uploads/product/'.$item->attributes->image_url : 'https://faculty.iiit.ac.in/~indranil.chakrabarty/images/empty.png'}}"
                         style="width: 50px; height: 50px;"
                    >
                </div>
                <div class="col-lg-6">
                    <b>{{$item->name}}</b>
                    <br><small>Qty: {{$item->quantity}}</small>
                </div>
                <hr>
            </div>
        </li>
    @endforeach
    </div>
    <br>
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-10">
                <b>Total Qty: </b>{{ \Cart::getTotalQuantity() }}
            </div>
            <div class="col-lg-2">
                <form action="{{ route('cart.clear') }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>
    </li>
    <br>
    <div class="row" style="margin: 0px;">
        <a class="btn btn-dark btn-sm btn-block" href="{{ route('cart.index') }}">
            CART <i class="fa fa-arrow-right"></i>
        </a>
        <!-- <a class="btn btn-dark btn-sm btn-block" href="">
            CHECKOUT <i class="fa fa-arrow-right"></i>
        </a> -->
    </div>
@else
    <li class="list-group-item">Your Cart is Empty</li>
@endif