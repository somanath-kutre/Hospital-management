<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        @page {
            margin: 2mm;
            size: A5;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .receipt {
            width: 148mm;
            /* A5 size */
            height: 102mm;
            /* Half of A5 size for two copies */
            /* border: 1px dashed #000; */
            margin: 2px;
            float: left;
            box-sizing: border-box;
            position: relative;
        }

        .header {
            text-align: center;
            padding: 5px;
        }

        .billing-info {
            padding: 20px;
        }

        .footer {
            text-align: center;
            position: absolute;
            bottom: 10px;
            right: 0;
        }

        .bold {
            font-weight: bold;
        }

        .amt_in_words,
        .p_mode,
        .b_descr {
            text-transform: capitalize;
        }
    </style>
</head>

<body>

    <!-- First Copy -->
    <div class="receipt" style="border-bottom: 1px dashed #000000;">
        <p style="text-align: center;color:#f5f5f5">Hospital Bill</p>
        <div class="header" style="position: absolute; top: 0; right: 0">
            <div style="margin: 10px">
                <table>
                    <tr>
                        <td class="bold">Phone:</td>
                        <td class="bold">2429214</td>
                    </tr>
                    <tr>
                        <td style="float: right" class="bold">:</td>
                        <td class="bold">2408357</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="billing-info" style="margin-top:-40px">
            <!-- Your billing information goes here -->
            <div class="" style="text-align: center">
                <h2>Ashwini Hospital</h2>
                <p style="margin-top: -10px;font-size: 16px;" class="bold">
                    Shivsagar Arcade, Ground Floor, 1264, Ramling Khind, BELGAUM-2
                </p>
            </div>
            <div style="margin-top: 10px; width: 100%">
                <table style="width: 100%">
                    <tr>
                        <td style="" colspan="2">
                            <span class="bold">Dr. S. N. Shetti </span><sub>M.S., F.A.I.S</sub>
                        </td>
                        <td></td>

                    </tr>
                    <tr>
                        <td style="width:33%">OPD No: <span class="bold opd_no" style="font-size:24px;"></span></td>
                        <td style="text-align: center; text-decoration: underline;width:33%;margin-top:5px">
                            <h3>OPD CARD</h3>
                        </td>
                        <td style="float: right; margin-top: 0px">
                            <span class="bold">Date: <span class="c_date"></span></span>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td style="width:33%">Patient ID: <span class="bold p_id"></span></td>
                    </tr> --}}
                </table>
            </div>

            <div style="margin-top: -10px;width:100%">
                <div style="line-height: 2;width:100%">
                    <table style="width:100%">
                        <tr>
                            <td colspan="3" style="padding: 5px 0px">  Name Mr./Mrs. <span class="bold p_name">Balawwa A Patil </span> </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0px">Age: <span class="bold age">35</span> </td>
                            <td style="padding: 5px 0px">Sex: <span class="bold gender"> Male</span> </td>
                            <td style="padding: 5px 0px">Phone: <span class="bold phone">86600089070 </span></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0px">  Created Date: <span class="bold c_date">25-12-2023</span></td>
                            <td style="padding: 5px 0px">  Valid Till: <span class="bold v_date">25-02-2024 </span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="footer" style="position: absolute; bottom: 0;left:8;text-align:center">
            <p class="" style="font-size:16px;margin-top: -10px; ">Please bring this card every time. Card is valid for two Months</p>
            <p class="bold" style="font-size:12px;margin-top: -10px; ">प्रत्येक वेळी येताना हे कार्ड जरूर आणावे. कार्ड फक्त 2 महिना अवधी राहिल.</p>
            <p class="bold" style="font-size:12px;margin-top: -10px; ">ಪ್ರತಿಸಲ ಬರುವಾಗ ಈ ಕಾರ್ಡುನ್ನುತರಬೇಕು. ಕಾರ್ಡು 2 ತಿಂಗಳ ಮಾತ್ರ ಅನ್ವಯವಾಗುತ್ತದೆ.</p>
            <p class="bold" style="font-size:18px;margin-top: -10px; "> INDOOR FACILITY & 24 HRS NURSING CARE</p>
           
        </div>
    </div>

    <!-- Second Copy -->
    <div class="receipt">
        <p style="text-align: center;color:#f5f5f5">Hospital Bill</p>
        <div class="header" style="position: absolute; top: 0; right: 0">
            <div style="margin: 10px">
                <table>
                    <tr>
                        <td class="bold">Phone:</td>
                        <td class="bold">2429214</td>
                    </tr>
                    <tr>
                        <td style="float: right" class="bold">:</td>
                        <td class="bold">2408357</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="billing-info" style="margin-top:-40px">
            <!-- Your billing information goes here -->
            <div class="" style="text-align: center">
                <h2>Ashwini Hospital</h2>
                <p style="margin-top: -10px;font-size: 16px;" class="bold">
                    Shivsagar Arcade, Ground Floor, 1264, Ramling Khind, BELGAUM-2
                </p>
            </div>
            <div style="margin-top: 10px; width: 100%">
                <table style="width: 100%">
                    <tr>
                        <td style="" colspan="2">
                            <span class="bold">Dr. S. N. Shetti </span><sub>M.S., F.A.I.S</sub>
                        </td>
                        <td></td>

                    </tr>
                    <tr>
                        <td style="width:33%">OPD No: <span class="bold opd_no" style="font-size:24px;"></span></td>
                        <td style="text-align: center; text-decoration: underline;width:33%;margin-top:5px">
                            <h3>OPD CARD</h3>
                        </td>
                        <td style="float: right; margin-top: 0px">
                            <span class="bold">Date: <span class="c_date">21-12-2023</span></span>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td style="width:33%">Patient ID: <span class="bold p_id"></span></td>
                    </tr> --}}
                </table>
            </div>

            <div style="margin-top: -10px;width:100%" >
                <div style="line-height: 2;width:100%">
                    <table style="width:100%">
                        <tr>
                            <td style="padding: 5px 0px" colspan="3">  Name Mr./Mrs. <span class="bold p_name">Balawwa A Patil </span> </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0px">Age: <span class="bold age">35</span> </td>
                            <td style="padding: 5px 0px">Sex: <span class="bold gender"> Male</span> </td>
                            <td style="padding: 5px 0px">Phone: <span class="bold gender">86600089070 </span></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0px"> Created Date: <span class="bold c_date">25-12-2023</span></td>
                            <td style="padding: 5px 0px">  Valid Till: <span class="bold v_date">25-02-2024 </span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="footer" style="position: absolute; bottom: 0;left:8;text-align:center">
            <p class="" style="font-size:16px;margin-top: -10px; ">Please bring this card every time. Card is valid for two Months</p>
            <p class="bold" style="font-size:12px;margin-top: -10px; ">प्रत्येक वेळी येताना हे कार्ड जरूर आणावे. कार्ड फक्त 2 महिना अवधी राहिल.</p>
            <p class="bold" style="font-size:12px;margin-top: -10px; ">ಪ್ರತಿಸಲ ಬರುವಾಗ ಈ ಕಾರ್ಡುನ್ನುತರಬೇಕು. ಕಾರ್ಡು 2 ತಿಂಗಳ ಮಾತ್ರ ಅನ್ವಯವಾಗುತ್ತದೆ.</p>
            <p class="bold" style="font-size:18px;margin-top: -10px; "> INDOOR FACILITY & 24 HRS NURSING CARE</p>
           
        </div>
    </div>
    
</body>
</html>