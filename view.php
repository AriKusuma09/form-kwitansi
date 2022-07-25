<?php 
require ('connection.php');


$kwi = read("SELECT * FROM kwitansi ORDER BY id_kwitansi DESC");

// Search
if(isset($_POST["search"])) {
    $kwi = cari($_POST["keyword"]);
}


$index = 1;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Data Kwitansi</title>
    <link rel="icon" href="images/receipt.png" >

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <style>

        @media only screen and (max-width: 992px) {
            .td-button a {
                margin-left: 10px;
            }
        }
        

    </style>

</head>
<body>
    
    <section class="container" style="font-size: 14px;">
        <div class="title mt-4 d-flex d-sm-block justify-content-between" style="border-bottom: 2px solid black;">
            <h1 class="text-sm-center fw-bold" >DATA KWITANSI</h1>
            <a class=" d-block d-sm-none  me-2" style="margin-top: -7px;" href="index.php"><i class="bi bi-plus fw-bold" style="font-size: 32px;"></i></a>
        </div>

        

        <form class="form" action="" method="post" enctype="multipart/form-data">
            <div class="search-new mt-4 mb-3 d-block d-sm-flex justify-content-between" id="">
                <div class="d-flex" id="">
                    <input class="form-control" type="text" name="keyword" id="" autofocus autocomplete="off" placeholder="Nomor Kwitansi...">
                    <button class="btn btn-success ms-1" type="submit" name="search"><i class="bi bi-search d-none d-sm-block"></i><span class="d-block d-sm-none">Search</span></button>
                </div>
                <div class="link-kwi d-none d-sm-block" id="link-kwi">
                    <a class="btn btn-outline-primary " href="index.php"><i class="bi bi-file-earmark-plus"></i> Buat Kwitansi</a>
                </div>
            </div>
        </form>
        
        <div class="table-responsive">
            <table class="table text-center" cellpadding="10" cellspacing="0" > 
                <thead>
                    <tr class="align-middle">
                        <th scope="col">No.</th>
                        <th scope="col" colspan="0">Action</th>
                        <th scope="col">Nama Industri</th>
                        <th scope="col">Nomor Kwitansi</th>
                        <th scope="col">Tanggal Kwitansi</th>
                        <th scope="col">Jumlah Pembayaran</th>
                        <th scope="col">Jenis Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach($kwi as $row) : ?>
                    <tr class="align-middle">
                        <td class="fw-bold" scope="row"><?= $index++ ?></td>
                        <td class="td-button d-flex justify-content-center">
                            <!-- <a class="btn btn-danger" style="font-size: 12px;" href="hapus.php?id=<?= $row['id_kwitansi']; ?>" onclick="return confirm('Yakin Untuk Menghapus ?')"><i class="bi bi-trash"></i> Hapus</a>      -->
                            <form action="connection.php" method="POST">
                                <input type="hidden" name="delete_id" value="<?= $row['id_kwitansi']; ?>">
                                <input type="hidden" name="del_image" value="<?= $row['image']; ?>">
                                <button type="submit" name="delete_data" class="btn btn-danger me-1" style="font-size: 12px;" onclick="return confirm('Yakin Untuk Menghapus ?')"><i class="bi bi-trash"></i> Hapus</button>
                            </form>
                            <a class="btn btn-primary ms-2" style="font-size: 12px;" href="print.php?id=<?= $row['id_kwitansi']; ?>" target="_blank"><i class="bi bi-file-text"></i> Print</a>
                            <a class="btn btn-primary ms-2" style="font-size: 12px;" href="detail.php?id=<?= $row['id_kwitansi']; ?>" target="_blank"><i class="bi bi-file-text"></i> Detail</a>
                        </td>
                        
                        <td class="text-uppercase"><?= $row['industri']; ?></td>
                        <td><?= $row['no_kwi']; ?></td>
                        <td><?= $row['tgl_kwi']; ?></td>
                        <td>Rp. <?= number_format($row['payment'] ,0,',','.'); ?></td>
                        <td class="text-uppercase"><?= $row['radio']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>