@extends('layouts.master')

@section('title')
    <title>pos - product</title>
@endsection

@section('content')
    <h1 class="mt-4"></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
        <li class="breadcrumb-item active">Product</li>
    </ol>
    @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                {!! $message !!}
            </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">History stock in & out 
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
                      <th style="width: 10%">
                          Name
                      </th>
                      <th style="width: 10%">
                          Email
                      </th>
                      <th style="width: 10%">
                          Status
                      </th>
                      <th style="width: 10%">
                          Stock out
                      </th>
                  </tr>
              </thead>
              <tbody>
                  @php
                    $i = 1;   
                  @endphp
                @forelse ($transactions as $key => $row)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$row->user->name}}</td>
                        <td>{{$row->user->email}}</td>
                        <td><span class="badge badge-light">{{$row->status}}</span></td>
                        <td>{{$row->total}}</td>
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