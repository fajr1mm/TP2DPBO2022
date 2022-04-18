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
$objPengurus = new Pengurus($db_host, $db_user, $db_password, $db_name);
$objDivisi = new Divisi($db_host, $db_user, $db_password, $db_name);
$objBidang = new Bidang_divisi($db_host, $db_user, $db_password, $db_name);

//membuka objek dari kelas pengurus
$objPengurus->open();
$objDivisi->open();
$objBidang->open();

//menambahkan inputan objek dari kelas pengurus ke dalam table pengurus INSERT INTO
if (isset($_POST['add'])){
    $objPengurus->add();
}


$objBidang->getBidang_divisi();
// Proses mengisi tabel dengan data
$dataBidang = null;
//mengambil data option pada tabel bidang
while (list($id_bidang, $bidang, $id_divisi) = $objBidang->getResult()) {
    $dataBidang .= 
    "<option value=". $id_bidang .">". $bidang ."</option>";
}

// Menutup koneksi database
$objPengurus->close();
$objDivisi->close();
$objBidang->close();

// Membaca template
$tpl1 = new Template("templates/new.html");

//mengganti data
$tpl1->replace("DATA_BIDANG", $dataBidang);

// Menampilkan ke layar
$tpl1->write();

