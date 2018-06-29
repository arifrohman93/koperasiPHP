<head><title>Grafik</title>
<link rel="shortcut icon" href="../logo_kop.gif" />
</head>
<?php 
	//Include Koneksi
	include "koneksi.php";

	//Membuat Query
?>

<!-- File yang diperlukan dalam membuat chart -->
<script src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
    
<script type="text/javascript">
$(function () {
    $('#view').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Peminjaman'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Tanggal'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
		
		<?php
        $to=date('Y-m-d');
        $from1=date('Y-m-d',strtotime('-1 day',strtotime($to)));
        $from2=date('Y-m-d',strtotime('-2 day',strtotime($to)));
        $from3=date('Y-m-d',strtotime('-3 day',strtotime($to)));
        $from4=date('Y-m-d',strtotime('-4 day',strtotime($to)));
        $from5=date('Y-m-d',strtotime('-5 day',strtotime($to)));
        $from6=date('Y-m-d',strtotime('-6 day',strtotime($to)));
        $c=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_pinjam) as total_pinjam from t_pinjam WHERE tgl_entri='$to'"));
        $d=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_pinjam) as total_pinjam from t_pinjam WHERE tgl_entri='$from1'"));
        $e=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_pinjam) as total_pinjam from t_pinjam WHERE tgl_entri='$from2'"));
        $f=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_pinjam) as total_pinjam from t_pinjam WHERE tgl_entri='$from3'"));
        $g=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_pinjam) as total_pinjam from t_pinjam WHERE tgl_entri='$from4'"));
        $h=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_pinjam) as total_pinjam from t_pinjam WHERE tgl_entri='$from5'"));
        $i=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_pinjam) as total_pinjam from t_pinjam WHERE tgl_entri='$from6'"));
        $q0=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pinjam WHERE tgl_entri='$to'"));
        $q1=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pinjam WHERE tgl_entri='$from1'"));
        $q2=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pinjam WHERE tgl_entri='$from2'"));
        $q3=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pinjam WHERE tgl_entri='$from3'"));
        $q4=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pinjam WHERE tgl_entri='$from4'"));
        $q5=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pinjam WHERE tgl_entri='$from5'"));
        $q6=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pinjam WHERE tgl_entri='$from6'"));
        echo "{ name: '".$from6." (".$q6.") ',data: [".$i["total_pinjam"]."]},";
        echo "{ name: '".$from5." (".$q5.") ',data: [".$h["total_pinjam"]."]},";
        echo "{ name: '".$from4." (".$q4.") ',data: [".$g["total_pinjam"]."]},";
        echo "{ name: '".$from3." (".$q3.") ',data: [".$f["total_pinjam"]."]},";
        echo "{ name: '".$from2." (".$q2.") ',data: [".$e["total_pinjam"]."]},";
        echo "{ name: '".$from1." (".$q1.") ',data: [".$d["total_pinjam"]."]},";
        echo "{ name: '".$to." (".$q0.") ',data: [".$c["total_pinjam"]."]},";
        
        
		
		?>
		
		]
    });
});
</script>

