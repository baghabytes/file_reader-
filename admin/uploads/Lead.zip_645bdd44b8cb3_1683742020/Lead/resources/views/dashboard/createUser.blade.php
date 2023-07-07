@extends('main')

@section('content')

<style>
  label{
    text-transform:capitalize !important;
    font-weight:bold;
  }
  </style>


<link rel="stylesheet" href="
    https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css
    "/>
<link rel="stylesheet" href="
    https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css
    "/>

<div class="row " style="justify-content:center;">
        <div class="col-lg-8 ">
            <div class="card mb-30 shadow">
                <div class="card-body">
                    <div >
                        <h5 class="card-title">
                            <b>Enter New User</b></h5>
                    </div>
                    <br/>


<form id="create-form2" action="{{ route('entries.createuser') }}" method="POST">
  @csrf

  <div class="row">
  
  <div class="form-group col-md-6">
    <label for="">Name:</label>
    <input type="text" class="form-control" name="name" id="name" required>
  </div>
  <div class="form-group  col-md-6">
    <label for="">Email:</label>
    <input type="email" class="form-control" name="email" id="email" required>
  </div>
</div>
<div class="row">
  
  <div class="form-group col-md-6">
    <label for="">Password:</label>
    <input type="password" class="form-control" name="password" id="password" required>
  </div>
  <div class="form-group  col-md-6">
    <label for="">Role:</label>
    <select id="role_id" class="form-control" name="role_id" required>
            <option>Choose a role</option>
            <option value="admin">Admin</option>
            <option value="viewer">Viewer</option>
            <option value="writer">Writer</option>
            
        </select>  </div>
</div>



  <!-- Add more fields as needed -->
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
                    </div>
                    </div>
                    </div>
                    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // Submit the form via Ajax
  $('#create-form2').on('submit', function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      success: function(response) {
        console.log(response);
        alert(response.message);
      },
      error: function(xhr, status, error) {
        console.error(error);
        alert(error);
      }
    });
  });
</script>
           
@endsection