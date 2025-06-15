<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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
            <a href="{{url('/admin')}}" id="admin_page" class="btn btn-outline-primary mr-2" style="display: none">Admin</a>
            <a href="{{url('/home')}}" class="btn btn-outline-primary mr-2">Profile</a>


            
            <button id="logoutBtn" class="btn btn-outline-danger">Logout</button>
        </div>
    </div>


        </div>
    </nav>



    <div class="container mt-5 user_view_profile" style="display: none">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-header text-center">
            <h4>User Profile</h4>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> <span id="user-name">Loading...</span></p>
            <p><strong>Email:</strong> <span id="user-email">Loading...</span></p>
            <p><strong>Type:</strong> <span id="user-type">Loading...</span></p>
            <div class="mb-3">
         <button type="submit" class="btn btn-primary update_profile">Update Profile</button>
         </div>
        </div>
        
    </div>
</div>



<div class="login-wrapper user_update_profile" style="display: none">
    <div class="card p-4">
    <h4 class="text-center">Update Profile</h4>

   <div id="update-success" class="alert alert-success d-none"></div>
    <div id="update-error" class="alert alert-danger d-none"></div>

    <form id="updateForm">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control user_name" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control user_email" required>
        </div>

        <div class="form-group">
            <label>New Password (optional)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary w-100">Update</button>
         <button type="button" class="btn btn-warning view_profile w-100 mt-3">View Profile</button>

    </form>
</div>
</div>


<!-- Scripts -->
<script src="{{url('/js/jquery.min.js')}}"></script>
<script src="{{url('/js/popper.min.js')}}"></script>
<script src="{{url('/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{url('/js/home.js')}}"></script>
</body>
</html>
