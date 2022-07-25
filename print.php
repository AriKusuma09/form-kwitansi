<?php

require_once __DIR__ . '/vendor/autoload.php';

require('connection.php');
$id = $_GET["id"];
$kwi = read("SELECT * FROM kwitansi WHERE id_kwitansi = $id")[0]; 

$mpdf = new \Mpdf\Mpdf();

// HTML Code
$html = 
'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" href="images/receipt.png">
    
    <title>Cetak Kwitansi No. '. $kwi["no_kwi"] .'</title>

    <style>

    body {
        font-family: arial;
    }
    
    table {
        width: 100%;
    }

    .title,
    .industry {
        text-align: center;
    }

    .industry {
        border: 2px solid black;
        border-radius: 10px;
        
    }

    .p-20 {
        padding: 20px;
    }

    .text-center {
        text-align: center;
    }
    

    .border-bottom {
        border-bottom: 1px solid black;
    }

    .border {
        border: 1px solid black;
    }
    
    </style>

</head>
<body>

    <header>
        <div>
            <table>
                <tr>
                    <td class="industry" style="width: 35%;"><p class="industry-p" style="font-size: 15px; font-weight: bold;">'. $kwi["industri"] .'</p></td>
                    <td class="title"><h1> KWITANSI </h1></td>
                    <td>
                    <table>
                        <tr>
                            <td>No. </td>
                            <td> : </td>
                            <td class="border-bottom"> '. $kwi["no_kwi"] .' </td>
                        </tr>
                        <tr>
                            <td>Tgl. </td>
                            <td> : </td>
                            <td class="border-bottom"> '. $kwi["tgl_kwi"] .' </td>
                        </tr>
                    </table>
                    </td>
                </tr>
            </table>
        </div>
    </header>

    <section style="border: 2px solid black; margin-top: 20px;">

        <section style="border-bottom: 2px solid back;">
            <table class="p-20">
                <tr>
                    <td style="width: 23%;">Sudah Terima Dari </td>
                    <td style="width: 2px;"> : </td>
                    <td class="border-bottom">'. $kwi["received"] .'</td>
                </tr>
                <tr style="margin-top: 3px;">
                    <td style="width: 23%;">Banyaknya Uang </td>
                    <td style="width: 2px;"> : </td>
                    <td class="border-bottom">'. $kwi["amount"] .'</td>
                </tr>
            </table>
        </section>

        <section style="border-bottom: 2px solid back;">
            <div class="p-20">
                <div style="margin-top: 5px;">
                    <label> Untuk Pembayaran : </label>
                </div>
                <div style="margin-top: 10px;">
                    <textarea style="margin-top: 4px; background: transparent;" cols="100" rows="15">
                        '. $kwi["for_pay"] .'
                    </textarea>
                </div>
            </div>
        </section>

        <section style="" class="">
            <table border="0" class="" style="padding: 35px;">
            
                <tr>
                    <td style="width: 2px; font-size: 20px; font-weight: bold;">Rp. </td>
                    <td style="width: 3px;"> </td>
                    <td  class="border-bottom"><div style="width: px;"><span style="font-size: 19px; font-weight: 700;">'. number_format($kwi['payment'] ,0,',','.') .'</span></div></td>
                    <td></td>

                    <td rowspan="11" style="text-align: center;">
                    
                        <div style="text-align: center;" >
                            <img style="width: 130px; height: 130px;" class="img-preview img-fluid" src="uploads/'. $kwi["image"] .'"><br/>
                        </div>
                        <div style="text-align: center; border-bottom: 1px solid black; ">
                            <span style="font-size: 15px;">'. $kwi['sign_name'] .'</span>
                        </div>

                    </td>
                </tr>
                
            
                <tr><td></td></tr>
                <tr><td></td></tr>
            
                <tr style="">
                    <td colspan="" style="">';
                        if($kwi["radio"] == 'cash') {$cash = "checked.png";} else {$cash = "unchecked.png";}

$html .=               '<td><img name="radio" class="img-preview img-fluid" src="images/'. $cash .'" style="width: 15px; height: 15px;"></td>
                        <td><label style="font-size: 12px;" for="CASH">CASH</label></td>
                    </td>
                </tr>
                <tr style="">
                    <td colspan="" style="">';
                    if($kwi["radio"] == 'cheque') {$cheque = "checked.png";} else {$cheque = "unchecked.png";}

$html .=               '<td><img name="radio" class="img-preview img-fluid" src="images/'. $cheque .'" style="width: 15px; height: 15px;"> </td>   
                        <td><label style="font-size: 12px;" for="CHEQUE">CHEQUE</label></td>
                    </td>   
                </tr>
                <tr style="">
                    <td colspan="" style="">';
                    if($kwi["radio"] == 'bilyet giro') {$bilyet = "checked.png";} else {$bilyet = "unchecked.png";}

$html .=               '<td><img name="radio" class="img-preview img-fluid" src="images/'. $bilyet .'" style="width: 15px; height: 15px;"></td>
                        <td><label style="font-size: 12px;" for="BILYET GIRO">BILYET GIRO</label></td>
                    </td>
                </tr>
            
                <tr><td></td></tr>
                <tr><td></td></tr>
            
                <tr>
                    <td style="width: 5px;">Bank </td>
                    <td style="width: 2px;"> : </td>
                    <td class="border-bottom">'. $kwi["bank"] .'</td>
                </tr>
                <tr>
                    <td style="width: 5px;">No. </td>
                    <td style="width: 2px;"> : </td>
                    <td class="border-bottom">'. $kwi["no_pay"] .'</td>
                </tr>
                <tr>
                    <td style="width: 5px;">Tgl. </td>
                    <td style="width: 2px;"> : </td>
                    <td class="border-bottom">'. $kwi["tgl_pay"] .'</td>
                </tr>

            </table>

        </section>
        <section class="text-center" style="border-top: 2px solid black; margin-top: 15px;">
            <div style="padding: 5px 15px ;">
                <span>Kwitansi ini dianggap sah, setelah pembayaran dengan Bilyet Giro/Cheque tsb. dapat diuangkan.</span>
            </div>
            <div style="border-top: 2px solid; padding: 5px 0;">
                <span>This receipt will be cleared after Bilyet Giro/Cheque can be cleared</span>
            </div>
        </section>

    </section>

</body>
</html>
';


$mpdf->WriteHTML($html);



$mpdf->Output();

?>

