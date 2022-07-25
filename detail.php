<?php 
require ('connection.php');

$id = $_GET["id"];
$kwi = read("SELECT * FROM kwitansi WHERE id_kwitansi = $id")[0]; 



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="detail.css?v2">

    <title>Kwintansi No. <?= $kwi['no_kwi']; ?></title>
    <link rel="icon" href="images/receipt.png">
</head>
<body>
    
    <div class="button-back" id="">
        <a class="back-button" href="view.php">Back</a>
    </div>
        <div class="container">

            <form action="" method="post" class="form-company" enctype="multipart/form-data">
                
                <div class="header" id="header">
                    <div class="company-name">    
                        <label for="company"></label> 
                        <input value="<?= $kwi['industri']; ?>" disabled class="company-form" type="text" name="industri" placeholder="Nama Industri..." autocomplete="off" required>               
                    </div>
                    <div class="title-form" id="title-form">
                        <h1>KWITANSI</h1>
                    </div>
                    <div class="header-right" id="">
                        <div class="no-kwitansi" id="no-kwitansi">
                            <label for="noKwitansi">No. : </label>
                            <input value="<?= $kwi['no_kwi']; ?>" disabled class="form-first" type="number" name="no_kwi" placeholder="Nomor Kwitansi..." autocomplete="off" required>
                        </div>
                        <div class="tgl-kwitansi" id="tgl-kwitansi">
                            <label for="tglKwitansi">Tgl. : </label>
                            <input value="<?= $kwi['tgl_kwi']; ?>" disabled class="form-first" type="date" name="tgl_kwi" placeholder="Masukan Tanggal Kwitansi..." required>
                        </div>
                    </div>
                    
                </div>

                <div class="row" id="">
                    <div class="first" id="">
                        <div class="received-body" id="">
                            <label class="label-received" style="font-size: 15px;" for="receivedFrom">Sudah Terima Dari <span>:</span></label>
                            <input value="<?= $kwi['received']; ?>" disabled class="form-body-top" type="text" name="received" autocomplete="off" required>
                        </div>
                        <div class="amount-body" id="">
                            <label class="label-amount" style="font-size: 15px;" for="amount">Banyaknya Uang <span style="margin-left: 11px;">: </span></label>
                            <input value="<?= $kwi['amount']; ?>" disabled class="form-body-top" type="text" name="amount" autocomplete="off" required onkeypress="return event.charCode < 48 || event.charCode  >57">
                        </div>
                    </div>
                    

                    <div class="second" id="">
                        <label for="forPayment">Untuk Pembayaran :</label>
                        <br/>
                        <textarea name="for_pay" id="" cols="100" rows="15" placeholder="Untuk Pembayaran...." disabled><?= $kwi['for_pay']; ?></textarea>
                    </div>

                    <div class="third" id="">
                        <div class="left-third" style="width: 100%;">

                            <div class="payment" id="payment">
                                <label for="payment">RP. </label>
                                <input value="<?= number_format($kwi['payment'] ,0,',','.') ?>" disabled type="text" name="payment" autocomplete="off" required  onkeypress="return event.charCode >= 48 && event.charCode <=57">
                            </div>  
    
                            <div class="check" id="">
                                <input class="radio" required type="radio" name="radio" value="cash" <?php if($kwi['radio']=='cash') echo 'checked'?> >
                                <label for="CASH">CASH</label>
                                <input class="radio" required type="radio" name="radio" value="cheque" <?php if($kwi['radio']=='cheque') echo 'checked'?> >
                                <label for="CHEQUE">CHEQUE</label>
                                <input class="radio" required type="radio" name="radio" id="" value="bilyet giro" <?php if($kwi['radio']=='bilyet giro') echo 'checked'?> >
                                <label for="BILYET GIRO">BILYET GIRO</label>
                            </div>
    
                            <div class="third-bottom" id="">
    
                                <div class="bank" id="bank">
                                    <label for="bank">BANK <span>:</span> </label>
                                    <input value="<?= $kwi['bank']; ?>" disabled type="text" name="bank" id="" autocomplete="off" required>
                                </div>
                                <div class="no-payment" id="no-payment">
                                    <label for="no-payment">No. <span style="margin-left: 15px;">:</span> </label>
                                    <input value="<?= $kwi['no_pay']; ?>" disabled type="number" name="no_pay" autocomplete="off" required>
                                </div>
                                <div class="tgl-payment" id="tgl-payment">
                                    <label for="tgl-payment">Tgl. </label>
                                    <input value="<?= $kwi['tgl_pay']; ?>" disabled style="margin-left: 21px;" type="date" name="tgl_pay" required>
                                </div>
                            </div>

                        </div>
                        
                        <div class="right-third" style="width: 100%; justify-content: center;">

                            <div class="signature-owner" style="position: relative; display: grid; justify-content: center; text-align: center;" id="signature">
                                
                                <img class="img-preview img-fluid" src="uploads/<?= $kwi['image']; ?>"><br/>
                                
                                <div class="signature-owner" style="position: relative; justify-content: center; text-align: center;">
                                <input value="<?= $kwi['sign_name']; ?>" disabled class="signature-name" type="text" name="sign_name" placeholder="Nama Pemilik Tanda Tangan..." autocomplete="off" required>
                                </div>
                            </div>
                            
                        </div>
                           
                        
                    </div>

                    <!-- <div class="form-kwitansi" id="">
                        <input type="submit" name="save" value="Kirim">
                    </div> -->


                    <div class="text-bottom" id="text-bottom">
                        
                        <p ><span class="top">Kwitansi ini dianggap sah, setelah pembayaran dengan Bilyet Giro/Cheque tsb. dapat diuangkan.</span><br/>
                        <span class="bottom">This receipt will be cleared after Bilyet Giro/Cheque can be cleared</span></p>
                    </div>

                </div>

            </form>

        </div>

        <script type="text/javascript" src="kwitansi.js"></script>

</body>
</html>