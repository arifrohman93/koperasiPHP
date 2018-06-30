<?php 
	include "config/koneksi.php";
	include "fungsi/fungsi.php";

	$aksi=$_GET['aksi'];
	
?>
<script src="jquery.js"></script>

<!-- SIMPANAN -->
	<script language="JavaScript">
	
	$(document).ready(function(){
		$(function() {
			$( '#tanggal' ).datepicker({
				dateFormat:'yy-mm-dd',
				changeMonth: true,
				changeYear: true
			});
			$( '#tgl' ).datepicker({
				dateFormat:'yy-mm-dd',
				changeMonth: true,
				changeYear: true
			});
		});
	});
	// fungsi untuk get besar_simpanan
	function show(kode_jenis_simpan){
		$.ajax({
			type : "POST",
			data : "kode_jenis_simpan="+kode_jenis_simpan,
			url  : "dataSimpanan.php",
			success : function(msg){
				hasil = jQuery.parseJSON(msg);
				if(hasil.NAMA_SIMPANAN!=""){
					$('#besar_simpanan').val(hasil.BESAR_SIMPANAN);				
				}else{
					$('#besar_simpanan').val("");				
				}
			}
		})
	}
	$(document).ready(function(){
		$("#kategori").change(function(){
			var kat = $("#kategori").val();
			if (kat == "tgl_simpan"){
				$("#cari").html('<input type=\"text\" name=\"input_cari\" id=\"tgl\" onclick=\"datePicker("tgl")\"/>');
			}else{
				$("#cari").html('<input type="text" name="input_cari" id="cari"/>');
			}
		});
	});
	</script>

<!-- PINJAMAN -->
	<script language="JavaScript">
		// fungsi untuk get besar_simpanan
	function show3(kode_jenis_pinjam){
		$.ajax({
			type : "POST",
			data : "kode_jenis_pinjam="+kode_jenis_pinjam,
			url : "dataJenisPinjaman.php",
			success : function(msg){
				hasil = jQuery.parseJSON(msg);
				if(hasil.NAMA_PINJAMAN!=""){
					$('#lama_angsuran').val(hasil.LAMA_ANGSURAN);
					$('#maks_pinjam').val(hasil.MAKS_PINJAM);
					$('#bunga').val(hasil.BUNGA);
				}else{		
					$('#lama_angsuran').val("");
					$('#maks_pinjam').val("");
				}
			}
		})
	}
	// menghitung pinjaman
		function startCalc(){
			interval = setInterval("calc()",1);
		}
	//menghitung ansuran
		function calc(){
			a = document.frmAdd.besar_pinjaman.value;
			f = document.frmAdd.bunga.value/100;
			e = document.frmAdd.maks_pinjam.value;
			b = document.frmAdd.lama_angsuran.value;
			g = a * f;
			i = a / b;
			h = parseInt(g)+parseInt(i);
			c = document.frmAdd.besar_angsuran.value = h ;
		} 
		function stopCalc(){
			clearInterval(interval);
		} 
	</script>

<!-- ANGSURAN -->
	<script language="JavaScript">
	// fungsi untuk get besar_simpanan
	function show2(kode_pinjam){
		$.ajax({
			type : "POST",
			data : "kode_pinjam="+kode_pinjam,
			url  : "dataPinjaman.php",
			success : function(msg){
				hasil = jQuery.parseJSON(msg);
				if(hasil.TGL_PINJAM!=""){
					$('#tgl_pinjam').val(hasil.TGL_PINJAM);	
					$('#besar_pinjam').val(hasil.BESAR_PINJAM);
					var a=$('#lama_angsuran').val(hasil.LAMA_ANGSURAN);
					$('#besar_angsuran').val(hasil.BESAR_ANGSURAN);
					var b=$('#angsuran_ke').val(hasil.SISA_ANGSURAN);
						

				}else{
					$('#besar_simpanan').val("");				
				}
			}
		})
	}
	</script>
<script type="text/javascript">
      $(document).ready(function() {
        $("#cari").keyup(function(){
        $("#fbody").find("tr").hide();
        var data = this.value.split("");
        var jo = $("#fbody").find("tr");
        $.each(data, function(i, v)
        {
              jo = jo.filter("*:contains('"+v+"')");
        });
          jo.fadeIn();

        })
  });

</script>

</head>

