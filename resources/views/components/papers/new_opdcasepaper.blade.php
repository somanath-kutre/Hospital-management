<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OPD Card New</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .bold {
            font-weight: bold;
        }

        .title {
            font-size: 32px;
        }

        @page {
            margin: mm;
        }

        .new_opd_header {
            position: fixed;
            top: 0;
            page-break-after: always;
        }

        .info_table {
            border-collapse: collapse;
            border: 1px solid #000000;
        }

        .info_table tr,
        .info_table td {
            border: 1px solid #000000;
        }
    </style>
</head>

<body>
    <div class="new_opd_header" style="width: 100%">
        <div style="width: 100%; display: flex; flex-direction: row">
            <div style="width: 25%">
                <img src="https://app.drsnshettihospital.com/img/logo.jpeg" alt=""
                    style="width: 80%; margin-top: 25px" />
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
                line-height: 1.5em;
              ">
                        1264, Shivsagar Arcade, Ground Floor, Ramling Khind, <br />
                        BELAGAVI - 590 001 Ph: 0831 2429214, 2408357
                    </p>
                </div>
            </div>
        </div>

        <div style="width: 100%">
            <div style=" text-align: center;font-size: 24px;font-weight: bold;margin-bottom: 5px;margin-top:-20px;">
                OPD Case Paper
            </div>
            <table style="width: 98%" class="info_table">
                <tr>
                    <td style="width: 10%; padding: 5px">
                        <span class="bold">Patient ID: </span>
                    </td>
                    <td style="width: 40%; padding: 5px">
                        <span class="p_id bold"></span>
                    </td>
                    <td style="width: 12%; padding: 5px">
                        <span class="bold">OPD NO: </span>
                    </td>
                    <td style="width: 18%; padding: 5px">
                        <span class="opd_no bold"></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%; padding: 5px">
                        <span class="bold">Name: </span>
                    </td>
                    <td style="width: 40%; padding: 5px">
                        <span class="ip_ptname"></span>
                    </td>
                    <td style="width: 12%; padding: 5px">
                        <span class="bold">Date: </span>
                    </td>
                    <td style="width: 18%; padding: 5px">
                        <span class="ip_date_adm"></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%; padding: 5px">
                        <span class="bold">Age: </span>
                    </td>
                    <td style="width: 40%; padding: 5px">
                        <span class="ip_age"></span>
                    </td>

                    <td style="width: 12%; padding: 5px">
                        <span class="bold">Sex:</span>
                    </td>
                    <td style="width: 18%; padding: 5px">
                        <span class="ip_gender"></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%; padding: 5px">
                        <span class="bold">Address: </span>
                    </td>
                    <td style="width: 40%; padding: 5px">
                        <span class="ip_address"></span>
                    </td>
                    <td style="width: 12%; padding: 5px">
                        <span class="bold">Phone: </span>
                    </td>
                    <td style="width: 18%; padding: 5px">
                        <span class="ip_phone"></span>
                    </td>
                </tr>
                <tr>
                    <td style="width: 12%; padding: 5px">
                        <span class="bold">Refered By: </span>
                    </td>
                    <td colspan="3" style="width: 88%; padding: 5px">
                        <span class="ip_refr_dr"></span>
                    </td>
                </tr>
            </table>



            <table style="width: 98%;margin:-5px 0px 0px 0px;">
                <tr>
                <tr>
                    <td style="width: 12%; padding: 5px;border-right:1px solid #000000;">
                        <div style="padding:10px 0px;text-align:left" class="bold">SPO2:</div>
                        <div style="padding:10px 0px;" class="bold">PR:</div>
                        <div style="padding:10px 0px;" class="bold">BP:</div>
                    </td>
                    <td style="width: 40%; padding: 5px">

                    </td>
                    <td style="width: 12%; padding: 5px">

                    </td>
                    <td style="width: 18%; padding: 5px">

                    </td>
                </tr>
                </tr>
            </table>


            <table style="width: 98%;margin:-5px 0px 0px 0px;">
                <tr>
                <tr>
                    <td style="width: 12%; padding: 5px; height: 515px;border-right:1px solid #000000">

                    </td>
                    <td style="width: 40%; padding: 5px">

                    </td>
                    <td style="width: 12%; padding: 5px">

                    </td>
                    <td style="width: 18%; padding: 5px">

                    </td>
                </tr>
                </tr>
            </table>
        </div>

        {{-- <div
            style="
          border-left: 1px solid #000000;
          height: 620px;
          margin-left: 93px;
        ">
            
        </div> --}}

        <div style="position: fixed; bottom: 0; left: 0; width: 100%; margin: 2mm">

            <hr style="border: 1px solid #000000" />
            <table style="width: 100%">
                <tr>
                    <td colspan="2" style="font-size: 18px">
                        I have recived all my investigations reports
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 18px">Date:</td>
                    <td style="font-size: 18px">Signature</td>
                </tr>
                <tr>
                    <td style="font-size: 18px">Time:</td>
                    <td style="font-size: 18px">Name:</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
