<?php

class Divisi extends DB
{
    function getDivisi()
    {
        $query = "SELECT * FROM divisi";
        return $this->execute($query);
    }

    function get1Divisi($id)
    {
        $query = "SELECT * FROM divisi WHERE id_divisi = '$id'";
        return $this->execute($query);
    }

    function countRow($id)
    {
        $query = "SELECT COUNT(*) FROM bidang_divisi WHERE id_divisi = '$id'";
        return $this->execute($query);
    }

    function add()
    {
        $divisi_td = $_POST['tnama'];

        $query = "INSERT INTO divisi VALUES ('', '$divisi_td')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($id)
    {
        $id_divisi = $_POST['tidDivisi'];
        $divisi = $_POST['tdivisi'];

        $query = "UPDATE divisi SET id_divisi = '$id_divisi', divisi = '$divisi' 
                WHERE id_divisi = '$id_divisi'";
        return $this->execute($query); 
    }
 
    function delete($id)
    {

        $query = "DELETE FROM divisi WHERE id_divisi = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}
