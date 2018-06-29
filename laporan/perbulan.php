<div class="row mt">
  <div class="col-lg-12">
     <div class="form-panel" style="width:50%;">
        <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Laporan Perbulan
        </h4>
 <div class="row">
 <form action="laporan/print_perbulan.php" target="_blank" method="post" id="form">
        <div class="col-lg-6 col-xs-10">
          <div class="form-group">
	
	<select class="form-control" name="bulan" class="required">
	            	<option value="">pilih</option>
	                <option value="01">Januari</option>
	                <option value="02">Februari</option>
	                <option value="03">Maret</option>
	                <option value="04">April</option>
	                <option value="05">Mei</option>
	                <option value="06">Juni</option>
	                <option value="07">Juli</option>
	                <option value="08">Agustus</option>
	                <option value="09">September</option>
	                <option value="10">Oktober</option>
	                <option value="11">November</option>
	                <option value="12">Desember</option>               
	 </select>
	 </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <div class="form-group">
	 <input type="text" name='tahun' class="form-control" placeholder="Tahun">
	 </div>
        </div>
   <button class="btn btn-primary"><span class='glyphicon glyphicon-print'></span> Print</button>
    </form>
 </div>
    

	 </div>
  </div>
</div>