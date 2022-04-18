<?php

class Bidang_divisi extends DB
{
    function getBidang_divisi()
    {
        $query = "SELECT * FROM bidang_divisi";
        return $this->execute($query);
    }

    function get1Bidang_divisi($id)
    {
        $query = "SELECT * FROM bidang_divisi WHERE id_bidang = '$id'";
        return $this->execute($query);
    }

    function countRow($id)
    {
        $query = "SELECT COUNT(*) FROM pengurus WHERE id_bidang = '$id'";
        return $this->execute($query);
    }

    function add()
    {
        $bidang_td = $_POST['tnama'];
        $id_divisi = $_POST['tidDivisi'];

        $query = "INSERT INTO `bidang_divisi`(`id_bidang`, `bidang`, `id_divisi`) 
                    VALUES (NULL, '$bidang_td', '$id_divisi')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($id)
    {
        $id_bidang_td = $_POST['tidBidang'];
        $bidang_td = $_POST['tbidang'];
        $id_divisi_td = $_POST['tidDivisi'];

        $query="UPDATE `bidang_divisi` SET `id_bidang`='$id_bidang_td',`bidang`='$bidang_td',`id_divisi`='$id_divisi_td' WHERE id_bidang = '$id_bidang_td';";
        return $this->execute($query); 
    }

    function delete($id)
    {

        $query = "DELETE FROM bidang_divisi WHERE id_bidang = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}
