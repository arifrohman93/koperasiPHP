<?php
	function kode($tabel, $initial){
		$struct = mysqli_query($koneksi,"SELECT * FROM $tabel");
		$field  = mysqli_field_name($struct,0);
		$len    = mysqli_field_len($struct,0);
		
		$qry = mysqli_query($koneksi,"SELECT max(".$field.")FROM ".$tabel);
		$row = mysqli_fetch_array($qry);
		
		if($row[0]==""){
		   $angka=0;
		}
		else{
			$angka = substr($row[0],strlen($initial));   
		}
		
		$angka++;
		$angka =strval($angka);
		$tmp="";
		for($i=1; $i<=($len-strlen($initial)-strlen($angka)); $i++) {
			$tmp=$tmp."0";
		}
		return $initial.$tmp.$angka;
	}
	

 
	function nomer($koneksi,$initial,$field,$table){
		$script = "SELECT $field FROM $table ORDER BY $field DESC LIMIT 1 ";
		$sql=mysqli_query($koneksi,$script) or trigger_error($koneksi->error."[ $script]");;
		$d=mysqli_num_rows($sql);
		
		if($d>0){
			$r=mysqli_fetch_array($sql);
			$d=$r[$field];
			$str=substr($d,1,4);
			$No_Urut =(int)$str;
		}else{
			$No_Urut = 0;
		}
		
		$No_Urut++;
		$Nol="";
		$nilai=4-strlen($No_Urut);
		for ($i=1;$i<=$nilai;$i++){
			$Nol= $Nol."0";
		}
		
		$Kode = $initial.$Nol.$No_Urut;
		return $Kode;
	}

	function formatTanggal($date=null)
	{
		$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
		'September','Oktober', 'November','Desember');
		
		if($date == null) {
			$hari = $array_hari[date('N')];
			$tanggal = date ('j');
			$bulan = $array_bulan[date('n')];
			$tahun = date('Y');
		}else{
			$date = strtotime($date);
			$hari = $array_hari[date('N',$date)];
			$tanggal = date ('j', $date);
			$bulan = $array_bulan[date('n',$date)];
			$tahun = date('Y',$date);
		}
		$formatTanggal = $hari . ", " . $tanggal ." ". $bulan ." ". $tahun;
		return $formatTanggal;
	}
	
	function DateToIndo($date){  
        $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
		'September','Oktober', 'November','Desember');
      
        $date = strtotime($date);
		$tanggal = date ('j', $date);
		$bulan = $array_bulan[date('n',$date)];
		$tahun = date('Y',$date); 
          
        $result = $tanggal ." ". $bulan ." ". $tahun;       
        return($result);  
	}  
	
	function Indo($tgl){
		$kata[] = substr($tgl,8,2);
		$kata[] = substr($tgl,5,2);
		$kata[] = substr($tgl,0,4);
		$hasil	= implode("-",$kata);
		return $hasil;//$tanggal.' '.$bulan.' '.$tahun;
   }
	function Tgl($str){
		$bln = explode(" ","Januari Februari Maret April Mei Juni Juli Agsustus September Oktober November Desember");
		$tgl = explode("-",$str);
		
		if($tgl[1] < 10 ) $tgl[1] = substr($tgl[1],1,1);
		//else $tgl[1] = $tgl[1];
		return $tgl[2]." ".$bln[($tgl[1]-1)]." ".$tgl[0];
		//return $tgl[1];
	}
	function Rp($str)
	{
		$jum = strlen($str);
		$jumtitik = ceil($jum/3);
		$balik = strrev($str);
		
		$awal = 0;
		$akhir = 3;
		for($x=0;$x<$jumtitik;$x++){
			$a[$x] = substr($balik,$awal,$akhir).".";	
			$awal+=3;
		}
		$hasil = implode($a);
		$hasilakhir = strrev($hasil);
		$hasilakhir = substr($hasilakhir,1,$jum+$jumtitik);
					
		return $hasilakhir."";
	}

	class angkaTerbilang {
		function baca($n) {
			$this->dasar = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam','tujuh', 'delapan', 'sembilan');
			$this->angka = array(1000000000, 1000000, 1000, 100, 10, 1);
			$this->satuan = array('milyar', 'juta', 'ribu', 'ratus', 'puluh', '');
			
			$i = 0;
			if($n==0){
				$str = "nol";
			}else{
				while ($n != 0) {
					$count = (int)($n/$this->angka[$i]);
					if ($count >= 10) {
						$str .= $this->baca($count). " ".$this->satuan[$i]." ";
					}else if($count > 0 && $count < 10){
						$str .= $this->dasar[$count] . " ".$this->satuan[$i]." ";
					}
				$n -= $this->angka[$i] * $count;
				$i++;
				}
			$str = preg_replace("/satu puluh (\w+)/i", "\\1 belas", $str);
			$str = preg_replace("/satu (ribu|ratus|puluh|belas)/i", "se\\1", $str);
			}
		return $str;
		}
	}
	// outputnya adalah seratus dua puluh tiga juta empat ratus lima puluh enam ribu tujuh ratus delapan puluh sembilan
?>