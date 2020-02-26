        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h1 mb-0 text-gray-800 ">Kuintansi</h1>
          </div>

          <div class="d-sm-flex align-items-center mb-4">
						
						
						<div class="id-none form-inline ml-md-3 input-daterange">
							<input type="text" class="form-control">
							<div class="input-group-text justify-content-sm-center">to</div>
							<input type="text" class="form-control">
						</div>
						
          </div>

					<!--table-->
					<table id="table1" class="table table-striped table-bordered nowrap" style="width:100%">
						<thead>
							<tr>
								<th>Bulan Iuran</th>
								<th>Tanggal Pembayaran</th>								
								<th>Action</th>
							</tr>
						</thead>
						<tbody>						
						</tbody>
					</table>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- pdf Modal-->
      <div class="modal fade" id="pdfmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Print Laporan?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-footer">
            <a class="btn btn-secondary" href="<?=base_url("index.php/Main/cetak_pdf_diskon/" );?>" id="pdfdiskon" target="_blank">Laporan + Diskon</a>
            <a class="btn btn-primary" href="<?=base_url("index.php/Main/cetak_pdf/" );?>" id="pdfdata" target="_blank">Laporan</a>
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

  <!-- responsive  -->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

	<script src="<?php echo base_url('dist/vendor/datatables/jquery.dataTables.js');?>"></script>
	<script src="<?php echo base_url('dist/js/table.js');?>"></script>
	<script src="<?php echo base_url('dist/vendor/datetimepicker/js/bootstrap-datepicker.min.js');?>"></script>
	<script>
		$('.input-daterange').datepicker({
        format: 'yyyy-mm-dd'    // pass here your desired format
    });
    $('.input-daterange').change(function(e){
      get_arsip();
    })

    function get_filter_value(){
      var date = []
      $('.input-daterange input').each(function() {
        date.push($(this).datepicker('getDate'))
      });
      if(date[0]!=null){
        return {
          startDate: date[0].getFullYear() +'-'+ parseInt(date[0].getMonth()+1) +'-'+ date[0].getDate(),
          endDate: date[1].getFullYear() +'-'+ parseInt(date[1].getMonth()+1) +'-'+ date[1].getDate()
        }
      } else{
        return {
          startDate: null,
          endDate: null
        }
      }
    }

    function get_arsip(){
      $(".dataTables_empty").text("Loading...")
      var data = get_filter_value();
      data.id = "<?php echo $idBlok?>"
      $.ajax({
        url: "<?php echo base_url() ?>index.php/Main/get_all_arsip/",
        type: 'POST',
        data: data,
        success: function (json) {
          dTable.clear().draw();
          var response = JSON.parse(json);
          if(response.length > 0){
            response.forEach((data)=>{
              dTable.row.add([
                data.bulan+' '+ data.tahun, 
                data.tanggal,
                '<button class="btn btn-outline-primary mt-10 mb-10" onclick=goToPdf("'+data.IDNota+'")>Nota</button>'
              ]).draw(false);
              
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
    
    $(document).ready(function () {
      dTable = $('#table1').DataTable({
        responsive: true
      });
      get_arsip()
    });

    function goToPdf(id){
      $.ajax({
        url: "<?php echo base_url() ?>index.php/Main/view_pdf/",
        type: 'POST',
        data: {data:id},
        success: function (json) {
          var o = json;
          console.log(o);
         
          $('#pdfmodal').modal();
          $('#pdfdata').click(function pdftampil() {
              $.ajax({
                  url:"<?php echo base_url() ?>index.php/Main/cetak_pdf",
                  type: 'POST',
                  data: {id:o},
                  success: function (hasil) {
                      console.log(hasil);

                  },
                  error: function (xhr, status, error) {
                  alert('Terdapat Kesalahan Pada Server...');
                  $("#submit").prop("disabled", false);
                  }
              });
          });    

          $('#pdfdiskon').click(function pdftampil() {
              $.ajax({
                  url:"<?php echo base_url() ?>index.php/Main/cetak_pdf_diskon",
                  type: 'POST',
                  data: {id:o},
                  success: function (hasil) {
                      console.log(hasil);

                  },
                  error: function (xhr, status, error) {
                  alert('Terdapat Kesalahan Pada Server...');
                  $("#submit").prop("disabled", false);
                  }
              });
          });                                                                  
        },
        error: function (xhr, status, error) {
        alert('Terdapat Kesalahan Pada Server...');
        $("#submit").prop("disabled", false);
        }
      });
    }



  </script>
</body>

</html>
