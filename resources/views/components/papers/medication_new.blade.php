<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        .center {
            text-align: center;
        }

        .underlined {
            text-decoration: underline;
        }

        .bold {
            font-weight: bold;
        }
        .title {
          font-size: 32px;
        }
        .details td{
            padding: 5px;
        }
        .details{
            margin: 5px 0px;
        }

        @media print {
            @page {
                margin: 2mm;
                size: A5 landscape;
                /* Set the page size to A5 */
            }

            .template_meds_list table.table {
                page-break-after: always;
                margin-top: 150px !important;
            }

            .template_meds_list table.table:not(:first-child) {
                position: relative;
                top: 150px;
                left: 0;
            }
            .template_meds_list table.table:last-child {
                page-break-after: avoid;
            }
        }
    </style>
</head>

<body>

    <div style="width: 100%; position: fixed;top:0;height:350px">

        <div style="float:right;margin:0px 10px -30px 0px">
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

        <div style="width: 100%; display: flex; flex-direction: row;">
            <div style="width: 20%">
                <img
                src="https://app.drsnshettihospital.com/img/logo.jpeg"
                alt=""
                style="width: 80%; margin-top: -10px"
              />
             <p style="margin-top: 2px;" class="bold">KMC Reg. No. 21465</p>
            </div>
            <div style="width: 80%">
              <div style="margin-left: 10px;margin-top:-40px">
                <p class="bold title" style="text-align: left">ASHWINI HOSPITAL</p>
                <hr style="border-bottom: 1px solid #000000; margin-top: -30px" />
                <p
                  style="
                    margin-top: -5px;
                    letter-spacing: 0.1em;
                    line-height: 1.2em;
                    text-align: left
                  "
                >
                  1264, Shivsagar Arcade, Ground Floor, <br>Ramling Khind,
                  BELAGAVI - 590 001
                </p>
              </div>
            </div>
          </div>

        {{-- <div style="width: 97%;margin:10px 0px 30px 0px">
            <table style="border-collapse:collapse;border:1px solid #000000;width:100%">
                <tr>
                    <td style="border:1px solid #000000;padding:10px" colspan="3" style="padding: 10px;">Patient
                        Name:
                        <span class="bold name"></span>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px;border:1px solid #000000;">Age: <span class="bold age"></span></td>
                    <td style="padding: 10px;border:1px solid #000000;">Sex: <span class="bold gender"></span></td>
                    <td style="padding: 10px;border:1px solid #000000;">Phone: <span class="bold phone"></span></td>

                </tr>

            </table>
        </div> --}}
        <div style="width: 100%; margin-top: -15px">
            <table class="details">
                <tr>
                    <td colspan="2">Name: <span class="ip_ptname bold"></span></td>
                    <td>OPD No: <span class="opd_no bold"></span></td>
                    <td>Age: <span class="ip_age bold"></span></td>
                    <td>Sex: <span class="ip_gender bold"></span></td>
                    <td>Date: <span class="prescription_date bold"></span></td>
                </tr>
                {{-- <tr>
                    
                    <td>Date: <span class="ip_date_adm bold"></span></td>
                </tr> --}}
            </table>
        </div>
        <hr style="border-bottom:1px solid #000000;margin:-10px 0px 10px 0px">
        <br />
        
    </div>
    <hr style="border-bottom:1px solid #000000;margin:-10px 0px 10px 0px">
    <div class="template_meds_list"></div>

    <div style="width: 100%; position: fixed; bottom: 0">
        <hr style="border-bottom:1px solid #000000;margin:-10px 0px">
        <div style="display: flex">
            <div style="width: 70%; text-align: left; padding: 10px 5px">
                <span style="font-size: 12px">Note:
                    1)Please check the medication given to you 2)No substitution
                    3) In case of doubt or any allergic recation contact your doctor
                    4) Please bring this prescription on your every visit without fail
                </span>
                <br />

            </div>
            <div style="width: 30%; margin-top: 25px ;text-align:right;margin-right:15px">
                Doctor Signature
            </div>
        </div>
    </div>
</body>

</html>
