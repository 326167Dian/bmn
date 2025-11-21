<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=../css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Modul anda harus login.</div>";
}
else{

switch($_GET['act']){
  default:
      
	  ?>
			
			
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Pengecekan Tensi Darah</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools
                    -->
				</div>
				<div class="box-body">
				
				    <form action="#" method="POST" id="form">
                        <div class="form-group row">
                            <label for="tensi" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-10">
                                <input type="text" name="nm_pelanggan" id="nm_pelanggan" class="typeahead form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tensi" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir" autocomplete="off">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="tensi" class="col-sm-2 col-form-label">Hasil Tensi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tensi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="guladarahpuasa" class="col-sm-2 col-form-label">Gula Darah Puasa</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="guladarahpuasa">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="guladarah2jam" class="col-sm-2 col-form-label">Gula Darah 2 Jam PP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="guladarah2jam">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="asamurat" class="col-sm-2 col-form-label">Asam Urat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="asamurat">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="kolesterol" class="col-sm-2 col-form-label">Kolesterol Total</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kolesterol">
                            </div>
                        </div>
                      
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <button type="submit" class="btn btn-danger">Batal</button>
                            </div>
                        </div>
                    </form>
						
				</div> 
				
			</div>
             
            <script>
                 function exportExcel(){
                    let shift = $('#shift').val();
                    let tgl_akhir = $('#tgl_akhir').val();
                    let tgl_awal = $('#tgl_awal').val();
                    // window.location = 'modul/mod_lapstok/stokopname_excel.php?jenisobat='+jenisobat
                    window.open('modul/mod_lapstok/soharian_excel.php?shift='+shift+'&start='+tgl_awal+'&finish='+tgl_akhir, '_blank');
                }
            </script>
<?php
    
    break;
	
}
}
?>

<script type="text/javascript">
    $(function(){
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
    
    //auto pelanggan
	$('#nm_pelanggan').typeahead({
		source: function(query, process) {
			return $.get('modul/mod_tensi/autopelanggan.php', {
				query: query
			}, function(data) {

				data = $.parseJSON(data);
				return process(data);

			});
		}
	});

    //enter pelanggan
	$('#nm_pelanggan').keydown(function(e) {
		if (e.which == 13) { // e.which == 13 merupakan kode yang mendeteksi ketika anda   // menekan tombol enter di keyboard
			//letakan fungsi anda disini

			var nm_pelanggan = $("#nm_pelanggan").val();
			e.preventDefault();
			$.ajax({
				url: 'modul/mod_tensi/autopelanggan_enter.php',
				type: 'post',
				data: {
					'nm_pelanggan': nm_pelanggan
				},
			}).success(function(data) {

                var json = data;
    			//replace array [] menjadi '' 
    			var res1 = json.replace("[", "");
    			var res2 = res1.replace("]", "");
    			//INI CONTOH ARRAY JASON const json = '{"result":true, "count":42}';
    			datab = JSON.parse(res2);
    			
    // 			if(datab.nm_pelanggan === NULL){
    // 			    console.log('data kosong');
    //             } else {
                    
    				document.getElementById('nm_pelanggan').value = datab.nm_pelanggan;
    				document.getElementById('tgl_lahir').value = datab.tgl_lahir;
                // }
			});

		}
	});
	
	$('#form').keydown(function(e) {
		if (e.which == 13) { // e.which == 13 merupakan kode yang mendeteksi ketika anda   // menekan tombol enter di keyboard
			//letakan fungsi anda disini
            e.preventDefault();
			    
		}
	});

</script>
