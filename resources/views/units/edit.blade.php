@extends('layouts.master')

@section('title')
    <title>pos - edit</title>
@endsection

@section('content')
<h1 class="mt-4">Edit</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/unit">Unit</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
<div class="row">
    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Units</h3>

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
            <form action="{{route('unit.update', $unit->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{$unit->name}}" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <a href="{{url('/unit')}}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success float-right">Update unit</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection