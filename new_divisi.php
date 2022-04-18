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

// Membuat objek dari kelas divisi
$objDivisi = new Divisi($db_host, $db_user, $db_password, $db_name);

//membuka objek dari kelas divisi
$objDivisi->open();

//menambahkan inputan objek dari kelas divisi ke dalam table divisi INSERT INTO
if (isset($_POST['add'])){
    $objDivisi->add();
    header("location: details.php");
}

// Menutup koneksi database
$objDivisi->close();

// Membaca template
$tpl1 = new Template("templates/new_divisi.html");

//mengganti data
// $tpl1->replace("DATA_BIDANG", $data);

// Menampilkan ke layar
$tpl1->write();

