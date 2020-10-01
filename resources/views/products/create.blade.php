@extends('layouts.master')

@section('title')
    <title>pos - add</title>
@endsection

@section('content')
<h1 class="mt-4">Create</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/product">Product</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
<div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Product</h3>

        </div>
        <div class="card-body">
            @if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
    @endif
            <form action="{{url('/product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="units">Unit</label>
                            <select name="unit" class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                @foreach ($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>                    
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="categories">Categories</label>
                            <select name="category" class="form-control custom-select">
                                <option selected disabled>Select one</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo">photo</label>
                    <input type="file" class="form-control-file" name="photo" id="photo">
                </div>
                <div class="form-group">
                    <label for="description">Product Description</label>
                    <textarea name="description" class="form-control" required rows="4"></textarea>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <a href="{{url('/product')}}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success float-right">Create new product</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  {{-- <div class="row">
    <div class="col-12">
      <a href="#" class="btn btn-secondary">Cancel</a>
      <input type="submit" value="Create new Porject" class="btn btn-success float-right">
    </div>
  </div> --}}
@endsection