@extends('layouts.master')

@section('title')
    <title>pos - product</title>
@endsection

@section('content')
<script type="text/javascript">
    var URL = "<?=env("APP_URL")?>";
</script>
    <h1 class="mt-4"></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="home">Dashboard</a></li>
        <li class="breadcrumb-item active">Submission</li>
    </ol>
    @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                {!! $message !!}
            </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Submission 
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
                      <th style="width: 10%">

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
                        <td><span class="badge {{ $row->status == 'Processing' ? 'badge-success' : ($row->status == "Completed" ? 'badge-info' : 'badge-light') }}">{{$row->status}}</span></td>
                        <td>{{$row->total}}</td>
                        <td class="project-actions text-right">
                            <button id="reject" data-id="{{$row->id}}" class="btn btn-danger btn-sm" {{$row->status != "Processing" ? 'disabled' : ''}}>
                                Cancel 
                            </button>
                            <button id="accept" data-id="{{$row->id}}" class="btn btn-success btn-sm" {{$row->status != "Processing" ? 'disabled' : ''}}>
                                Accept 
                            </button>
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
        
        $(document).on('click', "#reject", function() {
            var id = $(this).attr('data-id');

            $.ajax({
                 url:URL+"/transaction/"+id,
                 method:"PUT",
                 data:{status:"Canceled"},
                 cache: false,
                 dataType: 'json',
                 beforeSend: function() {
                     // 
                 },
                 success:function(data) {
                     if (data.status == "success") {
                         location.href = '/pengajuan'
                     }
                 }
            });
            
        });
        $(document).on('click', "#accept", function() {
            var id = $(this).attr('data-id');

            $.ajax({
                 url:URL+"/transaction/"+id,
                 method:"PUT",
                 data:{status:"Completed"},
                 cache: false,
                 dataType: 'json',
                 beforeSend: function() {
                     // 
                 },
                 success:function(data) {
                     if (data.status == "success") {
                         location.href = '/pengajuan'
                     }
                 }
            });
            
        });
    </script>
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endsection