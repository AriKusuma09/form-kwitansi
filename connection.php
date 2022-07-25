<?php 
session_start();


$conn = mysqli_connect("localhost", "root", "", "kwitansi_form");



// Read Data
function read($read) {
    global $conn;

    $result = mysqli_query($conn, $read);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;

    }
    return $rows;
}

// Create Function
if(isset($_POST['save'])) {

    $industri = htmlspecialchars($_POST['industri']);
    $no_kwi =htmlspecialchars( $_POST['no_kwi']);
    $tgl_kwi =htmlspecialchars( $_POST['tgl_kwi']);
    $received =htmlspecialchars( $_POST['received']);
    $amount =htmlspecialchars( $_POST['amount']);
    $for_pay =htmlspecialchars( $_POST['for_pay']);
    $payment =htmlspecialchars( $_POST['payment']);
    $radio =htmlspecialchars( $_POST['radio']);
    $bank =htmlspecialchars( $_POST['bank']);
    $no_pay =htmlspecialchars( $_POST['no_pay']);
    $tgl_pay =htmlspecialchars( $_POST['tgl_pay']);
    $image = $_FILES['image'];
    $sign_name =htmlspecialchars( $_POST['sign_name']);

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if(in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 200000) { 
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                
                $query = "INSERT INTO kwitansi(industri, no_kwi, tgl_kwi, received, amount, for_pay, payment, radio, bank, no_pay, tgl_pay, `image`, sign_name) VALUES ('$industri', '$no_kwi', '$tgl_kwi', '$received', '$amount', '$for_pay', '$payment', '$radio', '$bank', '$no_pay', '$tgl_pay', '$fileNameNew', '$sign_name')";

                $query_run = mysqli_query($conn, $query);   

                return mysqli_affected_rows($conn);

                header("Location: index.php?uploadsuccess");
            } else {
                $em = "Size File Terlalu Besar!";
                header("Location: index.php?error=$em"); 
            }
        } else {
            $em = "Terdapat Error Saat Mengupload File!";
            header("Location: index.php?error=$em");
        }
    } else {
        $em = "Tidak Bisa Upload Dengan Tipe File Ini!";
        header("Location: index.php?error=$em"); 
    }

}

// Delete Data
if(isset($_POST['delete_data'])) {
    $id = $_POST['delete_id'];
    $ttd_image = $_POST['del_image'];

    $query = "DELETE FROM kwitansi WHERE id_kwitansi='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        unlink("uploads/".$ttd_image);
        header("Location: view.php?deletesuccess");
    } else {
        header("Location: view.php?deletefailed");
    }
}



// Search Function
function cari($keyword) {
    $query = "SELECT * FROM kwitansi WHERE 
                no_kwi LIKE '$keyword%' OR
                industri LIKE '%$keyword%'
            ";
    return read($query);
}








?>