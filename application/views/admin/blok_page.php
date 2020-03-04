        <!-- Begin Page Content -->
        <div class="container-fluid">

        <div class="card shadow mb-12">
          <div class="card-header py-3">

            <!-- Page Heading -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h1 class="h1 mb-0 text-gray-800 ">Data Blok</h1>
            </div>

            <div class="card-body" style="background-color: #FFFFFF;">
              <div class="d-sm-flex align-items-center justify-content-between mb-4"> 
                  <button class="btn btn-primary" data-toggle="modal" data-target="#addmodal">Add Blok</button>
              </div>

              <div class="d-sm-flex align-items-center mb-4">                
                  <div class="btn-group">
                      <select id='fl-perumahan' class="custom-select">
                          <option selected value="default">Perumahan</option>
                      </select>
                  </div>
                  <div class="btn-group">
                      <select id='fl-cluster' class="custom-select">
                          <option selected value="default">Cluster</option>
                      </select>
                  </div>

              </div>

              <!--table-->
              <table id="table1" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>Nama Blok</th>
                          <th>Nama Customer</th>
                          <th>Harga</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>                      
                  </tbody>
              </table>
            </div>
          </div>        
        </div>
        <!-- card body -->
      </div>
      <!-- /.container-fluid -->

        <!-- modal edit -->
        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="editTitle">Edit Blok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form onsubmit="updatedata(event)">       
                <div class="modal-body">
                      <input type="hidden" class="form-control" id="id-blok1" readonly>

                      <div class="form-group">
                          <label for="nama-blok1" class="col-form-label">Nama Blok:</label>
                          <input type="text" class="form-control" id="nama-blok1" required>
                      </div>          
                      <div class="form-group">
                          <label for="perumahan1" class="col-form-label">Nama Perumahan:</label>
                          <select class="custom-select" id="perumahan1" required>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="cluster1" class="col-form-label">Nama Cluster:</label>
                          <select class="custom-select" id="cluster1" required>
                          <option value="default">Cluster</option>
                          </select>
                      </div>  
                      <div class="form-group">
                          <label for="harga1" class="col-form-label">Harga:</label>
                          <input type="text" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" class="form-control" id="harga1">
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div> 

        <!-- modal add -->
        <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title w-100 text-center" id="addTitle">Add Blok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form onsubmit="insertdata(event)">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="nama-blok" class="col-form-label">Nama Blok:</label>
                    <input type="text" required class="form-control" id="nama-blok" placeholder="Nama Blok...">
                  </div>
                  <div class="form-group">
                    <label for="perumahan" class="col-form-label">Nama Perumahan:</label>
                    <select class="custom-select" id="perumahan" required>
                      <option value="default">Perumahan</option>         
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="cluster" class="col-form-label">Nama Cluster:</label>
                    <select class="custom-select" id="cluster" required>
                      <option value="default">Cluster</option>                
                    </select> 
                  </div>
                  <div class="form-group">
                    <label for="harga" class="col-form-label">Harga:</label>
                    <input type="text" required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" class="form-control" id="harga">
                  </div>
                  <div class="form-group">
                    <label for="type" class="col-form-label">Type:</label>
                    <input type="text" class="form-control" id="type" required>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
              </form>
            </div>
          </div>
        </div>  

      </div>
      <!-- End of Main Content -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('dist/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('dist/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('dist/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('dist/js/sb-admin-2.min.js');?>"></script>
      
    <!-- responsive  -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script src="<?php echo base_url('dist/vendor/datatables/jquery.dataTables.js');?>"></script>
    <script src="<?php echo base_url('dist/js/table.js');?>"></script>

    <script>
      $.ajax({
        url: "<?php echo base_url() ?>index.php/Main/get_all_perumahan",
        type: 'POST',
        success: function (json) {
          var response = JSON.parse(json);
          response.forEach((data)=>{ 
            // var res = data.nama_perumahan.replace(/_/g, " ");
            $('#fl-perumahan').append(new Option(data.nama_perumahan, data.IDPerumahan))
            $('#perumahan1').append(new Option(data.nama_perumahan, data.IDPerumahan))
            $('#perumahan').append(new Option(data.nama_perumahan, data.IDPerumahan))            
          })
        },
        error: function (xhr, status, error) {
          alert('Terdapat Kesalahan Pada Server...');
          $("#submit").prop("disabled", false);
        }
      });

// fl-perumahan
      $("#fl-perumahan").change(function (e) { 
        e.preventDefault();
        if($("#fl-perumahan").val() != "default"){
          getClusterofPerumahan($("#fl-perumahan").val(), function(){
            get_data()
            console.log($("#fl-cluster").val())
          });
        }
        else{
          $("#fl-cluster option[value!=default]").remove();
          get_data()
        }
      });

      $("#fl-cluster").change(function (e) { 
        e.preventDefault();
        get_data();
      });

//perumahan1
      $("#perumahan1").change(function (e) { 
        e.preventDefault();
        if($("#perumahan1").val() != "default"){
          getClusterofPerumahan($("#perumahan1").val(), function(){});
        }
        else{
          $("#cluster1 option[value!=default]").remove();
        }
        get_data();
      });

      $("#cluster1").change(function (e) { 
        e.preventDefault();
        get_data();
      });

// perumahan
    $("#perumahan").change(function (e) { 
      e.preventDefault();
      if($("#perumahan").val() != "default"){
        getClusterofPerumahan($("#perumahan").val(), function(){});
      }
      else{
        $("#cluster option[value!=default]").remove();
      }
      get_data();
    });

    $("#cluster").change(function (e) { 
      e.preventDefault();
      get_data();
    });


    function getClusterofPerumahan(id,callback){
      $.ajax({
        url: "<?php echo base_url() ?>index.php/Main/get_cluster_by_perumahan",
        type: 'POST',
        data: {id: id},
        success: function (json) {
          $("#fl-cluster option[value!=default]").remove();
          $("#cluster1 option[value!=default]").remove();
          $("#cluster option[value!=default]").remove();
          var response = JSON.parse(json);
          response.forEach((data)=>{
            var datacluster = data.nama_cluster;
            var temukan = datacluster.indexOf("_");
            var namacluster = data.nama_cluster.substring(temukan+1);

            $('#fl-cluster').append(new Option(namacluster, data.IDCluster))
            $('#cluster1').append(new Option(namacluster, data.IDCluster))
            $('#cluster').append(new Option(namacluster, data.IDCluster))
          })
          callback()
        },
        error: function (xhr, status, error) {
          alert('Terdapat Kesalahan Pada Server...');
          $("#submit").prop("disabled", false);
        }
      });
    }
      

    function get_filter_value(){
      var perumahan = $("#fl-perumahan").val();
      if(perumahan == "default"){
        perumahan = null;
      }
      var cluster = $("#fl-cluster").val();
      if(cluster == "default"){
        cluster = null;
      }

      return {
        perumahan: perumahan,
        cluster: cluster
      }
    }

    $(document).ready(function () { 
      dTable = $('#table1').DataTable({
        responsive: true
      });
      get_data()
    });

    function get_data(){
      $(".dataTables_empty").text("Loading...")
      var data = get_filter_value()
      $.ajax({
        url: "<?php echo base_url() ?>index.php/Main/get_all_blok/1",
        type: 'POST',
        data:data,
        success: function (json) {
          var response = JSON.parse(json);
          dTable.clear().draw();
          if(response.length > 0){
            response.forEach((data)=>{
              no = data.IDBlok  
              if(data.IDBlok != null) {
                dTable.row.add([
                  data.nama_blok,
                  data.nama,
                  data.Harga,                
                    '<button class="btn btn-outline-success mt-10 mb-10" onclick=tampildata("'+ no +'") >Edit</button>'
                  + '<button class="btn btn-danger mt-10 mb-10" onclick=hapusdata("'+ no +'") >Delete</button>'              
                ]).draw(false);
              }            
            })
          } else{
            $(".dataTables_empty").text("Tidak ada data yang ditampilkan.")
          }
        },    
        error: function (xhr, status, error) {
          alert('Terdapat Kesalahan Pada Server...');
          $("#submit").prop("disabled", false);
        }
      });
    }

    function hapusdata(id) {
      var tanya = confirm("hapus data?");

      if(tanya){
        $.ajax({
          url: "<?php echo base_url() ?>index.php/Main/delete_blok",
          type: 'POST',
          data: {id: id},
          success: function (response) {
              alert('Data Berhasil Dihapus!');
              window.location = "<?php echo base_url() ?>index.php/Main/blok";

          },
          error: function () {
              console.log("gagal menghapus");
              alert('Data gagal dihapus!');


          }
        });
      }
    }

    function tampildata(id) {
      $.ajax({
        url: "<?php echo base_url()?>index.php/Main/get_blok_by_id",
        type: 'POST',
        data: {id: id},
        success: function (response) {
          var response = JSON.parse(response);
          response.forEach((data)=>{
            console.log(data);
            $('#editmodal').modal();
            $('#nama-blok1').val(data.nama_blok);
            $('#id-blok1').val(data.IDBlok);
            $('#perumahan1').val(data.IDPerumahan);
            $.ajax({
              url: "<?php echo base_url() ?>index.php/Main/get_cluster_by_perumahan",
              type: 'POST',
              data: {id: $("#perumahan1").val()},
              success: function (json) {
                $("#cluster1 option[value!=default]").remove();
                var response = JSON.parse(json);
                response.forEach((dt)=>{
                  var datacluster = data.nama_cluster;
                  var temukan = datacluster.indexOf("_");
                  var namacluster = data.nama_cluster.substring(temukan+1);
                  
                  $('#cluster1').append(new Option(namacluster, dt.IDCluster))
                })
                $('#cluster1').val(data.IDCluster);
              },
              error: function (xhr, status, error) {
                alert('Terdapat Kesalahan Pada Server...');
                $("#submit").prop("disabled", false);
              }
            });

            // $('#cluster1').append(new Option(data.nama_cluster, data.IDCluster, true, true))
            
            $('#harga1').val(data.Harga);
          })                
        },
        error: function () {
            console.log("gagal tampil");
        }
      });          
    }

    function updatedata(e) {
      e.preventDefault();
      var inputperumahan = document.getElementById("perumahan1").value
      var inputcluster = document.getElementById("cluster1").value
      var inputid = document.getElementById("id-blok1").value
      var inputnama = document.getElementById("nama-blok1").value
      var inputharga = document.getElementById("harga1").value
      if(inputcluster == "default"){
        alert("Silahkan Pilih Perumahan dan Cluster")
        return;
      }

        $.ajax({
          url: "<?php echo base_url()?>index.php/Main/update_blok/",
          type: 'POST',
          data: {id:inputid, perumahan:inputperumahan, cluster:inputcluster, harga:inputharga, nama:inputnama},
          success: function (response) {
            alert('Data Berhasil diupdate!');
            window.location = "<?php echo base_url() ?>index.php/Main/blok";
          },
          error: function () {
            console.log("gagal update");
            alert('Data gagal diupdate!');

          }
        });
    }

    function insertdata(e) {
      var inputnama = document.getElementById("nama-blok").value
      var inputperum = document.getElementById("perumahan").value
      var inputcluster = document.getElementById("cluster").value
      var inputharga = document.getElementById("harga").value
      var inputtype = document.getElementById("type").value

      if(inputperum == "default" || inputcluster == "default"){
        e.preventDefault();
        alert("Silahkan Pilih Perumahan dan Cluster")
        return;
      }

      $.ajax({
        url: "<?php echo base_url()?>index.php/Main/insert_blok/",
        type: 'POST',
        data: {nama:inputnama, cluster:inputcluster, harga:inputharga, type:inputtype},
        success: function (response) {
          alert('Data Berhasil Ditambahkan!');
          window.location = "<?php echo base_url() ?>index.php/Main/blok";
        },
        error: function () {
          console.log("gagal insert");
          alert('Data gagal diinputkan!');

        }
      });
      e.preventDefault();
    }


    </script>
</body>

</html>
