        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-center mb-4">
                <h1 class="h1 mb-0 text-gray-800 ">Data Detail Blok Customer</h1>
            </div>

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <button class="btn btn-primary">Add</button>
                <form class="d-none d-sm-inline-block form-inline ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" id="searchbox" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                                </button>
                        </div>
                    </div>
                </form>
            </div>

            <!--table-->
            <table id="table" class="display">
                <thead>
                    <tr>
                        <th>Nama Perumahan</th>
                        <th>Nama Cluster</th>
                        <th>Nama Blok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>A2</td>
                        <td>B3</td>
                        <td>Tata</td>
                        <td>
                            <button class="btn btn-outline-success mt-10 mb-10" data-toggle="modal" data-target="#editmodal">Edit</button>
                            <button class="btn btn-danger mt-10 mb-10">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>A3</td>
                        <td>B2</td>
                        <td>Toto</td>
                        <td>
                            <button class="btn btn-outline-success mt-10 mb-10">Edit</button>
                            <button class="btn btn-danger mt-10 mb-10">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
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
</body>

</html>
