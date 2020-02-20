        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="card shadow mb-12">
                <div class="card-header py-3">
                    <!-- Page Heading -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h1 class="h1 mb-0 text-gray-800 ">Change Password</h1>
                    </div>

                
                    <!--form-->
                    <div class="card-body" style="background-color: #FFFFFF;">

                    <div class="alert alert-danger print-error-msg" style="display:none"></div>    

                        <form id="form">
                                <div class="form-group">
                                    <label for="password" class="col-form-label">Password</label>
                                    <input type="text" class="form-control" id="password" value="">
                                </div>
                                <div class="form-group">
                                    <label for="re_password" class="col-form-label">Retype Password</label>
                                    <input type="text" class="form-control" id="re_password" value="">
                                </div>                               
                                <button class="btn btn-primary" onclick="doSave()">Save</button>                  
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->


      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?=base_url("index.php/Main/logoutuser");?>">Logout</a>
            </div>
        </div>
        </div>
    </div>

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
      function doSave(){

        $(document).on('submit', '#form', function (event) {
          event.preventDefault();
          $("#submit").prop("disabled", true);

          var pass = $("#password").val();
          var repass = $("#re_password").val()
                   
          $.ajax({
            url: "<?php echo base_url() ?>index.php/Main/aksipass",
            type:'POST',
            dataType: "json",
            data: {password:pass, re_password:repass},
            success: function(data) {
              if($.isEmptyObject(data.error)){
                $(".print-error-msg").css('display','none');

                $.ajax({
                  url: "<?php echo base_url() ?>index.php/Main/update_password_user",
                  type: 'POST',
                  data: {passw:pass},
                  success: function (json) {
                      alert('berhasil diubah');
                      window.location = "<?php echo base_url() ?>index.php/Main/dashboardadmin";
                      console.log(json);
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
        });
      }

    </script>

</body>

</html>