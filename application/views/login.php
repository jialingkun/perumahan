
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Chalidanna</title>

  <!-- Custom fonts for this template-->
  <link href="<?=base_url('dist/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?=base_url('dist/css/sb-admin-2.min.css');?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><i>Welcome</i></h1>
                  </div>

                  <div class="form-group"><br></div>
                  <div class="alert alert-danger print-error-msg" style="display:none"></div>    

                  <form id="form" method="POST">
                    <div class="form-group">
                      <center><label for="usr">Username</label></center>
                      <input type="text" class="form-control form-control-user" name="username">
                    </div>
                    
                    <div class="form-group">
                      <center><label for="usr">Password</label></center>
                      <input type="password" class="form-control form-control-user" name="password">
                    </div>
                    <div class="form-group"><br></div>
                    <hr>
                    <center><button id="submit" type="submit" class="btn btn-primary center-item">Sign In</button></center>
                    <hr>
                  </form>                 
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=base_url('dist/vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?=base_url('dist/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=base_url('dist/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=base_url('dist/js/sb-admin-2.min.js');?>"></script> 

  <script>
    $(document).on('submit', '#form', function (event) {
      event.preventDefault();
      var dataString = $("#form").serialize();
      $("#submit").prop("disabled", true);

      $.ajax({
          url: "<?php echo base_url() ?>index.php/Main/aksilogin",
          type:'POST',
          dataType: "json",
          data: dataString,
          success: function(data) {
            if($.isEmptyObject(data.error)){
              $(".print-error-msg").css('display','none');

                $.ajax({
                url: "<?php echo base_url() ?>index.php/Main/cekloginuser",
                type: 'POST',
                data: dataString,
                success: function (response) {
                  console.log(response);
                  if (response == "admin") {
                    window.location.replace("<?php echo base_url() ?>index.php/Main/dashboardadmin");
                    alert("Selamat Datang Admin");
                  } else if (response == "staff") {
                    window.location.replace("<?php echo base_url() ?>index.php/Main/dashboardstaff");
                    alert("Selamat Datang Staff");
                  } else {    
                    alert("password atau email salah!");
              
                    $("#submit").prop("disabled", false);
                  }
                
                },
                error: function (xhr, status, error) {
                  alert(status + '- ' + xhr.status + ': ' + xhr.statusText);
                  $("#submit").prop("disabled", false);
                }
              });




            }else{
              $(".print-error-msg").css('display','block');
              $(".print-error-msg").html(data.error);
              $("#submit").prop("disabled", false);

            }
          }
      });


      // 
    });

  </script>

</body>

</html>
