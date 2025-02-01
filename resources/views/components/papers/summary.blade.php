<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Summary</title>

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

        /* Print-specific styles */
      @media print{
        page:first{
            background-color: red;
        }
      }
    </style>
</head>

<body>


    <div class="printable_summary" id="printable_summary" >

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

        <table style="width:100% !important;border-collapse:collapse;">
            <tr>
                <td style="border:1px solid #000000;padding:5px;padding:5px" class="bold">IPD
                    Registration No: <strong class="sum_regno"></strong></td>
                <td style="border:1px solid #000000;padding:5px;padding:5px" class="bold">OPD
                    No: <strong class="sum_opdno"></strong></td>
            </tr>
            <tr>
                <td style="border:1px solid #292424;padding:5px" class="bold"> Name: <strong
                        class="sum_name"></strong></td>
                <td style="border:1px solid #000000;padding:5px" class="bold"> Age: <strong class="sum_age"></strong>
                </td>
            </tr>
            <tr>
                <td style="border:1px solid #000000;padding:5px" class="bold p_address">Address: <strong
                        class="sum_address"></strong></td>
                <td style="border:1px solid #000000;padding:5px" class="bold p_discharge">
                    Doctor: <strong class="">S. N. Shetti</strong>
                </td>
            </tr>

            <tr>
                <td style="border:1px solid #000000;padding:5px" class="bold p_address">D.O.A: <strong
                        class="sum_doa"></strong></td>
                <td style="border:1px solid #000000;padding:5px" class="bold p_discharge">
                    D.O.D:
                    {{-- <strong class="sum_dod"></strong> --}}
                </td>
            </tr>
        </table>
        <br>

        <div
            style="border:1px solid black;text-align:center;padding:5px;margin:0px 200px;font-weight:bold;border-radius:5px;font-size:20px">
            Discharge Summary
        </div>

        <div>
            <div class="brief-summ" style="padding: 10px;">

            </div>
            <!-- Sign -->
        </div>
        

        

        <!-- Page break for last page -->
        <div class="page-break"></div>

    </div>

</body>
</html>
