@extends('layouts.master')

@section('content')
<script type="text/javascript">
    var URL = "<?=env("APP_URL")?>";
</script>
<style>
  .card-product:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden; }
  .card-product .price-new, .card-product .price {
    margin-right: 5px; }
  .card-product .price-old {
    color: #999; }
  .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center; }
    .card-product .img-wrap img {
      max-height: 100%;
      max-width: 100%;
      object-fit: cover; }
      
      .card-product .info-wrap {
    overflow: hidden;
    padding: 15px;
    border-top: 1px solid #eee; }
  .card-product .action-wrap {
    padding-top: 4px;
    margin-top: 4px; }
  .card-product .bottom-wrap {
    padding: 15px;
    border-top: 1px solid #eee; }
  .card-product .title {
    margin-top: 0; }
</style>
<br>
<div class="row">
  
<div class="col-md-9">
  @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                {!! $message !!}
            </div>
    @endif
    <div class="row">
      @foreach ($products as $key => $item)
      <div class="col-lg-3">
          <div class="card" style="margin-bottom: 20px; height: auto;">
              <img src="{{ $item->image_url != null ? '/uploads/product/'.$item->image_url : 'https://faculty.iiit.ac.in/~indranil.chakrabarty/images/empty.png'}}"
                   class="card-img-top mx-auto"
                   style="height: 150px; width: 150px;display: block;"
                   alt="{{ $item->image_path }}"
              >
              <div class="card-body" style="padding:0.75rem;">
                  <a href=""><h5 class="card-title">{{ $item->name }}</h5></a>
              <p>{{ $item->stock > 1 ? $item->stock . ' stock available' : $item->stock . ' out of stock'}}</p>
                  {{-- <form action="{{ route('cart.store') }}" method="POST"> --}}
                      {{ csrf_field() }}
                      {{-- <input type="hidden" data-id="{{ $item->id }}" id="id" name="id">
                      <input type="hidden" value="{{ $item->name }}" id="name" name="name">
                      <input type="hidden" value="1" id="stock" name="stock"> --}}
                      <div class="card-footer" style="background-color: white;">
                            <div class="row">
                              <button data-id="{{$item->id}}" data-stock="1" data-name="{{$item->name}}" id="add_to_cart" class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart" {{$item->stock < 1 ? 'disabled' : ''}}>
                                  <i class="fa fa-shopping-cart"></i> Take
                              </button>
                          </div>
                      </div>
                  {{-- </form> --}}
              </div>
          </div>
      </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
    {!! $products->links('vendor.pagination.bootstrap-4') !!}
</div>
</div>
<div class="col-md-3">
  <div class="card">
  <div class="card-body">
    <h4 class="card-title">Filter</h4>
    <!-- This is some text within a card body. -->
    <article class="filter-group">
                     <header class="card-header"> <a style="color: black;" href="#" data-toggle="collapse" data-target="#collapse_aside1" data-abc="true" aria-expanded="false" class="collapsed"> 
                             <h6 class="title"><i class="icon-control fa fa-chevron-down"></i> Categories </h6>
                         </a> </header>
                     <div class="filter-content collapse" id="collapse_aside1" style="">
                         <div class="card-body">
                             <ul class="list-menu">
                                @foreach($categories as $category)
                                 <li><a href="#" data-abc="true">{{$category->name}} </a></li>
                                @endforeach
                             </ul>
                         </div>
                     </div>
                 </article>
                 <article class="filter-group">
                     <header class="card-header"> <a style="color: black;" href="#" data-toggle="collapse" data-target="#collapse_aside2" data-abc="true" aria-expanded="false" class="collapsed">
                             <h6 class="title"> <i class="icon-control fa fa-chevron-down"></i> Price </h6>
                         </a> </header>
                     <div class="filter-content collapse" id="collapse_aside2" style="">
                         <div class="card-body"> <input type="range" class="custom-range" min="0" max="100" name="">
                             <div class="form-row">
                                 <div class="form-group col-md-6"> <label>Min</label> <input class="form-control" placeholder="$0" type="number"> </div>
                                 <div class="form-group text-right col-md-6"> <label>Max</label> <input class="form-control" placeholder="$1,0000" type="number"> </div>
                             </div> <a href="#" class="highlight-button btn btn-medium button xs-margin-bottom-five" data-abc="true">Apply Now</a>
                         </div>
                     </div>
                 </article>
                 <article class="filter-group">
                     <header class="card-header"> <a style="color: black;" href="#" data-toggle="collapse" data-target="#collapse_aside3" data-abc="true" aria-expanded="false" class="collapsed">
                             <h6 class="title"> <i class="icon-control fa fa-chevron-down"></i> Size </h6>
                         </a> </header>
                     <div class="filter-content collapse" id="collapse_aside3" style="">
                         <div class="card-body"> <label class="checkbox-btn"> <input type="checkbox"> <span class="btn btn-light"> XS </span> </label> <label class="checkbox-btn"> <input type="checkbox"> <span class="btn btn-light"> SM </span> </label> <label class="checkbox-btn"> <input type="checkbox"> <span class="btn btn-light"> LG </span> </label> <label class="checkbox-btn"> <input type="checkbox"> <span class="btn btn-light"> XXL </span> </label> <label class="checkbox-btn"> <input type="checkbox"> <span class="btn btn-light"> XXXL </span> </label> </div>
                     </div>
                 </article>
                 <article class="filter-group">
                     <header class="card-header"> <a style="color: black;" href="#" data-toggle="collapse" data-target="#collapse_aside4" data-abc="true" class="collapsed" aria-expanded="false">
                             <h6 class="title"> <i class="icon-control fa fa-chevron-down"></i> Rating </h6>
                         </a> </header>
                     <div class="filter-content collapse" id="collapse_aside4" style="">
                         <div class="card-body"> <label class="custom-control"> <input type="checkbox" checked="" class="custom-control-input">
                                 <div class="custom-control-label">Better </div>
                             </label> <label class="custom-control"> <input type="checkbox" checked="" class="custom-control-input">
                                 <div class="custom-control-label">Best </div>
                             </label> <label class="custom-control"> <input type="checkbox" checked="" class="custom-control-input">
                                 <div class="custom-control-label">Good</div>
                             </label> <label class="custom-control"> <input type="checkbox" checked="" class="custom-control-input">
                                 <div class="custom-control-label">Not good</div>
                             </label> </div>
                     </div>
                 </article>
  </div>
</div>
</div>
</div>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $(".alert").delay(4000).slideUp(200, function() {
                $(this).alert('close');
            });
        });

        function load_cart_data()
            {
                $.ajax({
                url:URL+"/cart-html",
                method:"GET",
                success:function(data)
                {
                    $('#navbar-cart').html(data);
                }
            });
        }

        $(document).on('click', '#add_to_cart', function(){
             var id = $(this).attr('data-id');
             var name = $(this).attr('data-name');
             var stock = $(this).attr('data-stock');
             console.log(id);
             
             $.ajax({
                 url:URL+"/add",
                 method:"POST",
                 data:{id:id, name:name, stock:stock},
                 cache: false,
                //  contentType: false,
                //  processData: false,
                 dataType: 'json',
                 beforeSend: function() {
                     // 
                 },
                 success:function(data) {
                    if (data.status == "success") {
                        load_cart_data()
                        // alert("Item has been Added into Cart");
                    }
                 }
         });
   });
    </script>
@endsection