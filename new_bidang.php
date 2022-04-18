<?php

//connection to database
include("conf.php");

//write interface to hoster
include("includes/Template.class.php");

//includes object class
include("includes/DB.php");
include("includes/Divisi.class.php");
include("includes/Bidang_divisi.class.php");
include("includes/Pengurus.class.php");

// Membuat objek dari kelas pengurus
$objDivisi = new Divisi($db_host, $db_user, $db_password, $db_name);
$objBidang = new Bidang_divisi($db_host, $db_user, $db_password, $db_name);

//membuka objek dari kelas pengurus
$objDivisi->open();
$objBidang->open();

//menambahkan inputan objek dari kelas pengurus ke dalam table pengurus INSERT INTO
if (isset($_POST['add'])){
    $objBidang->add();
    header("location: details.php");
}


$objDivisi->getDivisi();
// Proses mengisi tabel dengan data
$dataDivisi = null;
//mengambil data option pada tabel divisi
while (list($id_divisi, $divisi) = $objDivisi->getResult()) {
    $dataDivisi .= 
    "<option value=". $id_divisi .">". $divisi ."</option>";
}

// Menutup koneksi database
$objDivisi->close();
$objBidang->close();

// Membaca template
$tpl1 = new Template("templates/new_bidang.html");

//mengganti data
$tpl1->replace("DATA_DIVISI", $dataDivisi);

// Menampilkan ke layar
$tpl1->write();

