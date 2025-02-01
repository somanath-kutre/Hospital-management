<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Opd Case Paper</title>

</head>

<body>


    <div class="printable_summary" id="printable_summary">
        <style>
            .title {
                font-size: 32px
            }

            .bold {
                font-weight: bold
            }

            .ipd_ptn_info {
                border-collapse: collapse;
                width: 100%;
                border-radius: 10px;
            }

            .ipd_ptn_info th,
            .ipd_ptn_info td {
                border: 1px solid black !important;
                padding: 8px;
                text-align: left;
            }

            .hosp_info {
                text-align: center;
            }

            .center {
                text-align: center;
            }

            .no-print {
                display: none;
            }

            .print_sign {
                position: fixed;
                bottom: 20;
                right: 40;
            }

            .bold {
                font-weight: bold;
            }

            .title {
                font-size: 32px;
            }

            @page :first {
                margin: 5mm;
                /* Set margin for the first page */
            }

            @page :not(:first) {
                margin: 5mm;
                /* Set margin for all pages except the first one */
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

        <div>
            <div style="width: 100%; display: flex; flex-direction: row">
                <div style="width: 25%">
                    <img src="https://app.drsnshettihospital.com/img/logo.jpeg" alt=""
                        style="width: 80%; margin-top: 25px" />
                    <p style="margin-top: 2px;" class="bold">KMC Reg. No. 21465</p>
                </div>
                <div style="width: 75%">
                    <div style="margin-left: 10px">
                        <p class="bold title" style="font-weight: bold;font-size:32px">ASHWINI HOSPITAL</p>
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
        </div>

        {{-- <div class="print_sign bold" style="font-size: 18px">
          Sign
        </div> --}}



        <br>

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

        <div class="opd_data_div" style="padding: 10px;">

        </div>

    </div>


</body>

</html>
