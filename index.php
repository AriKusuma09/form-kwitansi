<?php 
require ('connection.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap');

        @media only screen and (max-width: 1200px) {
            input[type='date'],
            .container-xl form .form1200 {
                width: 100%;
            }
        }

        @media only screen and (min-width: 1200px){
            input[type='date'],
            .container-xl form .form1200 {
                width: 500px;
            }
        }

        @media only screen and (max-width: 992px) {
            input[type="text"] {
                width: 100%;
            }
            
            .container-xl form .payment {
                margin-bottom: 15px;
            }

            .container-xl form .payment .radio {
                margin-top: 15px;
                margin-bottom: 15px;
                text-align: center;
            }

            .container-xl form .text {
                font-size: 11px;
            }
        }

        @media only screen and (min-width: 992px) {
            .container-xl form .payment .pay {
                width: 350px;
            }
        }

        @media only screen and (max-width: 767px) {
            .container-xl form .text {
                font-size: 6    px;
            }
        }

        @media only screen and (max-width: 494px) {
            .container-xl form .payment .radio label {
                font-size: 13px;
            }
        }
    </style>
    
    <title>Membuat Kwitansi</title>
    <link rel="icon" href="images/receipt.png">
</head>
<body style="font-family: poppins,sans-serif;">

    <div class="position-fixed d-none d-xl-block" id="">
        <a class="position-absolute btn btn-danger fw-bold ps-4 pe-4 d-flex" style="top: 10px; left: 3px;" href="view.php"><i class="bi bi-backspace me-2"></i> Back</a>
    </div>
    
    <div class="container-xl">

        <div class="title mb-5 pb-3 pt-2" style="border-bottom: 2px solid black;" id="title">
            <a class="btn btn-danger fw-bold d-xl-none" href="view.php"><i class="bi bi-backspace"></i> Back</a>
            <h1 class="fw-bold text-center"><span style="border-bottom: 2px solid black;">BUAT KWITANSI</span> <br><span class="fst-italic">MAKE RECEIPT</span></h1>
        </div>
        

        <form style="background-color: #f2f2f2; padding: 50px 50px 0px 50px; border-radius: 5px;" action="" method="post" class="form-company" enctype="multipart/form-data">
            
            <div class="mb-3 mt-3">
                <label class="form-label" for="company">Nama Industri / <span class="fst-italic">Industry Name</span></label>
                <input class="form-control" type="text" minlength="8" maxlength="23 " name="industri" placeholder="Nama Industri..." autocomplete="off" required>    
            </div>
            <div class="form-top mb-3 mt-4 w-md-100 d-block d-xl-flex justify-content-between">
                <div class="form-atas" id="">
                    <label for="noKwitansi">Nomor Kwitansi / <span class="fst-italic">Receipt Number</span></label>
                    <input class="form1200 form-control" maxlength="12" minlength="10" type="text" name="no_kwi" placeholder="Nomor Kwitansi..." autocomplete="off" required onkeypress="return event.charCode >= 48 && event.charCode <=57">
                </div>  
                <div class="form-atas" id="">
                    <label for="tglKwitansi">Tgl Kwitansi / <span class="fst-italic">Receipt Date</span> </label>
                    <input class="form1200 form-control" type="date" name="tgl_kwi" placeholder="Masukan Tanggal Kwitansi..." required>
                </div>
            </div>
            <div class="mb-3 mt-5">
                <label class="label-received form-label" for="receivedFrom">Sudah Terima Dari / <span class="fst-italic">Received From</span> </label>
                <input class="form-body-top form-control" minlength="3" maxlength="40" type="text" name="received" autocomplete="off" placeholder="Sudah Terima Dari...." required>
            </div>
            <div class="mb-5 mt-1">
                <label class="label-amount form-label" for="amount">Banyaknya Uang / <span class="fst-italic">Amount</span></label>
                <input class="form-body-top form-control" minlength="6" maxlength="20" type="text" name="amount" autocomplete="off" placeholder="ditulis menggunakan huruf...." required onkeypress="return event.charCode < 48 || event.charCode  >57">
            </div>
            <div class="mb-5 mt-5">
                <label class="form-label" for="forPayment">Untuk Pembayaran / <span class="fst-italic">For Payment</span></label>
                <textarea style="resize: none;" maxlength="200" class="form-control" name="for_pay" id="" cols="100" rows="15" placeholder="Untuk Pembayaran...."></textarea>
            </div>
            <div class="payment mb-3 mt-5 d-block d-lg-flex justify-content-between">
                <div class="d-flex" id="">
                    <label class="form-label fw-bold me-3 fs-5" for="payment">RP. </label>
                    <input class="pay form-control" maxlength="10" minlength="5" placeholder="Jumlah Uang...." type="text" name="payment" autocomplete="off" required onkeypress="return event.charCode >= 48 && event.charCode <=57">
                </div>
                <div class="radio">
                    <input class="form-check-input ms-2" required type="radio" name="radio" value="cash">
                    <label class="form-check-label me-4 fw-bold" for="CASH">CASH</label>
                    <input class="form-check-input ms-2" required type="radio" name="radio" value="cheque">
                    <label class="form-check-label me-4 fw-bold" for="CHEQUE">CHEQUE</label>
                    <input class="form-check-input ms-2" required type="radio" name="radio" id="" value="bilyet giro">
                    <label class="form-check-label me-4 fw-bold" for="BILYET-GIRO">BILYET GIRO</label>
                </div> 
            </div>
            <div class="mb-3">
                <label class="form-label" for="bank">BANK / <span class="fst-italic">BANK</span> </label>
                <input class="form-control" type="text" minlength="2" maxlength="14" name="bank" placeholder="Bank...." autocomplete="off" required>
            </div>
            <div class="mb-3 mt-3 d-block d-xl-flex justify-content-between">
                <div class="" id="">
                    <label class="form-label" for="no-payment">Nomor Pembayaran / <span class="fst-italic">Payment Number</span> </label>
                    <input class="form1200 form-control" maxlength="12" minlength="10" placeholder="Nomor Pembayaran...." type="text" name="no_pay" autocomplete="off" required onkeypress="return event.charCode >= 48 && event.charCode <=57">
                </div>  
                <div class="" id="">
                    <label class="form-label" for="tgl-payment">Tgl Pembayaran / <span class="fst-italic">Payment Date</span></label>
                    <input class="form1200 form-control" type="date" name="tgl_pay" required>
                </div>
            </div>
            <div class="mb-5 mt-5">
                <label class="form-label" for="image">Foto Tanda Tangan / <span class="fst-italic">Signature Image</span></label>
                                
                <input type="file" name="image" class="input-image form-control" required id="image" onchange="previewImage()"><br/>
                <!-- <img class="img-preview img-fluid" width="200" height="190"><br/> -->
                <input class="signature-name form-control mt-3" minlength="3" maxlength="25" type="text" name="sign_name" placeholder="Nama Pemilik Tanda Tangan..." autocomplete="off" required>
            </div>
            
            <div class="mb-5 mt-5 text-end">
                <input class="btn btn-primary fw-bold px-4 py-2" type="submit" name="save" value="Buat Kwitansi">
            </div>

            <div class="mb-4 mt-4 text-center text">
                <p><span class="top  ps-3 pe-3" style="border-bottom: 2px solid black;">Kwitansi ini dianggap sah, setelah pembayaran dengan Bilyet Giro/Cheque tsb. dapat diuangkan.</span><br/>
                <span class="bottom">This receipt will be cleared after Bilyet Giro/Cheque can be cleared</span></p>
            </div>

        </form>

    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script type="text/javascript" src="kwitansi.js"></script>

</body>
</html>