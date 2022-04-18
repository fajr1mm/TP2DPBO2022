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
$objBidang = new Bidang_divisi($db_host, $db_user, $db_password, $db_name);
$objDivisi = new Divisi($db_host, $db_user, $db_password, $db_name);

//membuka objek dari kelas pengurus
$objBidang->open();
$objDivisi->open();



if(isset($_GET['d_bidang'])){
  $objBidang->delete($_GET['d_bidang']);
  header("location: details.php?edit");
}

if(isset($_POST['submit_uBidang'])){
  $objBidang->update($_POST['submit_uBidang']);
  header("location: details.php");
}

if(isset($_POST['submit_uDiv'])){
  $objDivisi->update($_POST['submit_uDiv']);
  header("location: details.php");
}

if(isset($_GET['d_divisi'])){
  $objDivisi->delete($_GET['d_divisi']);
  header("location: details.php?edit");
}

  $objBidang->getBidang_divisi();
  $dataBidang = null;
  $dataEditSave = 
  "<a href='details.php?edit' method='POST'>
  <button type='submit' name='edit' class='inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0'>EDIT 
  <svg fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' class='w-4 h-4 ml-1' viewBox='0 0 24 24'>
  <path d='M5 12h14M12 5l7 7-7 7'></path>
  </svg>
  </button>
  </a>";
  //mengambil data option pada tabel divisi
  while (list($id_bidang, $bidang, $id_divisi) = $objBidang->getResult()) {
    $dataBidang .= 
    "<div class='flex flex-row justify-between border-b-2 border-gray-200 mb-3 pb-1'>
    <span class='text-gray-500'>" . $bidang . "</span>
    <a href='details.php?pop_bidang=" . $id_bidang . "'> <img alt='team' class='w-4 h-4 hover:w-5 hover:h-5 hover:object-cover object-cover mr-3' src='http://cdn.onlinewebfonts.com/svg/img_519962.png'>
    </a>
    </div>";
  }
  $dataBidang .=
  "
  <div class='mt-3 w-full flex-shrink-0 border-b-2 pb-2 flex flex-row justify-between leading-none'>
  <a href='new_bidang.php'><span class='text-gray-500 pb-2 border-gray-200'>+ Tambah Bidang</span></a>
  </div>";

  $dataPopBidang =
  "
  <div class='popup bg-black/[0.7] w-full h-full absolute top-0 flex justify-center items-center hidden'>
  </div>";

  $objDivisi->getDivisi();
  $dataDivisi = null;
  while (list($id_divisi, $divisi) = $objDivisi->getResult()) {
    $dataDivisi .=
    "
    <div class='flex flex-row justify-between border-b-2 border-gray-200 mb-3 pb-1'>
      <span class='text-gray-500'>" . $divisi . "</span>
      <a href='details.php?pop_divisi=" . $id_divisi . "'> <img alt='team' class='w-4 h-4 hover:w-5 hover:h-5 hover:object-cover object-cover mr-3' src='http://cdn.onlinewebfonts.com/svg/img_519962.png'>
      </a>
    </div>";
  }
  $dataDivisi .=
  "<div class='mt-3 w-full flex-shrink-0 border-b-2 pb-2 flex flex-row justify-between leading-none'>
      <a href='new_divisi.php'><span class='text-gray-500 pb-2 border-gray-200'>+ Tambah Divisi</span></a>
  </div>";

  $dataPopdivisi =
  "
  <div class='popup bg-black/[0.7] w-full h-full absolute top-0 flex justify-center items-center hidden'>
  </div>";

