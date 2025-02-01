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
            margin: 5px;
            float: left;
            box-sizing: border-box;
            position: relative;
        }

        .header {
            text-align: center;
            padding: 10px;
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
        <div class="billing-info" style="margin-top:-20px">
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
                        <td style="width:33%">Recipt No: <span class="bold bill_no"></span></td>
                        <td style="text-align: center; text-decoration: underline;width:33%;margin-top:5px">
                            <h3>RECEIPT</h3>
                        </td>
                        <td style="float: right; margin-top: 0px">
                            <span class="bold">Date: <span class="bill_date">21-12-2023</span></span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:33%">Patient ID: <span class="bold p_id"></span></td>
                    </tr>
                </table>
            </div>

            <div style="margin-top: -10px;">
                <div style="line-height: 2">
                    <p style="text-align: left; font-size: 18px">
                        Received from Mr./Mrs. <span class="bold p_name">Balawwa A Patil </span> the
                        sum of Rupees <span class="bold amt_in_words">Three hunderd</span> By
                        <span class="bold p_mode">CASH / UPI </span> towards
                        <span class="bold b_descr">follow-up charges.</span>
                        <br>
                        <span class="bold" style="font-size: 22px;">Rs. <span style="text-decoration: underline;" class="b_amount">500</span></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="footer" style="position: absolute; bottom: 10px; right: 10px">
            <p class="bold">Signature</p>
        </div>
    </div>

    <!-- Second Copy -->
    <div class="receipt">
        <p style="text-align: center; color:#f5f5f5">Patient's Bill</p>
        <div class="header" style="position: absolute; top: 10; right: 0">
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
        <div class="billing-info" style="margin-top:-20px">
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
                        <td style="width:33%">Recipt No: <span class="bold bill_no">1234</span></td>
                        <td style="text-align: center; text-decoration: underline;width:33%;margin-top:5px;">
                            <h3>RECEIPT</h3>
                        </td>
                        <td style="float: right; margin-top: 0px">
                            <span class="bold">Date: <span class="bill_date">21-12-2023</span></span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:33%">Patient ID: <span class="bold p_id"></span></td>
                    </tr>
                </table>
            </div>

            <div style="margin-top: -10px;">
                <div style="line-height: 2">
                    <p style="text-align: left; font-size: 18px">
                        Received from Mr./Mrs. <span class="bold p_name">Balawwa A Patil </span> the
                        sum of Rupees <span class="bold amt_in_words">Three hunderd</span> By
                        <span class="bold p_mode">CASH / UPI </span> towards
                        <span class="bold b_descr">follow-up charges.</span>
                        <br>
                        <span class="bold" style="font-size: 22px;">Rs. <span style="text-decoration: underline;" class="b_amount">500</span></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="footer" style="position: absolute; bottom: 5px; right: 10px">
            <p class="bold">Signature</p>
        </div>
    </div>

</body>

</html>