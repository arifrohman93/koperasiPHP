<?php 
	include "config/koneksi.php";
	include "fungsi/fungsi.php";
  $aksi=$_GET['aksi'];
?>
<head>
<script src="jquery.js"></script>

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
if(empty($aksi))
{
    $ghu=mysqli_query($koneksi,"SELECT * FROM t_tabungan");
$no=1;
while($dataku=mysqli_fetch_array($ghu))
{
  $fgh=$dataku['tgl_mulai'];$tang=date("Y-m-d");$kode_tab=$dataku['kode_tabungan'];
  $tempo=date('Y-m-d',strtotime('+30 day',strtotime($fgh)));
  if($tempo==$tang)
  {
    $total=$dataku['besar_tabungan']+10000;
    $tol=mysqli_query($koneksi,"UPDATE t_tabungan set tgl_mulai='$tang',besar_tabungan='$total' where kode_tabungan='$kode_tab'");
  }
  else
  {
    
  }
  $no++;
}
?>
<script language="javascript" type="text/javascript" src="js/niceforms.js"></script>
<script language="javascript" type="text/javascript" src="js/validasi.js"></script>
<link rel="stylesheet" type="text/css" href="css/theme1.css" />

</head>
<body>  
<div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Data Tabungan
     <?php
      $am=mysqli_query($koneksi,"select*from t_tabungan");
        $jum=mysqli_num_rows($am);
         echo'<kbd style="background-color:#d9534f;">'.$jum.'</kbd>';?> 
         <span style="float:right;"><input type="text" id="cari" style="width:230px;height:30px;font-size:15px;" placeholder=" cari disini...">
                    
<a href="laporan/print_tabungan.php" target="_blank" class="btn btn-primary"><span class='glyphicon glyphicon-print'></span> Print</a> 
                    </span>
  </h4>
<form class="form-inline" role="form">
<table class="table table-bordered table-striped table-condensed">
    <thead>
		<tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode Tabungan</a></th>
             <th><a href="#">Kode Anggota</a></th>
             <th><a href="#">Nama Anggota</a></th>
             <th><a href="#">Investasi (1 bulan)</a></th>
             <th><a href="#">Jumlah Saldo</a></th>
              <th><a href="#">Aksi</a></th>
       	</tr>
		
    </thead><tbody id="fbody">
<?php
	$query=mysqli_query($koneksi,"SELECT * FROM t_tabungan order by kode_tabungan asc");
	$no=1;
	while($data=mysqli_fetch_array($query)){
?>
    
    	<tr>
			<td><?php echo $no;?></td>
            <td><?php echo $data['kode_tabungan'];echo'</td>
            <td>';echo $d=$data['kode_anggota'];echo'</td>';
            $d=$data['kode_anggota'];$f=mysqli_fetch_array(mysqli_query($koneksi,"SELECT nama_anggota from t_anggota where Kode_anggota='$d'")); $rty=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(besar_simpanan) as total_asli from t_simpan where Kode_anggota='$d'")); $inves=$data['besar_tabungan']-$rty['total_asli'];?>
            <td><?php echo $f['nama_anggota'];?></td>
            <td><?php echo $data['tgl_mulai'];?> s/d <?php echo $tempo=date('Y-m-d',strtotime('+30 day',strtotime($data['tgl_mulai'])));?></td>
            <td>Rp. <?php echo Rp($data['besar_tabungan']);?></td> 
            <td><a class="btn btn-danger btn-xs" href="index.php?pilih=1.3&aksi=viewambil&kode_tabungan=<?php echo $data['kode_tabungan'];?>&kode_anggota=<?php echo $d;?>"><i class="fa fa-dollar"></i> Ambil Uang</a></td>
        </tr> 
	   
<?php
	$no++;} //tutup while
?>
<tr  class="info"><td colspan="5" align="center">Total</td>
  <td colspan="2">Rp. <?php $bu=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(besar_tabungan) as besar_tab from t_tabungan")); echo number_format($bu['besar_tab']);
  echo '</td>';?>
</tr></tbody></table></form></div></div></div>
<?php } 
else if($aksi=='ambiluang')
{
  $lo=$_GET['kode_tabungan'];$luy=$_GET['kode_anggota'];
?>
<div class="row mt">
     <div class="col-lg-12">
        <div class="form-panel" style="width:50%;">
            <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Ambil Uang</h4>
    <form action="anggota/proses_tabungan.php" method="get">
      <div class="form-group">
            <label>Kode Tabungan</label>
            <input type="text" name="kode_tabungan" readonly class="form-control" value="<?php echo $lo;?>">
        </div>
        <div class="form-group">
            <label>Kode Anggota</label>
            <input type="text" name="kode_anggota" class="form-control" readonly value="<?php echo $luy;?>"/>
        </div>
        <div class="form-group">
            <label>Saldo</label>
            <?php $rtyu=mysqli_fetch_array(mysqli_query($koneksi,"SELECT *FROM t_tabungan where kode_tabungan='$lo' and kode_anggota='$luy'")); ?>
            <input type="text" id="txt1" onkeyup="sum();" name="saldo" class="form-control" readonly value="<?php echo $rtyu['besar_tabungan'];?>"/>
        </div>
        <script>
        function sum() {
              var txtFirstNumberValue = document.getElementById('txt1').value;
              var txtSecondNumberValue = document.getElementById('txt2').value;
              var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
              if (!isNaN(result)) {
                 document.getElementById('txt3').value = result;
              }
              else{
                 document.getElementById('txt3').value = txtFirstNumberValue;
              }
        }
        function isNumberKey(evt)
        {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
        }
        </script>
        <div class="form-group">
            <label>Besar Pengambilan</label>
           <input type="text" id="txt2" onkeyup="sum();" onkeypress="return isNumberKey(event)" name="besar_ambil" class="form-control"/>
        </div>
        <div class="form-group">
            <label>Sisa Saldo</label>
           <input type="text" id="txt3" class="form-control" readonly />
        </div>
        <button class="btn btn-danger"><span class='glyphicon glyphicon-check'></span> Ambil Uang</button>
          </form>

</div>
</div>
</div>

<?php }
else if($aksi=='viewambil')
{ $lo=$_GET['kode_tabungan'];$luy=$_GET['kode_anggota'];$nama=mysqli_fetch_array(mysqli_query($koneksi,"SELECT nama_anggota from t_anggota where Kode_anggota='$luy'")); ?>
 <div class="row mt">
 <div class="col-lg-12">
  <div class="form-panel">
   <h4 class="mb"><span class='glyphicon glyphicon-briefcase'></span> Data Pengambilan Uang "<?php echo $nama['nama_anggota']; ?>" </span>
                   
   <span style="float:right;">
<form action="anggota/proses_tabungan.php" method="get">
<input type="hidden" value="<?php echo $lo; ?>" name="kode_tabungan"> <input type="hidden" value="<?php echo $luy; ?>" name="kode_anggota"> 
<?php $rtyu=mysqli_fetch_array(mysqli_query($koneksi,"SELECT *FROM t_tabungan where kode_tabungan='$lo' and kode_anggota='$luy'")); ?>
<input type="text" style="width:150px;height:30px;" readonly="readonly" id="txt1" onkeyup="sum();" name="saldo" value="<?php echo $rtyu['besar_tabungan'];?>"/>
<script>
        function sum() {
              var txtFirstNumberValue = document.getElementById('txt1').value;
              var txtSecondNumberValue = document.getElementById('txt2').value;
              var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
              if (!isNaN(result)) {
                 document.getElementById('txt3').value = result;
              }
              else{
                 document.getElementById('txt3').value = txtFirstNumberValue;
              }
        }
        function isNumberKey(evt)
        {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
        return true;
        }
</script>
       <input type="text" placeholder="ambil uang" style="width:150px;height:30px;" id="txt2" onkeyup="sum();" placeholder="" onkeypress="return isNumberKey(event)" name="besar_ambil"/>
  <input type="text" placeholder="sisa uang" style="width:150px;height:30px;" id="txt3" onkeyup="sum();" onkeypress="return isNumberKey(event)"/>
   <button class="btn btn-danger"><i class="fa fa-dollar"></i> Ambil Uang</button>
</form>
</span>
   </h4>
   <form class="form-inline" role="form">
<table class="table table-bordered table-striped table-condensed">
    <thead>
    <tr class="info">
             <th><a href="#">No</a></th>
             <th><a href="#">Kode Ambil</a></th>
             <th><a href="#">Kode Anggota</a></th>
             <th><a href="#">Nama Anggota</a></th>
             <th><a href="#">Kode Tabungan</a></th>
             <th><a href="#">Besar Ambil</a></th>
             <th><a href="#">Tanggal Ambil</a></th>
        </tr>
    
    </thead><tbody>
<?php
  $query=mysqli_query($koneksi,"SELECT * FROM t_pengambilan where kode_anggota='$luy' and kode_tabungan='$lo' order by kode_ambil desc");
  $no=1;
  while($data=mysqli_fetch_array($query)){
?>
    
      <tr>
      <td><?php echo $no;?></td>
            <td><?php echo $data['kode_ambil'];echo'</td>
            <td>';echo $d=$data['kode_anggota'];echo'</td>';
            $d=$data['kode_anggota'];$f=mysqli_fetch_array(mysqli_query($koneksi,"SELECT nama_anggota from t_anggota where Kode_anggota='$d'")); $rty=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(besar_simpanan) as total_asli from t_simpan where Kode_anggota='$d'")); $inves=$data['besar_tabungan']-$rty['total_asli'];?>
            <td><?php echo $f['nama_anggota'];?></td>
            <td><?php echo $data['kode_tabungan'];?></td>
            <td>Rp. <?php echo number_format($data['besar_ambil']);?></td>
            <td><?php echo $data['tgl_ambil'];?></td>
      </tr> 
     
<?php
  $no++;} //tutup while
?>
<tr  class="info"><td colspan="5"a align="center">Total</td>
  <td colspan="2">Rp. <?php $bu=mysqli_fetch_array(mysqli_query($koneksi,"SELECT sum(besar_ambil) as besar_ambil from t_pengambilan where kode_anggota='$luy'")); echo number_format($bu['besar_ambil']);
  echo '</td>';?>
</tr>
</tbody></table></form></div></div></div>
<?php }
 ?>
