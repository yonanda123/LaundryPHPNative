<?php 
    $koneksi = new mysqli("localhost", "root", "", "laundry_coba");

    function bisa($conn,$query){
        $db = mysqli_query($conn,$query);
    
        if($db){
            return 1;
        }else{
            return 0;
        }
    }
    
    function ambilsatubaris($conn,$query){
        $db = mysqli_query($conn,$query);
        return mysqli_fetch_assoc($db);
    }
?>