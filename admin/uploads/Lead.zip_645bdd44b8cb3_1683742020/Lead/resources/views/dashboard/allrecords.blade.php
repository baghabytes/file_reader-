@extends('main')

@section('content')


<link rel="stylesheet" href="
    https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css
    "/>
<link rel="stylesheet" href="
    https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css
    "/>


  <div class="row " style="justify-content:center;">
        <div class="col-lg-12 ">
            <div class="card mb-30">
                <div class="card-body">
                    <div >
                    @if(Auth::check() && Auth::user()->Role == 'admin')
                            <a href="{{ route('create') }}" class="btn btn-primary float-right">Create Entry</a>
                        @endif
                        <h5 class="card-title">
                            All Entries                        </h5>
                    </div>
                    <br/>
                    
                    <div class="table-responsive" style="overflow-x:auto;">
                        <table  id="example" class="table table-hover text-vertical-middle mb-0">
                            <thead class="bort-none borpt-0">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Website</th>
                                <th scope="col">LinkedIn</th>
                                <th scope="col">Facebook</th>
                                <th scope="col">Other</th>
                                <th scope="col">Action</th>
            </tr>
        </thead>

                  <tbody>
            @foreach ($Entries as $entry)
            <tr>
                <td>{{ $entry->name }}</td>
                <td>{{ $entry->email }}</td>
                <td>{{ $entry->phone }}</td>
                <td>{{ $entry->website }}</td>
                <td>{{ $entry->linkedin }}</td>
                <td>{{ $entry->facebook }}</td>
                <td>{{ $entry->other }}</td>
                <td><a class=" btn btn-light" href="{{route('show', ['id' => $entry->id]);}}">View</a></td>
            </tr>
            @endforeach

            </tbody>
                            </table>
                        
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>

           
@endsection