<script type="text/javascript">
$(function () {
    $('#viewsimpan').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Simpanan'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Tanggal'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
        
        <?php
        $to=date('Y-m-d');
        $fro1=date('Y-m-d',strtotime('-1 day',strtotime($to)));
        $fro2=date('Y-m-d',strtotime('-2 day',strtotime($to)));
        $fro3=date('Y-m-d',strtotime('-3 day',strtotime($to)));
        $fro4=date('Y-m-d',strtotime('-4 day',strtotime($to)));
        $fro5=date('Y-m-d',strtotime('-5 day',strtotime($to)));
        $fro6=date('Y-m-d',strtotime('-6 day',strtotime($to)));
        $cc=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_simpanan) as total_simpan from t_simpan WHERE tgl_entri='$to'"));
        $dd=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_simpanan) as total_simpan from t_simpan WHERE tgl_entri='$fro1'"));
        $ee=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_simpanan) as total_simpan from t_simpan WHERE tgl_entri='$fro2'"));
        $ff=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_simpanan) as total_simpan from t_simpan WHERE tgl_entri='$fro3'"));
        $gg=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_simpanan) as total_simpan from t_simpan WHERE tgl_entri='$fro4'"));
        $hh=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_simpanan) as total_simpan from t_simpan WHERE tgl_entri='$fro5'"));
        $ii=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_simpanan) as total_simpan from t_simpan WHERE tgl_entri='$fro6'"));
        $w0=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_simpan WHERE tgl_entri='$to'"));
        $w1=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_simpan WHERE tgl_entri='$fro1'"));
        $w2=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_simpan WHERE tgl_entri='$fro2'"));
        $w3=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_simpan WHERE tgl_entri='$fro3'"));
        $w4=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_simpan WHERE tgl_entri='$fro4'"));
        $w5=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_simpan WHERE tgl_entri='$fro5'"));
        $w6=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_simpan WHERE tgl_entri='$fro6'"));
        
        echo "{ name: '".$fro6." (".$w6.") ',data: [".$ii["total_simpan"]."]},";
        echo "{ name: '".$fro5." (".$w5.") ',data: [".$hh["total_simpan"]."]},";
        echo "{ name: '".$fro4." (".$w4.") ',data: [".$gg["total_simpan"]."]},";
        echo "{ name: '".$fro3." (".$w3.") ',data: [".$ff["total_simpan"]."]},";
        echo "{ name: '".$fro2." (".$w2.") ',data: [".$ee["total_simpan"]."]},";
        echo "{ name: '".$fro1." (".$w1.") ',data: [".$dd["total_simpan"]."]},";
        echo "{ name: '".$to." (".$w0.") ',data: [".$cc["total_simpan"]."]},";
        
        
        
        ?>
        
        ]
    });
});
</script>
<script type="text/javascript">
$(function () {
    $('#viewangsur').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Angsuran'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Tanggal'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
        
        <?php
        $to=date('Y-m-d');
        $fr1=date('Y-m-d',strtotime('-1 day',strtotime($to)));
        $fr2=date('Y-m-d',strtotime('-2 day',strtotime($to)));
        $fr3=date('Y-m-d',strtotime('-3 day',strtotime($to)));
        $fr4=date('Y-m-d',strtotime('-4 day',strtotime($to)));
        $fr5=date('Y-m-d',strtotime('-5 day',strtotime($to)));
        $fr6=date('Y-m-d',strtotime('-6 day',strtotime($to)));
        $ccc=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_angsuran) as total_angsur from t_angsur WHERE tgl_entri='$to'"));
        $ddd=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_angsuran) as total_angsur from t_angsur WHERE tgl_entri='$fr1'"));
        $eee=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_angsuran) as total_angsur from t_angsur WHERE tgl_entri='$fr2'"));
        $fff=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_angsuran) as total_angsur from t_angsur WHERE tgl_entri='$fr3'"));
        $ggg=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_angsuran) as total_angsur from t_angsur WHERE tgl_entri='$fr4'"));
        $hhh=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_angsuran) as total_angsur from t_angsur WHERE tgl_entri='$fr5'"));
        $iii=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_angsuran) as total_angsur from t_angsur WHERE tgl_entri='$fr6'"));
        $e0=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_angsur WHERE tgl_entri='$to'"));
        $e1=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_angsur WHERE tgl_entri='$fr1'"));
        $e2=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_angsur WHERE tgl_entri='$fr2'"));
        $e3=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_angsur WHERE tgl_entri='$fr3'"));
        $e4=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_angsur WHERE tgl_entri='$fr4'"));
        $e5=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_angsur WHERE tgl_entri='$fr5'"));
        $e6=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_angsur WHERE tgl_entri='$fr6'"));
        
        echo "{ name: '".$fr6." (".$e6.") ',data: [".$iii["total_angsur"]."]},";
        echo "{ name: '".$fr5." (".$e5.") ',data: [".$hhh["total_angsur"]."]},";
        echo "{ name: '".$fr4." (".$e4.") ',data: [".$ggg["total_angsur"]."]},";
        echo "{ name: '".$fr3." (".$e3.") ',data: [".$fff["total_angsur"]."]},";
        echo "{ name: '".$fr2." (".$e2.") ',data: [".$eee["total_angsur"]."]},";
        echo "{ name: '".$fr1." (".$e1.") ',data: [".$ddd["total_angsur"]."]},";
        echo "{ name: '".$to." (".$e0.") ',data: [".$ccc["total_angsur"]."]},";
        
        
        
        ?>
        
        ]
    });
});
</script>
<script type="text/javascript">
$(function () {
    $('#viewambil').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Pengambilan Uang'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Tanggal'
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total'
            }
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [
        
        <?php
        $to=date('Y-m-d');
        $f1=date('Y-m-d',strtotime('-1 day',strtotime($to)));
        $f2=date('Y-m-d',strtotime('-2 day',strtotime($to)));
        $f3=date('Y-m-d',strtotime('-3 day',strtotime($to)));
        $f4=date('Y-m-d',strtotime('-4 day',strtotime($to)));
        $f5=date('Y-m-d',strtotime('-5 day',strtotime($to)));
        $f6=date('Y-m-d',strtotime('-6 day',strtotime($to)));
        $cccc=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_ambil) as total_ambil from t_pengambilan WHERE tgl_ambil='$to'"));
        $dddd=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_ambil) as total_ambil from t_pengambilan WHERE tgl_ambil='$f1'"));
        $eeee=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_ambil) as total_ambil from t_pengambilan WHERE tgl_ambil='$f2'"));
        $ffff=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_ambil) as total_ambil from t_pengambilan WHERE tgl_ambil='$f3'"));
        $gggg=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_ambil) as total_ambil from t_pengambilan WHERE tgl_ambil='$f4'"));
        $hhhh=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_ambil) as total_ambil from t_pengambilan WHERE tgl_ambil='$f5'"));
        $iiii=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(besar_ambil) as total_ambil from t_pengambilan WHERE tgl_ambil='$f6'"));
        $p0=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pengambilan WHERE tgl_ambil='$to'"));
        $p1=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pengambilan WHERE tgl_ambil='$f1'"));
        $p2=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pengambilan WHERE tgl_ambil='$f2'"));
        $p3=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pengambilan WHERE tgl_ambil='$f3'"));
        $p4=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pengambilan WHERE tgl_ambil='$f4'"));
        $p5=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pengambilan WHERE tgl_ambil='$f5'"));
        $p6=mysqli_num_rows(mysqli_query($koneksi,"SELECT * from t_pengambilan WHERE tgl_ambil='$f6'"));
        
        echo "{ name: '".$fr6." (".$p6.") ',data: [".$iiii["total_ambil"]."]},";
        echo "{ name: '".$fr5." (".$p5.") ',data: [".$hhhh["total_ambil"]."]},";
        echo "{ name: '".$fr4." (".$p4.") ',data: [".$gggg["total_ambil"]."]},";
        echo "{ name: '".$fr3." (".$p3.") ',data: [".$ffff["total_ambil"]."]},";
        echo "{ name: '".$fr2." (".$p2.") ',data: [".$eeee["total_ambil"]."]},";
        echo "{ name: '".$fr1." (".$p1.") ',data: [".$dddd["total_ambil"]."]},";
        echo "{ name: '".$to." (".$p0.") ',data: [".$cccc["total_ambil"]."]},";
        
        
        
        ?>
        
        ]
    });
});
</script>

<div id="view" style="border:1px solid #777;width: 49.7%; height: 500px; margin: 0 auto;float :left;"></div>  
<div id="viewsimpan" style="border:1px solid #777;width: 49.7%; height: 500px; margin: 0 auto;float :right;"></div> 
<br>
<div id="viewangsur" style="border:1px solid #777;width: 49.7%; height: 500px; margin: 0 auto;float :left;"></div> 
<div id="viewambil" style="border:1px solid #777;width: 49.7%; height: 500px; margin: 0 auto;float :right;"></div> 
<br>

