<?php include("koneksi.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="datepicker/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="timepicker/jquery.timepicker.min.css" />
<script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
<script type="text/javascript" src="combo_bertingkat/jquery.js"></script>
<script src="datepicker/jquery-ui.js"></script>
<script type="text/javascript" src="timepicker/jquery.timepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#tanggal').datepicker({
			dateFormat : "dd/mm/yy",
			changeMonth : true,
			changeYear : true
			});
		$('#waktu_mulai').timepicker({ timeFormat: 'HH:mm', interval: 15 });
		$('#waktu_selesai').timepicker({ timeFormat: 'HH:mm', interval: 15 });
		$("#penanggungjawab").change(function(){
		var penanggungjawab = $("#penanggungjawab").val();
		$.ajax({
		url: "combo_bertingkat/ambilnotulen.php",
		data: "penanggungjawab="+penanggungjawab,
		cache: false,
		success: function(msg){
		$("#notulen").html(msg);
		}
		});
		});
		$("#notulen").change(function(){
		var penanggungjawab = $("#penanggungjawab").val();
		var notulen = $("#notulen").val();
		var nomor = $("#nosurat").val();
		$.ajax({
		url: "combo_bertingkat/ambilpeserta2.php",
		data: {penanggungjawab,notulen,nomor},
		cache: false,
		success: function(msg){
		$("#psrapat").html(msg);
		}
		});
		});
		});
		function validator(){
			if (form1.penanggungjawab.value == 'Penanggung Jawab'){
			   alert("Pilih Penanggungjawab Rapat");
			   form1.penanggungjawab.focus();
			   return (false);
			}
			if (form1.notulen.value == 'Notulen'){
			   alert("Pilih Notulen Rapat");
			   form1.notulen.focus();
			   return (false);
			}
			var checkboxs=document.getElementsByName("peserta[]");
    		var okay=false;
    		for(var i=0,l=checkboxs.length;i<l;i++){
		        if(checkboxs[i].checked){
		            okay=true;
            		break;
        		}
    		}
    		if(!okay){
				alert("Pilih Peserta Rapat");
				return (false);
			}
    		if(!form1.verifikasi.checked){
		    	alert("Centang Dulu Verifikasi Undangan Rapat");
				return (false);
        	}
			return (true);
        }
</script>
<style type="text/css">
<!--
.combobackground { background-color: rgba(255, 255, 255, 0.5); }
.style2 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
</head>
<body>
<style type="text/css">
  input[type="text"] {
    border: 0;
	padding-left: 10px;
	font:Arial, Helvetica, sans-serif;
	font-size:20px;
	background-color: rgba(255, 255, 255, 0.5);
  }
</style>
<style>
/**
 * Facebook - Special Edition
 */
.button.facebook {
	font:Arial, Helvetica, sans-serif;
	padding-right: 10px;
	padding-left: 10px;
	font-size:18px;
    background: #99b6df;
    background: -webkit-gradient(linear, 0 0, 0 bottom, from(#99b6df), to(#638ec8));
    background: -moz-linear-gradient(#99b6df, #638ec8);
    background: linear-gradient(#99b6df, #638ec8);
    border: solid 1px #6d94ce;
    border-bottom: solid 3px #3867ac;
    color: #fff;
    text-shadow: 0 1px 0 #3c61ab; }
    
.button.facebook:hover {
    background: #638ec8;
    background: -webkit-gradient(linear, 0 0, 0 bottom, from(#638ec8), to(#99b6df));
    background: -moz-linear-gradient(#638ec8, #99b6df);
    background: linear-gradient(#638ec8, #99b6df);
    border: solid 1px #6d94ce;
    border-bottom: solid 3px #3867ac;}
    
.button.facebook:active {
    background: #638ec8;
    background: -webkit-gradient(linear, 0 0, 0 bottom, from(#638ec8), to(#99b6df));
    background: -moz-linear-gradient(#638ec8, #99b6df);
    background: linear-gradient(#638ec8, #99b6df);
    border: solid 1px #6d94ce;
    box-shadow: inset 0 10px 15px 0 #4176c4; }
</style>
<style>
select {
	margin-left: 2px;
    background-color: rgba(255, 255, 255, 0.5);
    width: 312px;
    padding-left: 10px;
    font-size: 18px;
    border: 0px solid #ccc;
    height: 30px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
select:invalid { color: #6B7373; }
</style>
<br />
<br />
<?php
$r = mysql_query("select * from rapat where no_surat = '".$_GET['konf']."'");
$hasil = mysql_fetch_array($r);
$nomor = $hasil['no_surat'];
$hal = $hasil['hal'];
$tgl = $hasil['tanggal'];
$tmpt = $hasil['tempat'];
$w_mulai = $hasil['waktu_mulai'];
$w_selesai = $hasil['waktu_selesai'];
$pmbhs = $hasil['pembahasan_rapat'];
?>
<form name="form1" id="form1" method="post" action="" onsubmit="return validator()">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="49%" rowspan="2" valign="top"><table width="378" border="0" cellspacing="0" cellpadding="0">
      <tr height="30">
        <td width="31">&nbsp;</td>
        <td width="347"><span class="style2">&nbsp;No. Surat :</span> 
		</br>
            <input name="nosurat" id="nosurat" type="text" placeholder="Nomor Surat" size="30" oninvalid="this.setCustomValidity('Isikan Nomor Surat')" oninput="setCustomValidity('')" value="<?php echo $_GET['konf'];?>" required/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="30">
        <td width="10">&nbsp;</td>
        <td><span class="style2">&nbsp;Hal :</span> 
		</br>
            <input name="hal" type="text" placeholder="Hal" size="30" oninvalid="this.setCustomValidity('Isikan Hal Surat')" oninput="setCustomValidity('')" value="<?php echo $hal; ?>" required/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="30">
        <td width="10">&nbsp;</td>
        <td><span class="style2">&nbsp;Tanggal Rapat :</span> 
		</br>
            <input name="tanggal" type="text" placeholder="Hari Tanggal" size="30" id="tanggal" oninvalid="this.setCustomValidity('Pilih Tanggal Rapat')" onchange="setCustomValidity('')" value="<?php echo $tgl; ?>" required/>
			<div style="position:relative; width:0px; height:0px; z-index:1; left: 280px; top: -26px;"><img src="image/tgl.png" width="28" height="25" /></div>
		</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="30">
        <td width="10">&nbsp;</td>
        <td><span class="style2">&nbsp;Tempat Rapat :</span> 
		</br>
            </br>
            <input name="tempat" type="text" placeholder="Tempat Rapat" size="30" oninvalid="this.setCustomValidity('Isikan Tempat Rapat')" oninput="setCustomValidity('')" value="<?php echo $tmpt; ?>" required/>
			<div style="position:relative; width:0px; height:0px; z-index:1; left: 285px; top: -27px;"><img src="image/tempat.png" width="22" height="28" /></div>
		</td>
      </tr>
      
