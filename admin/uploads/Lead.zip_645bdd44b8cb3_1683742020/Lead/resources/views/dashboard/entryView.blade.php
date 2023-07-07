@extends('main')

@section('content')


<link rel="stylesheet" href="
    https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css
    "/>
<link rel="stylesheet" href="
    https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css
    "/>


  <div class="row " style="justify-content:center;">
        <div class="col-md-12">
            <div class="card mb-30" >
                <div class="card-body">
                    <div >
                  
                        <h5 class="card-title">
                            {{$entry->name}}                        </h5>
                    </div>
                    <hr/>
                    <div class="row">
                    
                    <div class="col-md-4">
                    <b>Email :</b> {{$entry->email}}
                   </div>

                   <div class="col-md-4">
                    <b>Phone :</b> {{$entry->phone}}
                   </div>

                   <div class="col-md-4">
                    <b>Website :</b> {{$entry->website}}
                   </div>

                    </div>

                    <br/>
                    <div class="row">
                    
                    <div class="col-md-4">
                    <b>Facebook :</b> {{$entry->facebook}}
                   </div>

                   <div class="col-md-4">
                    <b>Linkedin :</b> {{$entry->linkedin}}
                   </div>

                   <div class="col-md-4">
                    <b>Instagram :</b> {{$entry->instagram}}
                   </div>

                    </div>

                    <br/>


                    <div class="row">
                    
                    <div class="col-md-4">
                    <b>Category :</b> {{$entry->category}}
                   </div>

                   <div class="col-md-4">
                    <b>Whatsapp :</b> {{$entry->whatsapp}}
                   </div>

                   <div class="col-md-4">
                    <b>Address :</b> {{$entry->address}}
                   </div>

                    </div>

                    <br/>

<div class="row">
<div class="col-md-4">
                    <b>Description :</b> {{$entry->description}}
                   </div>


                   <div class="col-md-4">
                    <b>Other :</b> {{$entry->other}}
                   </div>

</div>

<br/>
<div class="row" style="padding:30px;">
@if(Auth::check() && Auth::user()->Role == 'admin')
<b>Activity</b>
<hr/>
<br/>

<div class="table-responsive" style="overflow-x:auto;">
<table id="example" class="table table-hover text-vertical-middle mb-0">
<thead>
    <tr>
    <th>Username</th>
    <th>Time</th>
    </tr>
</thead>
<tbody>
@foreach ($logs as $log)
    <tr>
    <td>{{$log->name}}</td>
    <td>{{$log->created_at}}</td>
    </tr>
    @endforeach
</tbody>
</table>

</div>
@endif



</div>
    

                        
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>

           
@endsection