// Proses mengisi tabel dengan data
if(isset($_GET['edit'])){
  $dataEditSave = 
	"<a href='details.php?save' methode='POST'> 
	<button type='submit' name='edit' class='inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0'>SAVE 
	<svg fill='none' stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' class='w-4 h-4 ml-1' viewBox='0 0 24 24'>
	</svg>
  </button>
  </a>";
  //mengambil data option pada tabel divisi
  $objBidang->getBidang_divisi();
  $dataBidang = null;
    while (list($id_bidang, $bidang, $id_divisi) = $objBidang->getResult()) {
        $dataBidang .= 
        "<div class='mt-3 w-full flex-shrink-0 border-b-2 flex flex-row justify-between leading-none'>
        <span class='text-gray-500 pb-2 border-gray-200'>". $bidang ."</span>
          <div class='flex flex-row'>
          <a href='details.php?u_bidang=" . $id_bidang . "'> <img alt='team' class='w-4 h-4 hover:w-5 hover:h-5 hover:object-cover object-cover mr-3' src='http://cdn.onlinewebfonts.com/svg/img_257550.png'>
          </a>
            <a href='details.php?d_bidang=" . $id_bidang . "'> <img alt='team' class='w-4 h-4 hover:w-5 hover:h-5 hover:object-cover object-cover' src='http://cdn.onlinewebfonts.com/svg/img_304350.png'>
            </a>
          </div>
        </div>";
      }
      
      $objDivisi->getDivisi();
      $dataDivisi = null;
      while (list($id_divisi, $divisi) = $objDivisi->getResult()) {
        $dataDivisi .=
        "<div class='mt-2 w-full flex-shrink-0 border-b-2 flex flex-row justify-between leading-none'>
        <span class='text-gray-500 pb-2 border-gray-200'>". $divisi ."</span>
        <div class='flex flex-row'>
      <a href='details.php?u_divisi=" . $id_divisi . "'> <img alt='team' class='w-4 h-4 hover:w-5 hover:h-5 hover:object-cover object-cover mr-3' src='http://cdn.onlinewebfonts.com/svg/img_257550.png'>
      </a>
      <a href='details.php?d_divisi=" . $id_divisi . "'> <img alt='team' class='w-4 h-4 hover:w-5 hover:h-5 hover:object-cover object-cover' src='http://cdn.onlinewebfonts.com/svg/img_304350.png'>
      </a>
      </div>
      </div>";
    }
  }else if(isset($_GET["pop_bidang"])){
    $objBidang->countRow($_GET["pop_bidang"]);
    list($row) = $objBidang->getResult();
    $objBidang->get1Bidang_divisi($_GET["pop_bidang"]);
    // $rowBidang = $objBidang->countRow();
    $dataPopBidang = null;
    while (list($id_bidang, $bidang, $id_divisi) = $objBidang->getResult()){
      $dataPopBidang .=
      "
      <div class='popup bg-black/[0.7] w-full h-full fixed top-0 left-0 bottom-0 right-0 flex justify-center items-center'>
        <div class='p-4 md:w-1/4'>
          <div class='bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden drop-shadow-xl'>
            <div class='flex flex-row justify-between pt-2 px-2 border-b-2 bg-gray-200'>
            <h1 class='font-medium'>" . $bidang . "</h1>
            <span class='text-gray-600'>" . $row . " Anggota</span>
            </div>
            <div class='close'>
            <a href='details.php' class='text-sm hover:no-underline'>Close</a>
            </div>
            </div>
            </div>
            </div>";
          }
        }
    else if(isset($_GET["pop_divisi"])){
      $objDivisi->countRow($_GET["pop_divisi"]);
      list($row) = $objDivisi->getResult();
      $objDivisi->get1Divisi($_GET["pop_divisi"]);
      // $rowDivisi = $objDivisi->getResult();
      $dataPopdivisi = null;
      while (list($id_divisi, $divisi) = $objDivisi->getResult()){
        $dataPopdivisi .=
        "
        <div class='popup bg-black/[0.7] w-full h-full fixed top-0 left-0 bottom-0 right-0 flex justify-center items-center'>
          <div class='p-4 md:w-1/4'>
            <div class='bg-white h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden drop-shadow-xl'>
              <div class='flex flex-row justify-between pt-2 px-2 border-b-2 bg-gray-200'>
                <h1 class='font-medium'>" . $divisi . "</h1>
                <span class='text-gray-600'>" . $row . " Bidang</span>
              </div>
              <div class='close'>
                <a href='details.php' class='text-sm hover:no-underline'>Close</a>
              </div>
            </div>
          </div>
        </div>";
    }
  }
  else if(isset($_GET["u_divisi"])){
    $objDivisi->get1Divisi($_GET["u_divisi"]);
    // $rowDivisi = $objDivisi->getResult();
    $dataPopdivisi = null;
    while (list($id_divisi, $divisi) = $objDivisi->getResult()){
      $dataPopdivisi .=
      "
      <div class='popup bg-black/[0.7] w-full h-full fixed top-0 left-0 bottom-0 right-0 flex justify-center items-center'>
        <div class='p-4 md:w-1/4'>
          <div class='bg-white p-2 h-full border-2 flex flex-row border-gray-200 border-opacity-60 rounded-lg overflow-hidden drop-shadow-xl'>
            <form autocomplete='on' action='' method='post' enctype='multipart/form-data'>
              <div class='relative mb-4'>
                <label  for='nama-divisi' class='leading-7 text-sm text-gray-600'>Nama Divisi</label>
                <input value='" . $id_divisi . "' type='hidden' id='tidDivisi' name='tidDivisi' class='w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out'>
                <input value='" . $divisi . "' type='text' id='tdivisi' name='tdivisi' class='w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out'>
              </div>
              <button type='submit' name='submit_uDiv' class='text-sm'>Save</button>
            </form>
            <div class='close'>
              <a href='details.php' class='text-sm hover:no-underline'>Close</a>
            </div>
          </div>
        </div>
      </div>";
  }
}
else if(isset($_GET["u_bidang"])){
  $objBidang->get1Bidang_divisi($_GET["u_bidang"]);
  // $rowDivisi = $objDivisi->getResult();
  $dataPopBidang = null;
  while (list($id_bidang, $bidang, $id_divisi) = $objBidang->getResult()){
    $dataPopBidang .=
    "
    <div class='popup bg-black/[0.7] w-full h-full fixed top-0 left-0 bottom-0 right-0 flex justify-center items-center'>
      <div class='p-4 md:w-1/4'>
        <div class='bg-white p-2 h-full border-2 flex flex-row border-gray-200 border-opacity-60 rounded-lg overflow-hidden drop-shadow-xl'>
          <form autocomplete='on' action='' method='post' enctype='multipart/form-data'>
            <div class='relative mb-4'>
              <label  for='nama-divisi' class='leading-7 text-sm text-gray-600'>Nama Bidang</label>
              <input value='" . $id_bidang . "' type='hidden' id='tidbidang' name='tidBidang' class='w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out'>
              <input value='" . $bidang . "' type='text' id='tbidang' name='tbidang' class='w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out'>
              <input value='" . $id_divisi . "' type='hidden' id='tiddivisi' name='tidDivisi' class='w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out'>
            </div>
            <button type='submit' name='submit_uBidang' class='text-sm'>Save</button>
          </form>
          <div class='close'>
            <a href='details.php' class='text-sm hover:no-underline'>Close</a>
          </div>
        </div>
      </div>
    </div>";
  }
}

// Menutup koneksi database
$objBidang->close();
$objDivisi->close();

// Membaca template
$tpl2 = new Template("templates/details.html");

//mengganti data
$tpl2->replace("DATA_DIVISI", $dataDivisi);
$tpl2->replace("DATA_BIDANG", $dataBidang);
$tpl2->replace("dataEditSave", $dataEditSave);
if(isset($_GET['pop_divisi'])){
  $tpl2->replace("DATA_POPUP", $dataPopdivisi);
}else if(isset($_GET['pop_bidang'])){
  $tpl2->replace("DATA_POPUP", $dataPopBidang);
}else if(isset($_GET['u_divisi'])){
  $tpl2->replace("DATA_POPUP", $dataPopdivisi);
}else if(isset($_GET['u_bidang'])){
  $tpl2->replace("DATA_POPUP", $dataPopBidang);
}


// Menampilkan ke layar
$tpl2->write();

