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

        @media print {
            @page {
                margin: 2mm;
                size: A5;
                /* Set the page size to A5 */
            }

            .template_list table.table {
                page-break-after: always;
                margin-top: 330px !important;
            }

            .template_list table.table:not(:first-child) {
                position: relative;
                top: 330px;
                left: 0;
            }
            .template_list table.table:last-child {
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
            <div style="width: 30%">
                <img
                src="https://app.drsnshettihospital.com/img/logo.jpeg"
                alt=""
                style="width: 85%; margin-top: 25px"
              />
             <p style="margin-top: 2px;" class="bold">KMC Reg. No. 21465</p>
            </div>
            <div style="width: 70%">
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

        <div class="" style="font-size: 16px;margin:-10px 0px 10px 0px">
            TO, <br>
            <span class="scan_center bold"></span>
        </div>
        <div style="width: 97%;margin:10px 0px 30px 0px">
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
        </div>
        <div class="" style="font-size: 18px;text-align:center;margin:-20px 0px 10px 0px">
            Requisition For Investigation
        </div>
    </div>
    <div class="template_list"></div>

    <div style="width: 100%; position: fixed; bottom: 0">
        <table style="width: 100%">
            <tr>
                <td style="float: left;">
                    <span>Yours Sincerely,</span><br><br><br>
                    <div><strong>Dr. S. N. Shetti</strong></div>
                </td>
            </tr>

        </table>
    </div>
</body>

</html>
