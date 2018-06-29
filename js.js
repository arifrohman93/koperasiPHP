	var xmlhttp1 = createRequestObject();
	var xmlhttp2 = createRequestObject();
	var xmlhttp3 = createRequestObject();
	var xmlhttp4 = createRequestObject();
	var xmlhttp5 = createRequestObject();
	var xmlhttp6 = createRequestObject();
	var xmlhttp7 = createRequestObject();
	var xmlhttp8 = createRequestObject();
	
	function createRequestObject(){
		var ro;
		var browser = navigator.appName;
		if (browser == "Microsoft Internet Explorer"){
			ro = new ActiveXObject("Microsoft.XMLHTTP");
		}else{
			ro = new XMLHttpRequest();
		}
		return ro;
	}
	
	function getnama(){
		var kode = document.getElementById("no_anggota").value;
		if (!kode) return;
		xmlhttp1.open('get', 'getdata.php?no=' + kode + '&ambil=nama', true);
		xmlhttp1.onreadystatechange = function(){
			if ((xmlhttp1.readyState == 4) && (xmlhttp1.status == 200)){
				document.getElementById("nama").innerHTML = xmlhttp1.responseText;
			}
			return false;
		}
		xmlhttp1.send(null);
	}	
	function getphoto(){
		var kode = document.getElementById("no_anggota").value;
		if (!kode) return;
		xmlhttp2.open('get', 'getdata.php?no=' + kode +'&ambil=photo', true);
		xmlhttp2.onreadystatechange = function(){
			if ((xmlhttp2.readyState == 4) && (xmlhttp2.status == 200)){
				document.getElementById("photo").innerHTML = xmlhttp2.responseText;
			}
			return false;
		}
		xmlhttp2.send(null);	
	}	
	
	function getjumangsur(){
		var kode = document.getElementById("no_anggota").value;
		var ktp = document.getElementById("kd_trans_pinjam").value;
		if (!kode) return;
		xmlhttp3.open('get', 'getdata.php?no=' + kode +'&ktp='+ ktp +'&ambil=jumlah_angsur', true);
		xmlhttp3.onreadystatechange = function(){
			if ((xmlhttp3.readyState == 4) && (xmlhttp3.status == 200)){
				document.getElementById("jumlah_angsur").innerHTML = xmlhttp3.responseText;
			}
			return false;
		}
		xmlhttp3.send(null);	
	}	
	
	function getsisaangsur(){
		var kode = document.getElementById("no_anggota").value;
		var ktp = document.getElementById("kd_trans_pinjam").value;
		if (!kode) return;
		xmlhttp4.open('get', 'getdata.php?no=' + kode +'&ambil=angsur_ke&ktp=' + ktp , true);
		xmlhttp4.onreadystatechange = function(){
			if ((xmlhttp4.readyState == 4) && (xmlhttp4.status == 200)){
				document.getElementById("angsur_ke").innerHTML = xmlhttp4.responseText;
			}
			return false;
		}
		xmlhttp4.send(null);	
	}	
	
	function getbesarangsur(){		
		var kode = document.getElementById("no_anggota").value;
		if (!kode) return;
		xmlhttp5.open('get', 'getdata.php?no=' + kode +'&ambil=besar_angsur', true);
		xmlhttp5.onreadystatechange = function(){
			if ((xmlhttp5.readyState == 4) && (xmlhttp5.status == 200)){
				document.getElementById("besar_angsur").innerHTML = xmlhttp5.responseText;
			}
			return false;
		}
		xmlhttp5.send(null);	
	}
	function getBesarSaldo(){
		clearPinjam();
		var kode = document.getElementById("no_anggota").value;
		var jns = document.getElementById("pinjam_dari").value;
		if(jns == 3){
			document.getElementById("jum_angsur").style.background="#FFFFCC";
			document.getElementById("jangka_waktu").style.background="#FFFFCC";			
		}else{
			document.getElementById("jum_angsur").style.background="#FFFFFF";
			document.getElementById("jangka_waktu").style.background="#FFFFFF";
		}
		if (!kode) return;
		xmlhttp6.open('get', 'getdata.php?no=' + kode +'&jns='+ jns +'&ambil=besar_saldo', true);		
		xmlhttp6.onreadystatechange = function(){
			if ((xmlhttp6.readyState == 4) && (xmlhttp6.status == 200)){
				document.getElementById("besar_saldo").innerHTML = xmlhttp6.responseText;
			}
			return false;
		}
		xmlhttp6.send(null);	
	}
	function getBesarSaldo2(){
		var kodes = document.getElementById("no_anggota").value;
		var jnss = document.getElementById("jns_simpan").value;
		if (!kodes) return alert("No anggota harus isi!!");
		xmlhttp8.open('get', 'getdata.php?no=' + kodes +'&jns='+ jnss +'&ambil=besar_saldo', true);		
		xmlhttp8.onreadystatechange = function(){
			if ((xmlhttp8.readyState == 4) && (xmlhttp8.status == 200)){
				document.getElementById("besar_saldo").innerHTML = xmlhttp8.responseText;
			}
			return false;
		}
		xmlhttp8.send(null);	
	}
	function getBesarSimpanWajib(){
		var kode = document.getElementById("jns_simpan").value;
		if (!kode) return;
		xmlhttp7.open('get', 'getdata.php?no=' + kode + '&ambil=besarSimpanWajib', true);
		xmlhttp7.onreadystatechange = function(){
			if ((xmlhttp7.readyState == 4) && (xmlhttp7.status == 200)){
				document.getElementById("besar_simpan").innerHTML = xmlhttp7.responseText;
			}
			return false;
		}
		xmlhttp7.send(null);
	}
	function getSimpan(){
		getBesarSaldo2();
		getBesarSimpanWajib();
	}
	function getNamaPhoto(){
		getphoto();		
		getnama();
		return false;	
	}
	function getNamaPhotoAngsur(){
		var a = document.getElementById("kd_trans_pinjam").value;
		if(!a){ 
			alert("Anda tidak memiliki pinjaman!");
			return false;
		}else{
			getphoto();		
			getnama();
			getjumangsur();
			getsisaangsur();
			getbesarangsur();	
			return false;	
		}
	}
		
	function validPinjam(){
		var jns				= document.getElementById("pinjam_dari").value;
		var saldo 			= document.getElementById("besar_saldos").value;
		var pinjam			= document.getElementById('besar_pinjam').value;		
		if(jns == 2){
			if(saldo - pinjam < 0 ){
				if(confirm("Maaf! saldo tidak mencukupi! Apakah anda ingin meminjam pada koperasi?") == false ) 
				{
					document.getElementById('besar_pinjam').value= "";
					document.getElementById('besar_pinjam').focus();
					return; 
				}				
			}
		}else{
			if(saldo - pinjam < 0 ){
				clearPinjam();	
				alert("Maaf, saldo simpanan Sukarela anda tidak mencukupi!");
				return;
			}			
		}	
		if(!pinjam || !Number (pinjam) || pinjam < 1 ){ 
			document.getElementById('besar_pinjam').value= "";
			document.getElementById('besar_pinjam').focus();
			alert("Besar pinjaman belum diisi!") ;
			return false;
		}
	}
	function getangsur(){
		var pinjam			= document.getElementById('besar_pinjam').value;
		var jum_angsur		= document.getElementById('jum_angsur').value;
		if(!jum_angsur || !Number (jum_angsur) || jum_angsur < 1){ 
			document.getElementById('jum_angsur').value="";
			document.getElementById('jum_angsur').focus();
			document.getElementById('besar_angsur').value="";
			alert("Jumlah angsur belum diisi!") ;
			return false;
		}if(pinjam - jum_angsur < 0){
			alert("Jumlah angsur harus lebih kecil dari Besar Pinjaman!!");	
			return false;
		}
		
		if(!jum_angsur){
			document.getElementById("besar_angsur").value = "";
		}else{
			var hasil = Math.ceil(pinjam/jum_angsur);
			document.getElementById("besar_angsur").value = hasil;
		}
	}
	function cekBagi()
	{
		var pinjam			= document.getElementById('besar_pinjam').value;
		var jum_angsur		= document.getElementById('jum_angsur').value;
		if(!jum_angsur){
			document.getElementById("besar_angsur").value = "";
		}else{
			var hasil = Math.ceil(pinjam/jum_angsur);
			document.getElementById("besar_angsur").value = hasil;
		}
	}
	
	function clearPinjam(){
		document.getElementById("besar_angsur").value = "";
		document.getElementById("besar_pinjam").value = "";
		document.getElementById('jum_angsur').value = "";
		
	}
	function cekLengkapPinjam(){
		a = document.getElementById("namas").value;
		b = document.getElementById("jns_pinjam").value;
		c = document.getElementById("pinjam_dari").value;
		d = document.getElementById("besar_angsur").value;
		e = document.getElementById("jangka_waktu").value;
		f = document.getElementById("jum_angsur").value;
		if(!a){
			document.getElementById("namas").focus();
			alert("Nama Peminjam tidak diketahui!!");
			return false;
		}
		if(!b){
			document.getElementById("jns_pinjam").focus();
			alert("Jenis Pinjaman tidak diketahui!!");
			return false;
		}
		if(!c){
			document.getElementById("pinjam_dari").focus();
			alert("Sumber pinjaman tidak diketahui!!");
			return false;
		}else if(c == 3){
			var saldo 			= document.getElementById("besar_saldos").value;
			var pinjam			= document.getElementById('besar_pinjam').value;
			if(saldo - pinjam <0){
				clearPinjam();
				alert("Maaf, saldo anda tidak mencukupi!!");
				return false;	
			}
		}else{
			if(!d || !Number (d) || d < 1){
				document.getElementById("jum_angsur").focus();
				alert("Besar angsur belum diisi!!");
				return false;
			}
			if(!e || !Number (e)|| e < 1){
				document.getElementById("jangka_waktu").focus();
				alert("Jangka Waktu Pembayaran tidak diketahui!!");
				return false;
			}
		}
		return true;
	}
	function cekLengkapSimpan(){
		a = document.getElementById("namas").value;
		b = document.getElementById("jns_simpan").value;
		c = document.getElementById('besar').value;
		if(!a){
			alert("Nama belum terisi!!");
			return false;
		}if(!b){
			alert("Jenis Simpanan belum terisi!!");
			return false;
		}if(!c || !Number (c) || c < 1){
			alert("Besar simpanan belum terisi!!");
			return false;
		}		
	}
	function cekAngsur(){
		 var a = document.getElementById("kd_trans_pinjam").value;
		 var b = document.getElementById("namas").value;
		 if(!a){ 
		 	alert("Anda tidak memiliki pinjaman!");
			return false;
		 }
		 if(!b){ 
		 	alert("Data Angsur belum lengkap!!");
			return false;
		 }
		 
		 
	}
	function textOtomatis(f, tinggiMaksimal) {
		// set untuk tinggi maksimal textarea
		var tinggiMaksimal = (typeof tinggiMaksimal == 'undefined') ? 1000 : tinggiMaksimal;
		// pencegahan jika tinggi = tinggi minimal yang ditentukan
		// maka textarea tidak akan berubah tingginya
		if (f.scrollHeight > tinggiMaksimal) {
			if (f.style.overflowY != 'scroll') { f.style.overflowY = 'scroll' }
			return;
		}
		// agar scroller bar tidak nampak
		if (f.style.overflowY != 'hidden') { f.style.overflowY = 'hidden' }
	
		var scrollH = f.scrollHeight;
		if( scrollH > f.style.height.replace(/[^0-9]/g,'') ){
			f.style.height = scrollH+'px';
		}
	}
	function cekProfil()
	{
		var v = document.getElementById("visi").value;
		var m = document.getElementById("misi").value;
		var s = document.getElementById("status").value;
		if(!v){
			alert("Visi belum diisi!!");
			return false;
		}if(!m){
			alert("Misi belum diisi!!");
			return false;
		}if(!s){
			alert("Status belum diisi");
			return false;
		}
		return true;
	}
	