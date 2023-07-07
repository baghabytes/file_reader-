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
        <div class="col-lg-12 ">
            <div class="card mb-30 shadow">
                <div class="card-body">
                    <div >
                        <h5 class="card-title">
                            <b>Enter New Record</b></h5>
                    </div>
                    <br/>


<form id="create-form" action="{{ route('entries.store') }}" method="POST">
  @csrf

  <div class="row">
  
  <div class="form-group col-md-4">
    <label for="name">Name:</label>
    <input type="text" class="form-control" name="name" id="name" required>
  </div>
  <div class="form-group  col-md-4">
    <label for="email">Email:</label>
    <input type="email" class="form-control" name="email" id="email" required>
  </div>
  <div class="form-group  col-md-4">
    <label for="website">Website:</label>
    <input type="text" class="form-control" name="website" id="website">
  </div>
  
</div>


<div class="row">

<div class="form-group col-md-4">
    <label for="phone">Phone:</label>
    <input type="text" class="form-control" name="phone" id="phone">
  </div>

  <div class="form-group col-md-4">
    <label for="phone">address:</label>
    <input type="text" class="form-control" name="address" id="address">
  </div>

  <div class="form-group col-md-4">
    <label for="phone">category:</label>
    <input type="text" class="form-control" name="category" id="category">
  </div>

</div>
 


<div class="row">

<div class="form-group col-md-4">
    <label for="phone">facebook:</label>
    <input type="text" class="form-control" name="facebook" id="facebook">
  </div>

  <div class="form-group col-md-4">
    <label for="phone">instagram:</label>
    <input type="text" class="form-control" name="instagram" id="instagram">
  </div>

  <div class="form-group col-md-4">
    <label for="phone">linkedin:</label>
    <input type="text" class="form-control" name="linkedin" id="linkedin">
  </div>


</div>
  
<div class="row">
<div class="form-group col-md-4">
    <label for="phone">Whatsapp:</label>
    <input type="text" class="form-control" name="whatsapp" id="whatsapp">
  </div>

  <div class="form-group col-md-4">
    <label for="phone">Other:</label>
    <input type="text" class="form-control" name="other" id="other">
  </div>

  <div class="form-group col-md-4">
    <label for="phone">Description:</label>
    <textarea type="text" class="form-control" name="description" id="description"></textarea>
  </div>
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
  $('#create-form').on('submit', function(e) {
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