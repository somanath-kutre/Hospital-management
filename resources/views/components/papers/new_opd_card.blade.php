<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Receipt</title>
    <style>
        @page {
            margin: 8mm;
            size: A5 landscape;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .receipt {
            /* width: 148mm; */
            /* A5 size */
            /* height: 102mm; */
            /* Half of A5 size for two copies */
            /* border: 1px dashed #000; */
            margin: 5px;
            /* float: left; */
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
            bottom: 0;
            right: 0;
            left: 0;
        }

        .bold {
            font-weight: bold;
        }

        .amt_in_words,
        .p_mode,
        .b_descr {
            text-transform: capitalize;
        }

        .line-around:after,
        .line-around:before {
            content: "\00a0\00a0\00a0\00a0\00a0";
            text-decoration: line-through;
        }
        .bold {
          font-weight: bold;
        }
        .title {
          font-size: 32px;
        }
    </style>
</head>

<body>
    <!-- First Copy -->
    <div class="receipt" >
        <p style="text-align: center; color: #f5f5f5"></p>
        <div class="header" style="position: absolute; top: 0; right: 0">
            <div style="margin: 30px">
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
        
        <div class="billing-info" style="margin-top: -40px">
            <!-- Your billing information goes here -->
            
    <div style="width: 100%; display: flex; flex-direction: row;margin-top:0px">
        <div style="width: 25%">
            <img
            src="https://app.drsnshettihospital.com/img/logo.jpeg"
            alt=""
            style="width: 85%; margin-top: 20px"
          />
         <p style="margin-top: 2px;" class="bold">KMC Reg. No. 21465</p>
        </div>
        <div style="width: 75%">
          <div style="margin-left: 10px">
            <p class="bold title">ASHWINI HOSPITAL</p>
            <hr style="border-bottom: 1px solid #000000; margin-top: -20px" />
            <p
              style="
                margin-top: -5px;
                letter-spacing: 0.1em;
                line-height: 1.2em;
              "
            >
              1264, Shivsagar Arcade, Ground Floor, <br>Ramling Khind,
              BELAGAVI - 590 001
            </p>
          </div>
        </div>
      </div>
          
            {{-- <div style="margin-top: 10px; width: 100%"> --}}
            <div style="margin-top: 6px; width: 100%">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 33%">
                            OPD No:
                            <span class="bold opd_no" style="font-size: 24px"></span>
                        </td>
                        <td
                            style="
                  text-align: center;
                  text-decoration: underline;
                  width: 33%;
                  margin-top: 5px;
                ">
                            <h3>OPD CARD</h3>
                        </td>
                        <td style="float: right; margin-top: 0px">
                            <span class="bold">Date: <span class="c_date"></span></span>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td style="width:33%">Patient ID: <span class="bold p_id"></span></td>
                    </tr> -->
                </table>
            </div>

            {{-- <div style="margin-top: 10px; width: 100%"> --}}
            <div style="margin-top: 6px; width: 100%">
                <div style="line-height: 2; width: 100%">
                    <table style="width: 100%">
                        <tr>
                            <td colspan="3" style="padding: 5px 0px">
                                Name:
                                <span class="bold p_name">Balawwa A Patil </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0px">
                                Age: <span class="bold age">35</span>
                            </td>
                            <td style="padding: 5px 0px">
                                Sex: <span class="bold gender"> Male</span>
                            </td>
                            <td style="padding: 5px 0px">
                                Phone: <span class="bold phone">86600089070 </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0px">
                                Created Date: <span class="bold c_date">25-12-2023</span>
                            </td>
                            <td style="padding: 5px 0px">
                                Valid Till: <span class="bold v_date">25-02-2024 </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="footer" >
        <p class="bold" style="font-size: 20px; border-top:1px dashed #000000">
            Only 2nd Visit is Free, there after consultation is chargeable
        </p>
        <p class="bold" style="font-size: 16px; margin-top: -10px">
            Please bring this card every time. Card is valid for two Months
        </p>
        <p class="bold" style="font-size: 12px; margin-top: -10px">
            प्रत्येक वेळी येताना हे कार्ड जरूर आणावे. कार्ड फक्त 2 महिना अवधी राहिल.
        </p>
        <p class="bold" style="font-size: 12px; margin-top: -10px">
            ಪ್ರತಿಸಲ ಬರುವಾಗ ಈ ಕಾರ್ಡುನ್ನುತರಬೇಕು. ಕಾರ್ಡು 2 ತಿಂಗಳ ಮಾತ್ರ ಅನ್ವಯವಾಗುತ್ತದೆ.
        </p>
        <p class="bold" style="font-size: 18px; margin-top: 0px">
            INDOOR FACILITY & 24 HRS NURSING CARE
        </p>

        <p style="margin-top: -10px;" class="line-around"><span class="bold">COSULTING HOURS</span></p>
        <table style="width: 100% ; margin-top: -10px;">
            <tr>
                <td class="bold" style="text-align: right; font-size: 18px">
                    11.30 to 1.00 pm &nbsp;&nbsp;&nbsp;
                </td>
                <td class="bold" style="text-align: left; font-size: 18px">
                    6.30 pm to 8.00 pm
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">
                    <div style="margin-top: 10px" class="bold">SUNDAY HOLIDAY</div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
