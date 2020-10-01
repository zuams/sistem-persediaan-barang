@extends('layouts.master')

@section('title')
    <title>pos - product</title>
@endsection

@section('content')
    <h1 class="mt-4"></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
        <li class="breadcrumb-item active">Categories</li>
    </ol>
    @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                {!! $message !!}
            </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Categories 
            <a class="btn btn-primary btn-sm float-sm-right" href="{{route('category.create')}}">
                    <i class="fas fa-plus">
                    </i>
                    Create
                </a>
            </h3>
        </div>
        <br>
        <div class="card-body p-0">
          <table class="table table-striped projects" id="sampleTable">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th>
                          Name
                      </th>
                      <th>
                          Code
                      </th>
                      <th>
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @php
                    $i = 1;   
                  @endphp
                @forelse ($categories as $row)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->code}}</td>
                        <td class="project-actions text-right">
                            <form action="{{ route('category.destroy', $row->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                    <a class="btn btn-info btn-sm" href="{{url('category/'.$row->id.'/edit')}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah anda yakin menghapus data ini ?');">
                                    <i class="fa fa-trash"></i> 
                                    Delete 
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".alert").delay(4000).slideUp(200, function() {
                $(this).alert('close');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endsection