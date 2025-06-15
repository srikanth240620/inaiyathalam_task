<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{url('/css/dataTables.dataTables.css')}}" />

   <style>

  

    .navbar-light {
     background-color: #f1f1f1 !important;
    border-bottom: 1px solid #e9e9e9;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
}

 .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }
    
   </style>
</head>
<body class="bg-light">

 

     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-light">
      

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          
           
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="navbar-nav">
            <a href="{{url('/home')}}" class="btn btn-outline-primary mr-2">Profile</a>
            <button id="logoutBtn" class="btn btn-outline-danger">Logout</button>
        </div>
    </div>


        </div>
    </nav>


<div class="container">

<div id="update-success" class="alert alert-success d-none mt-3"></div>
    <div id="update-error" class="alert alert-danger d-none mt-3"></div>


    <div class="mt-4">
        <button type="button" class="btn btn-primary" onclick="create()">
  Create User
</button>
    </div>
    <div class="">

        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                
            </tbody>
            
        </table>
    </div>
    </div>

{{-- Edit --}}



<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditModalLabel">User Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form id="updateForm">
        @csrf
        @method('PUT')
      <div class="modal-body">
         <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control user_name" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control user_email" required>
        </div>

        <div class="form-group">
            <label>Type</label>
             <select name="type" class="form-control user_type" required>
                <option value="">Select</option>
                <option value="user">User</option>
                <option value="manager">Manager</option>
                <option value="admin">Admin</option>
            </select>
        </div>

         <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control password" required>
            
        </div>


        
      </div>
      <div class="modal-footer">
        <input type="hidden" name="edit_id" class="edit_id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
      </div>
        </form>
    </div>
  </div>
</div>


<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="DeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DeleteModalLabel">Delete User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>Are you sure you want to delete</div>
      </div>
       <form id="deleteForm">
         @csrf
    @method('DELETE')
      <div class="modal-footer">
        <input type="hidden" class="delete_id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
       </form>
    </div>
  </div>
</div>

    


<!-- Scripts -->
        

        <script src="{{url('/js/jquery.min.js')}}"></script>
        <script src="{{url('/js/dataTables.js')}}"></script>
<script src="{{url('/js/popper.min.js')}}"></script>
<script src="{{url('/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('/js/admin.js')}}"></script>

</body>
</html>
