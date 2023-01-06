<?php
	function runSQL($rsql) {
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$dbname   = "caixa";
		$connect = mysql_connect($hostname,$username,$password) or die ("Error: could not connect to database");
		$db = mysql_select_db($dbname);
		$result = mysql_query($rsql) or die ('query not running'); 
		return $result;
		mysql_close($connect);
	}
	if(isset($_POST['ID'])){
	echo $_POST;
      $ID = $_POST['ID'];
      $nome = $_POST['nome'];
      $referente = $_POST['referente'];
      $data = $_POST['data'];
      $tipo = $_POST['tipo'];
      $pag_id = $_POST['pag_id'];
      $banco = $_POST['banco_nome'];
      $cheque = $_POST['numero_cheque'];
      $valor = $_POST['valor'];
      $data = date("Y-m-d");
      $caixa_id = $_POST['caixa_id'];
      $convenio = $_POST['convenio'];
      
      if ($pag_id == 1){
          $banco = "";
          $cheque = "";
      }

      if($caixa_id == 1){
          $link = "index.php";
      } elseif($caixa_id == 2){
          $link = "loja.php";
      } elseif($caixa_id == 3){
          $link = "leandro.php";
      } elseif($caixa_id == 4){
          $link = "academia.php";
      } elseif($caixa_id == 5){
          $link = "pilates.php";
      }

        //  var_dump($_POST);exit;
        if($ID){
	    if($ID){
		  $SQLUpdate = "UPDATE lc_movimento SET
						 nome = '$nome',
						 referente = '$referente',
						 data = '$data',
						 tipo = '$tipo',
						 pag_id = '$pag_id',
                                                 valor = '$valor',
                                                 banco_nome = '$banco',
                                                 numero_cheque = '$cheque',
                                                 convenio = '$convenio'
						WHERE id = '$ID'";
                 // echo $SQLUpdate;exit;
		  $query = runSQL($SQLUpdate);
		  //echo '{status:3}'; // memberikan respon nilai status = 3 ketika berhasil mengedit
                  //$link = "index.php";
                echo" <script>document.location.href='$link'</script>";
                }else{
		  $SQLInsert = "INSERT INTO tb_bon
							(tanggal,id_user,nohp,kredit,ket)
						  VALUES('$tanggal','$id_user','$nohp','$jumlah','$ket')";				
		  $query = runSQL($SQLInsert);
		  $lastID = mysql_insert_id();
		  /* memberikan respon nilai status = 2 dan ID dari record pegawai 
			ketika berhasil menambah data pegawai baru */
		  //echo '{status:2,IDbon:'.$lastID.'}';
		  header("location:index.php");
		}
	  // mengembalikan respon nilai status = 1 dan text error message
	  }else echo '{status:1,text:"Lengkapi Isi Form. Jumlah dan Nama Harus Diinput"}';
	}
?>
