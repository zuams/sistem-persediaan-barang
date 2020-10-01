@extends('layouts.master')

@section('title')
    <title>pos - add</title>
@endsection

@section('content')
<h1 class="mt-4">Edit</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/product">Category</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
<div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Category</h3>

        </div>
        <div class="card-body">
            <form action="{{route('category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Category name</label>
                            <input type="text" name="name" value="{{$category->name}}" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <a href="{{url('/category')}}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success float-right">Update category</button>
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