<?php

try{

    $koneksi = new PDO("mysql:host=localhost; port=3306; dbname=kasir_app", "root", "");
    $koneksi->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    // print("berhasil terkoneksi");

}catch(PDOexception $e)
{
    print("koneksi bermasalah ".$e->getMessage());
}
?>
