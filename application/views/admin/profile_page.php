        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="card shadow mb-12">
                <div class="card-header py-3">
                    <!-- Page Heading -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h1 class="h1 mb-0 text-gray-800 ">Profile</h1>
                    </div>

                
                    <!--form-->
                    <div class="card-body" style="background-color: #FFFFFF;">
                        <form onsubmit="doSave(event)">
                                <div class="form-group">
                                    <label for="nama" class="col-form-label">Nama:</label>
                                    <input type="text" class="form-control" id="nama" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="nomor" class="col-form-label">Nomor:</label>
                                    <input required type="text" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" id="nomor" value="">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" value="" required>
                                </div>                    
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" readonly>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Update</button>                  
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('dist/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('dist/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('dist/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('dist/js/sb-admin-2.min.js');?>"></script>

	<script src="<?php echo base_url('dist/vendor/datatables/jquery.dataTables.js');?>"></script>
	<script src="<?php echo base_url('dist/js/table.js');?>"></script>

    <script>
      function doSave(e){
        e.preventDefault()
        var data = {}
        data.nama = $("#nama").val();
        data.nomor = $("#nomor").val();
        data.email = $("#email").val();
        
        if($("#password").val() != ""){
          data.password = $("#password").val();
        }

        $.ajax({
            url: "<?php echo base_url() ?>index.php/Main/update_profile",
            type: 'POST',
            data: data,
            success: function (json) {
                alert(json)
            },
            error: function (xhr, status, error) {
              alert('Terdapat Kesalahan Pada Server...');
              $("#submit").prop("disabled", false);
            }
          });
      }

        $(document).ready(function () { 
          dTable = $('#table').DataTable();
          $.ajax({
            url: "<?php echo base_url() ?>index.php/Main/get_my_profile",
            type: 'POST',
            success: function (json) {
              var response = JSON.parse(json);
              console.log(response)
              response.forEach((data)=>{
                var res = data.nama_user.replace(/_/g, " ");
                $("#nama").val(res);
                $("#nomor").val(data.nomor);
                $("#email").val(data.email);
                $("#password").val(data.password);
                
              })
            
            },
            error: function (xhr, status, error) {
              alert('Terdapat Kesalahan Pada Server...');
              $("#submit").prop("disabled", false);
            }
          });
        });
    </script>

</body>

</html>