<?php
	if(empty($aksi)){
?>
<body>  
<div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                    <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Transaksi <span style="float:right;">
                     <input type="text" id="cari" style="width:230px;height:30px;font-size:15px;" placeholder=" cari disini...">
                    </span>
                 	</h4>
<form class="form-inline" role="form">
    <table class="table table-bordered table-striped table-condensed">
     <thead>
		<tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode Anggota</a></th>
             <th><a href="#">Nama Anggota</a></th>
             <th><a href="#">Pekerjaan</a></th>
             <th><a href="#">Tanggal Masuk</a></th>
             <th><a href="">Aksi</a></th>
       	</tr>	
    </thead>
<?php
			$query=mysqli_query($koneksi,"SELECT * FROM t_anggota where status='aktif'
								ORDER BY kode_anggota ASC");
echo ' <tbody id="fbody">';$no=1;		
	while($data=mysqli_fetch_array($query)){
?>
   
    	<tr>
			<td><?php echo $no;?></td>
            <td align="center"><?php echo $kod=$data['kode_anggota'];?></td>
            <td><?php echo $data['nama_anggota'];?></td>
            <td><?php echo $data['pekerjaan'];?></td>
            <td align="center"><?php echo $data['tgl_masuk'];?></td>
            <td align="center">
			<a class="btn btn-primary btn-xs" href="index.php?pilih=2.1&aksi=simpanananggota&kode_anggota=<?php echo $data['kode_anggota'];?>"><i class="glyphicon glyphicon-check"></i> Simpan</a>
			<a class="btn btn-success btn-xs" href="index.php?pilih=2.1&aksi=pinjamangsur&kode_anggota=<?php echo $data['kode_anggota'];?>"><i class="glyphicon glyphicon-edit"></i> Pinjam | <i class="glyphicon glyphicon-share"></i> Angsur</a> 
			<?php 
                      if($_SESSION['level']=='admin')
                      {
                        
                      }
                      else if($_SESSION['level']=='operator')
                      { ?>
                         <a class="btn btn-danger btn-xs" href="index.php?pilih=4.4&aksi=operator&kode_anggota=<?php echo $data['kode_anggota'];?>"><i class="glyphicon glyphicon-question-sign"></i> Pengajuan</a>
                  <?php    }
                 ?>
			</td>
        </tr>  
<?php
	$no++;} //tutup while
?>
</tbody>  </table>
                    </div>
                </div><!-- /col-lg-12 -->
</div><!-- /row -->
    
<?php
	}elseif($aksi=='simpan'){
		$kode=$_GET['kode_anggota'];
		$kode_jenis=$_GET['kode_jenis_simpan'];
		$nama=mysqli_fetch_array(mysqli_query($koneksi,"SELECT *from t_jenis_simpan where kode_jenis_simpan='$kode_jenis'"));
		$qubah=mysqli_query($koneksi,"SELECT * FROM t_anggota WHERE kode_anggota='$kode'");
		$data2=mysqli_fetch_array($qubah);
?>

<div class="row mt">
     <div class="col-lg-12">
        <div class="form-panel" style="width:50%;">
            <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Transaksi Simpanan</h4>
    <form action="transaksi/proses_transaksi.php?pros=simpan" method="post" id="form" name="mainform" onSubmit="validasiSimpan()">
    	<div class="form-group">
            <label>Kode Anggota</label>
            <input type="text" name="kode_anggota" size="34" title="Kode Anggota harus diisi" readonly="" class="form-control" value="<?php echo $data2['kode_anggota'];?>">
        </div>
        <div class="form-group">
            <label>Nama Anggota</label>
            <input type="text" name="nama_anggota" size="54" class="form-control" readonly value="<?php echo $data2['nama_anggota'];?>"/>
        </div>
        <div class="form-group">
            <label>pekerjaan</label>
           <input type="text" name="pekerjaan" class="form-control" size="54" readonly value="<?php echo $data2['pekerjaan'];?>"/>
        </div>
        <div class="form-group">
            <label>Jenis Simpanan</label>
            <select name="kode_jenis_simpan" class="form-control" id="kode_jenis_simpan" onChange="show(this.value)" class="required" title="Jenis Simpan harus diisi">
                <option value="">=pilih=</option>
				<?php
					$q=mysqli_query($koneksi,"SELECT * FROM t_jenis_simpan");
					while($a=mysqli_fetch_array($q)){
					?>
						<option value="<?php echo $a['kode_jenis_simpan'];?>"><?php echo $a['nama_simpanan'];?></option>
					<?php
					}
                ?>
            </select>
        </div>
        <script>
		  function isNumberKey(evt)
		  {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		  if (charCode > 31 && (charCode < 48 || charCode > 57))

		  return false;
		  return true;
		  }
		</script>
		<?php if($a['nama_simpanan']=='pokok' || $a['nama_simpanan']=='wajib')
		{
		?>
        <div class="form-group">
            <label>Besar Simpanan</label>
            <input type="text" onkeypress="return isNumberKey(event);" value="<?php echo $a['besar_simpanan'];?>" name="besar_simpanan" class="form-control" id="besar_simpanan" size="54" readonly/>
        </div>
        <?php } 
        else { ?>
        <div class="form-group">
            <label>Besar Simpanan</label>
            <input type="text" onkeypress="return isNumberKey(event);"  value="<?php echo $a['besar_simpanan'];?>" name="besar_simpanan" class="form-control" id="besar_simpanan" size="54" />
        </div>
        <?php } ?>
        <div class="form-group">
            <label>User Entri</label>
            <input type="text" name="user_entri" class="form-control" size="54" value="<?php session_start(); echo $_SESSION['kopname'];?>" readonly >
        </div>
        <div class="form-group">
            <label>Tanggal Entri</label>
            <input type="text" name="tgl_entri" class="form-control" size="54" value="<?php echo date("Y-m-d");?>" readonly />
        </div>
        <button class="btn btn-danger"><span class='glyphicon glyphicon-check'></span> Simpan</button>
         </form>

</div>
</div>
</div>
<?php
	}else if($aksi=='pinjam'){
		$kode=$_GET['kode_anggota'];
		$qubah=mysqli_query($koneksi,"SELECT * FROM t_anggota WHERE kode_anggota='$kode'");
		$data2=mysqli_fetch_array($qubah);
?>

<div class="row mt">
     <div class="col-lg-12">
        <div class="form-panel" style="width:50%;">
            <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Transaksi Pinjaman</h4>
<form action="transaksi/proses_pinjam_fuzzy.php" method="GET" id="form" name="frmAdd">
<div class="form-group">
    <label>Kode Anggota</label>
    <input type="text" class="form-control" name="kode_anggota" size="34" title="Kode Anggota harus diisi" readonly="" value="<?php echo $data2['kode_anggota'];?>">
</div>
<div class="form-group">
    <label>Nama Anggota</label>
    <input type="text" class="form-control" name="nama_anggota" size="54" readonly value="<?php echo $data2['nama_anggota'];?>"/>
</div>
<div class="form-group">
    <label>Pekerjaan</label>
    <input type="text" class="form-control" name="pekerjaan" size="54" readonly value="<?php echo $data2['pekerjaan'];?>"/>
</div>
<div class="form-group">
    <label>Jenis Pinjaman</label>
    <select name="kode_jenis_pinjam" class="form-control" id="kode_jenis_pinjam" onChange="show3(this.value)" class="required" title="Jenis Pinjaman harus diisi">
               <option value="">=pilih=</option>
			   <?php
                $q=mysqli_query($koneksi,"SELECT * FROM t_jenis_pinjam");
                while($a=mysqli_fetch_array($q)){
                ?>
					<option value="<?php echo $a['kode_jenis_pinjam'];?>"><?php echo $a['nama_pinjaman'];?></option>
				<?php
                }
                ?>
            </select>
</div>
<div class="form-group">
    <label>Lama Angsuran (Bulan)</label>
    <input id="lama_angsuran" class="form-control" placeholder="Bulan" type="text" name="lama_angsuran" style="width:100px;" readonly/>
</div>
<div class="form-group">
    <label>Maks Pinjaman</label>
    <input id="maks_pinjam" class="form-control" type="text" name="maks_pinjam" size="54" readonly/>
</div>
<div class="form-group">
    <label>Bunga (%)</label>
    <input id="bunga" class="form-control" type="text" size="54" readonly/>
</div>
<script>
  function isNumberKey(evt)
  {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

  return false;
  return true;
  }
</script>
<div class="form-group">
    <label>Besar Pinjam</label>
    <input type="text" onkeypress="return isNumberKey(event);" class="form-control" name="besar_pinjaman" id="besar_pinjam" size="54" class="required" title="Besar Pinjaman harus diisi"/>
</div>
<div class="form-group">
    <label>Angsuran</label>
    <input type="text" class="form-control" name="besar_angsuran" id="besar_angsuran" size="54" class="required" onFocus="startCalc();" onBlur="stopCalc();" readonly/>
</div>
<div class="form-group">
    <label>User Entri</label>
    <input type="text" class="form-control" name="u_entry" size="54" value="<?php session_start(); echo $_SESSION['kopname'];?>" readonly>
</div>
<div class="form-group">
    <label>Tanggal Entri</label>
    <input type="text" class="form-control" name="tgl_entri" size="54" value="<?php echo date("Y-m-d");?>" readonly/>
</div>
<button class="btn btn-danger"><span class='glyphicon glyphicon-edit'></span> Pinjam</button>
</form>

</div>
</div>
</div>
<?php
	}else if($aksi=='angsur')
	{
		$kode=$_GET['kode_anggota'];
		$kodep=$_GET['kode_pinjam'];
		$jio=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from t_pinjam where kode_pinjam='$kodep' "));

		$qubah=mysqli_query($koneksi,"SELECT * FROM t_anggota WHERE kode_anggota='$kode'");
		$data2=mysqli_fetch_array($qubah);
?>

<div class="row mt">
     <div class="col-lg-12">
        <div class="form-panel" style="width:50%;">
            <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Transaksi Angsuran</h4>
<form action="transaksi/proses_transaksi.php?pros=angsur" method="post" id="form" name="frmAdd">
<div class="form-group">
<label for="kode_anggota">Kode Anggota</label>
  <input type="text" class="form-control" name="kode_anggota" size="54" readonly value="<?php echo $data2['kode_anggota'];?>">
</div>
<div class="form-group">
<label for="nama_anggota">Nama Anggota</label>
  <input type="text" class="form-control" name="nama_anggota" size="54" readonly value="<?php echo $data2['nama_anggota'];?>"/>
</div>
<div class="form-group">
<label for="kode_pinjam">Kode Pinjam</label>
     		<select name="kode_pinjam" class="form-control" id="kode_pinjam" onChange="show2(this.value)" class="required" title="Jenis Simpan harus diisi">
               <option value="<?php echo $_GET['kode_pinjam']; ?>"><?php echo $_GET['kode_pinjam']; ?></option>
            </select>
</div>
<div class="form-group">
<label for="tgl_pinjam">Tanggal Pinjam</label>
  <input id="tgl_pinjam" class="form-control" value="<?php echo $jio['tgl_entri'];?>" type="text" name="tgl_pinjam" size="54" readonly />
</div>
<div class="form-group">
<label for="besar_pinjaman">Besar Pinjam</label>
  <input type="text" class="form-control" name="besar_pinjam" value="<?php echo $jio['besar_pinjam'];?>" id="besar_pinjam" value="" size="54" readonly  onFocus="startCalc();" onBlur="stopCalc();"/>
</div>
<div class="form-group">
<label for="lama_angsur">Lama Angsur</label>
  <input type="text" class="form-control" name="lama_angsuran" value="<?php echo $jio['lama_angsuran'];?>" id="lama_angsuran" size="54" readonly  onFocus="startCalc();" onBlur="stopCalc();"/>
</div>
<div class="form-group">
<label for="besar_angsur">Angsuran</label>
  <input type="text" class="form-control" name="besar_angsur" value="<?php echo $jio['besar_angsuran'];?>" id="besar_angsuran" size="54" readonly />
</div>
<div class="form-group">
<label for="sisa_pinjam">Angsuran Ke</label>
  <input type="text" class="form-control" name="angsuran_ke" value="<?php echo $jio['sisa_angsuran']+1;?>" id="angsuran_ke" size="54" />
</div>
<?php 	
$kk=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * from t_pinjam where kode_pinjam='$kodep' and kode_anggota='$kode'"));$tempo=$kk['tgl_tempo'];$dat=date("Y-m-d");
if($dat>$tempo)
{
	$go=round($telat=((abs(strtotime($dat)-strtotime($tempo)))/(60*60*24))); $denda=$go * 1000;?>
	<div class="form-group">
	<label for="sisa_pinjam">Denda</label>
	  <input type="text" class="form-control" name="denda" value="<?php echo $denda; ?>" readonly>
	</div>
<?php }
else
{ ?>
	<div class="form-group">
	
	  <input type="hidden" class="form-control" name="denda" value="0">
	</div>
<?php }
?>
<div class="form-group">
<label for="user_entri">User Entri</label>
  <input type="text" class="form-control" name="u_entry" size="54" value="<?php session_start(); echo $_SESSION['kopname'];?>" readonly>
</div>
<div class="form-group">
<label for="tgl_entri">Tanggal Angsur</label>
  <input type="text" class="form-control" name="tgl_entri" size="54" value="<?php echo date("Y-m-d");?>" readonly/>
</div>
<button class="btn btn-danger"><span class='glyphicon glyphicon-share'></span> Angsur</button>
</form>

</div>
</div>
</div><?php
	}
else if($aksi=='pinjamangsur')
{ $kode=$_GET['kode_anggota']; $anggota=mysqli_fetch_array(mysqli_query($koneksi,"SELECT nama_anggota from t_anggota where kode_anggota='$kode'")); ?>
	<div class="row mt">
  <div class="col-lg-12">
     <div class="form-panel">
        <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Transaksi <?php echo $anggota['nama_anggota'];?>
        <?php
			           $am=mysqli_query($koneksi,"select*from t_pinjam where kode_anggota='$kode'");
                        $jum=mysqli_num_rows($am);
                    echo'<kbd style="background-color:#d9534f;">'.$jum.'</kbd>';?>
        <span style="float:right;">
        <?php 
			/*echo '<a href=index.php?pilih=2.1&aksi=pinjam&kode_anggota='.$kode.' class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Pinjaman</a> ';*/
		$df=mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM t_pinjam where kode_anggota='$kode' order by kode_pinjam desc"));$op=mysqli_num_rows($df);
        if($df['status']=='belum lunas')
        {
        	echo '<a href="href=index.php?pilih=2.1&aksi=pinjam" disabled="disabled" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Pinjaman</a> ';
        }
        else if($df['status']=='lunas')
        {
        	echo '<a href=index.php?pilih=2.1&aksi=pinjam&kode_anggota='.$kode.' class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Pinjaman</a> ';
        } 
        else if($op<=0)
        {
        	echo '<a href=index.php?pilih=2.1&aksi=pinjam&kode_anggota='.$kode.' class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Pinjaman</a> ';
        }
		?>
		
                    </span></h4>
<form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode Pinjam</a></th>
			 <th><a href="#">Tangggal Pinjam</a></th>
             <th><a href="#">Jenis Pinjam</a></th>
             <th><a href="#">Besar Pinjam</a></th>
             <th><a href="#">Lama Angsuran</a></th>
             <th><a href="#">Jatuh Tempo</a></th>
             <th><a href="#">Status</a></th>
			 <th><a href="#">Aksi</a></th>
		</tr>
    </thead>
    <tbody>
    <?php $sql=mysqli_query($koneksi,"SELECT * from t_pinjam where kode_anggota='$kode' order by kode_pinjam desc");
    $nomer=1;
    while($data=mysqli_fetch_array($sql))
    	{
    		$kd_a=$data['kode_anggota'];
    		$kd_j=$data['kode_jenis_pinjam'];
    		$jenis=mysqli_fetch_array(mysqli_query($koneksi,"SELECT nama_pinjaman from t_jenis_pinjam where kode_jenis_pinjam='$kd_j'"));
    		echo'<tr>
    		<td>'.$nomer.'</td>
			<td>'.$kd_p=$data['kode_pinjam'].'</td>
			<td>'.$data['tgl_entri'].'</td>
			<td>'.$jenis['nama_pinjaman'].'</td>
			<td>'.number_format($data['besar_pinjam']).'</td>
			<td>';echo $data['sisa_angsuran'].' Bulan Dari '.$data['lama_angsuran']; echo ' Bulan</td>
			<td>'.$data['tgl_tempo'].'</td>
			<td>'.$data['status'].'</td>
			<td align="center">
			<a class="btn btn-primary btn-xs" href=index.php?pilih=3.3&aksi=show&kode_anggota='.$data['kode_anggota'].'&kode_pinjam='.$data['kode_pinjam'].'>View</a> ';
			$dfo=mysqli_num_rows(mysqli_query($koneksi,"SELECT *from t_angsur where kode_pinjam='$kd_p' and kode_anggota='$kode'"));
			if($_SESSION['level']=='admin') {
				if($dfo==$data['lama_angsuran'])
				{
					echo '<a class="btn btn-warning btn-xs" disabled="disabled">Angsur</a>';
				}
				else
				{
					echo '<a class="btn btn-warning btn-xs" href=index.php?pilih=2.1&aksi=angsur&kode_anggota='.$data['kode_anggota'].'&kode_pinjam='.$data['kode_pinjam'].'>Angsur</a>';
				}
			}
			echo '</td>
        </tr>';
    	$nomer++;}?> 
	</tbody>   
	</table></form></div></div></div>
</div>

<?php }
elseif($aksi=='simpanananggota'){
	$kode=$_GET['kode_anggota'];
	$q=mysqli_query($koneksi,"SELECT *from t_anggota where kode_anggota='$kode'");
	$ang=mysqli_fetch_array($q); 
?>

<div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                    <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Laporan Simpanan Anggota "<?php echo $ang['nama_anggota'];?>" 
                    <?php
                        $am=mysqli_query($koneksi,"SELECT * FROM t_simpan where kode_anggota='$kode'");
                        $jum=mysqli_num_rows($am);
                    echo'<kbd style="background-color:#d9534f;">'.$jum.'</kbd>';?>
                    <span style="float:right;">
<?php
session_start();
if($_SESSION['level']=='admin'){ 
	echo '<a class="btn btn-success" href="index.php?pilih=2.1&aksi=simpan&kode_anggota='.$kode.'"><i class="glyphicon glyphicon-link"></i> Tambah</a> ';
	
	$jenis=mysqli_query($koneksi,"SELECT*FROM t_jenis_simpan");
	$no=1;
	/*while($verida=mysqli_fetch_array($jenis))
	{ 
	 if($verida['nama_simpanan']=='wajib')
	 {
		$baru=mysqli_fetch_array(mysqli_query($koneksi,"SELECT *FROM t_simpan where kode_anggota='$kode' and jenis_simpan='wajib' order by kode_simpan desc "));$numrow=mysqli_num_rows($baru);
		$data=$baru['tgl_mulai'];
		$now=date("Y-m-d");
		if($data==$now)
		{
			echo '<a class="btn btn-danger" href="index.php?pilih=2.1&aksi=simpan&kode_anggota='.$kode.'&kode_jenis_simpan='.$verida['kode_jenis_simpan'].'"><i class="fa fa-warning"></i> Wajib '.$data.'</a> ';
		}
		else if($data<$now)
		{
			echo '<a class="btn btn-danger" href="index.php?pilih=2.1&aksi=simpan&kode_anggota='.$kode.'&kode_jenis_simpan='.$verida['kode_jenis_simpan'].'"><i class="fa fa-warning"></i> Wajib '.$data.'</a> ';
		}
		else if($data>$now)
		{
			echo '<a class="btn btn-danger" disabled="disabled" href="index.php?pilih=2.1&aksi=simpan&kode_anggota='.$kode.'&kode_jenis_simpan='.$verida['kode_jenis_simpan'].'"><i class="fa fa-warning"></i> Wajib '.$data.'</a> ';
		}
	 }
	 else if($verida['nama_simpanan']=='sukarela')
	 {
		echo '<a class="btn btn-success" href="index.php?pilih=2.1&aksi=simpan&kode_anggota='.$kode.'&kode_jenis_simpan='.$verida['kode_jenis_simpan'].'"><i class="glyphicon glyphicon-link"></i> Sukarela</a> ';
	 } 
	 $no++;
	}*/
}
?>
<a href="laporan/print_show_simpanan.php?kode=<?php echo $ang['kode_anggota'];?>" target="_blank" class="btn btn-primary"><span class='glyphicon glyphicon-print'></span> Print</a> 
                    </span></h4>
<form class="form-inline" role="form">
  <table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th rowspan="2"><a href="#">No</a></th>
             <th><a href="#">Tanggal Simpan</a></th>
             <th><a href="#">Nama Simpanan</a></th>
			 <th><a href="#">Besar Simpanan</a></th>
       	</tr>
    </thead>
<?php
$query = mysqli_query($koneksi,"SELECT * from t_simpan where kode_anggota='$kode'order by kode_simpan desc");
	echo '<tbody>';	
	$no=1;
	while($data=mysqli_fetch_array($query)){
?>
    	<tr>
			<td><?php echo $no?></td>
			<td><?php echo Tgl($data['tgl_entri']);?></td>
			<td><?php echo $data['jenis_simpan'];?></td>
            <td>Rp. <?php echo Rp($data['besar_simpanan']);?></td>
        </tr> 
<?php
	$no++;}
?>
<tr  class="info"><td colspan="3" align="center">Total</td>
  <td>Rp. <?php $bu=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(besar_simpanan) as besar_simpan from t_simpan where kode_anggota='$kode'")); echo Rp($bu['besar_simpan']);
  echo '</td>';?>
</tr>
</tbody>   
</table>
</div>
</div>
</div>
<?php
}
?>
