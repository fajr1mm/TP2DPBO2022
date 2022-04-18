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
$objBidang = new Bidang_divisi($db_host, $db_user, $db_password, $db_name);

//membuka objek dari kelas pengurus
$objPengurus->open();
$objBidang->open();

$objBidang->getBidang_divisi();
// Proses mengisi tabel dengan data
$dataBidang = null;
//mengambil data option pada tabel bidang
while (list($id_bidang, $bidang, $id_divisi) = $objBidang->getResult()) {
    $dataBidang .= 
    "<option value=". $id_bidang .">". $bidang ."</option>";
}

if(isset($_POST['submit'])){
	$objPengurus->update($_POST['submit']);
	header("location: index.php");
}else if(isset($_GET['d_pengurus'])){
	$objPengurus->delete($_GET['d_pengurus']);
	header("location: index.php");
}


//mengambil objek dari kelas pengurus SELECT * FROM
$objPengurus->getPengurus();
$data = null;
while (list($nik, $nama, $lama_mejabat, $foto, $id_bidang, $id_bidang, $bidang, $id_divisi) = $objPengurus->getResult()) {
		$data .= 
		"<a href='index.php?idPoppup=" . $nik . "' id='button' class='p-4 md:w-1/4 hover:no-underline'>
			<div class='h-full border-2 hover:outline hover:outline-gray-600 hover:outline-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden drop-shadow-xl'>
				<img class='max-h-64 w-full object-cover object-center' src='./upload/" . $foto . "'  alt='./upload/" . $foto . "'> 
				<div class='p-6'>
					<h2 class='tracking-widest text-xs title-font font-medium text-gray-400 mb-1'>". $bidang . "</h2>
					<h1 class='title-font text-lg font-medium text-gray-900 mb-3'>". $nama . "</h1>
				</div>
			</div>
		</a>";
	}
	$dataPopup =
	"<div class='popup bg-black/[0.7] w-full h-full absolute flex justify-center items-center hidden'>
	  </div>";
if(isset($_GET["idPoppup"])){
	$objPengurus->get1Pengurus($_GET["idPoppup"]);
	$dataPopup = null;
	while (list($nik, $nama, $lama_mejabat, $foto, $id_bidang, $id_bidang, $bidang, $id_divisi) = $objPengurus->getResult()) {
		$dataPopup .=
		"<div class='popup bg-black/[0.7] w-full h-full fixed top-0 left-0 bottom-0 right-0 flex justify-center items-center'>
			<div class='p-4 md:w-1/4'>
				<div class='bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden drop-shadow-xl'>
					<img class='max-h-64 w-full object-cover object-center' src='./upload/" . $foto . "'  alt='./upload/" . $foto . "'> 
					<div class='p-6'>
						<h2 class='tracking-widest text-xs title-font font-medium text-gray-400 mb-1'>" . $bidang . "</h2>
						<h1 class='title-font text-lg font-medium text-gray-900 mb-3'>" . $nama . "</h1>
						<div class='flex justify-between'>
							<div class='flex flex-row'>
								<a href='index.php?u_pengurus=" . $nik . "'> <img alt='team' class='update w-4 h-4 hover:w-5 hover:h-5 hover:object-cover object-cover mr-3' src='http://cdn.onlinewebfonts.com/svg/img_257550.png'>
								</a>
								<a href='index.php?d_pengurus=" . $nik . "'> <img alt='team' class='delete w-4 h-4 hover:w-5 hover:h-5 hover:object-cover object-cover' src='http://cdn.onlinewebfonts.com/svg/img_304350.png'>
								</a>
							</div>
							<div class='close'>
								<p class='text-sm'>Close</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>";
	}
}else if(isset($_GET["u_pengurus"])){
	$objPengurus->get1Pengurus($_GET['u_pengurus']);
	list($nik, $nama, $lama_mejabat, $foto, $id_bidang, $id_bidang, $bidang, $id_divisi) = $objPengurus->getResult();
	$dataPopup = null;
	$dataPopup .=
	"<form autocomplete='on' action='' method='post' enctype='multipart/form-data'>
		<div class='popup bg-black/[0.7] w-full h-full fixed top-0 left-0 bottom-0 right-0 flex justify-center items-center'>
			<div class='p-4 md:w-1/4'>
				<div class='bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden drop-shadow-xl'>
					<input type='file' id='tdfoto' name='tdfoto' multiple class='max-h-64 w-full object-cover object-center'> 
					<div class='p-6'>
						<select id='tbidang' name='tidbidang' class='w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out'>
                			DATA_BIDANG
              			</select>
						  <input type='hidden' id='tid' name='tlamamejabat' value='" . $lama_mejabat . "' class='w-full h-5 mb-3 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-1 leading-8 transition-colors duration-200 ease-in-out'>
						<input type='hidden' id='tid' name='tid' value='" . $nik . "' class='w-full h-5 mb-3 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-1 leading-8 transition-colors duration-200 ease-in-out'>
						<input type='text' id='tnama' name='tnama' value='" . $nama . "' placeholder='Nama Lengkap' class='w-full h-5 mb-3 bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-1 leading-8 transition-colors duration-200 ease-in-out'>
						<div class='flex justify-between'>
							<div class='flex flex-row'>
								<a href='index.php?idPoppup=" . $nik . "' class='text-sm pt-2'><button type='button'>Cancel</button></a>
							</div>
							<button type='submit' name='submit' class='text-sm'>Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
  </form>";
}


// Menutup koneksi database
$objPengurus->close();

// Membaca template
$tpl1 = new Template("templates/skin.html");

//mengganti data
$tpl1->replace("DATA_PENGURUS", $data);
$tpl1->replace("DATA_POPUP", $dataPopup);
if(isset($_GET["idPoppup"])){
	$tpl1->replace("DATA_POPUP", $dataPopup);
}else if(isset($_GET["u_pengurus"])){
	$tpl1->replace("DATA_BIDANG", $dataBidang);
}

// Menampilkan ke layar
$tpl1->write();

