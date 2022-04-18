<?php

class Pengurus extends DB
{
    function getPengurus()
    {
        $query = "SELECT * FROM pengurus JOIN bidang_divisi ON
                pengurus.id_bidang = bidang_divisi.id_bidang";
        return $this->execute($query);
    }

    function get1Pengurus($id)
    {
        $query = "SELECT * FROM pengurus JOIN bidang_divisi ON
                pengurus.id_bidang = bidang_divisi.id_bidang 
                WHERE nik ='$id'";
        return $this->execute($query);
    }

    function add()
    {
        $nama_td = $_POST['tdnama'];
        $lama_mejabat_td = $_POST['tdlamamejabat'];

        $foto_td = $_FILES["tdfoto"]['name'];
        $Tmpname = $_FILES["tdfoto"]['tmp_name'];
        $filefoto = "upload/". $foto_td;
	    if(move_uploaded_file($Tmpname, $filefoto)){
            $foto_td = $_FILES["tdfoto"]['name'];
        }else{
            $foto_td = 'anonim.png';
        }

        $id_bidang_td = $_POST['tdidBidang'];
		// Image db insert sql
        $query = "INSERT INTO `pengurus`(`nik`, `nama`, `lama_mejabat`, `foto`, `id_bidang`)
                 VALUES 
                 (NULL,'$nama_td','$lama_mejabat_td', '$foto_td', '$id_bidang_td');";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {

        $query = "DELETE FROM pengurus WHERE nik = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($id)
    {
        
        $nik = $_POST['tid'];
        $nama = $_POST['tnama'];
        $lama_mejabat = $_POST['tlamamejabat'];
        $foto_td = $_FILES['tdfoto']['name'];
        $Tmpname = $_FILES['tdfoto']['tmp_name'];
        $filefoto = "upload/". $foto_td;
	    if(move_uploaded_file($Tmpname, $filefoto)){
            $foto_td = $_FILES["tdfoto"]['name'];
        }else{
            $foto_td = 'anonim.png';
        }
        
        $id_bidang = $_POST['tidbidang'];
        $query = "UPDATE pengurus
                SET nama = '$nama', foto = '$foto_td', lama_mejabat = '$lama_mejabat', id_bidang = '$id_bidang'
                WHERE nik = '$nik'";
        
        return $this->execute($query);
    }
}


?>