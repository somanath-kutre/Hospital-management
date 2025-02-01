<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IPD Card New</title>
  </head>

  <body>
    <div class="ipd_case_paper">
      <style>
        .bold {
          font-weight: bold;
        }
        .title {
          font-size: 32px;
        }

        @page {
          margin: 5mm;
        }

        .new_opd_header {
          position: fixed;
          top: 0;
          page-break-after: always;
        }

        .info_table_ipd {
          border-collapse: collapse;
          border: 1px solid #000000;
        }

        .info_table_ipd tr,
        .info_table_ipd td {
          border: 1px solid #000000;
        }

        @media print {
          .info_table_ipd {
            border-collapse: collapse;
            border: 1px solid #000000;
          }

          .info_table_ipd tr,
          .info_table_ipd td {
            border: 1px solid #000000;
          }

          /* Add any other print-specific styles here */
        }
      </style>
      <div style="width: 100%; display: flex; flex-direction: row">
        <div style="width: 25%">
            <img
            src="https://app.drsnshettihospital.com/img/logo.jpeg"
            alt=""
            style="width: 95%; margin-top: 25px"
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
                line-height: 1.5em;
              "
            >
              1264, Shivsagar Arcade, Ground Floor, Ramling Khind, <br />
              BELAGAVI - 590 001 Ph: 0831 2429214, 2408357
            </p>
          </div>
        </div>
      </div>

      <div style="width: 100%;margin-top:-30px" >
        <div
          style="
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;">
          IPD Case Paper
        </div>
        <table style="width: 100%" class="info_table_ipd">
          <tr>
            <td style="width: 10%; padding: 5px">
              <span class="bold">IPD NO: </span>
            </td>
            <td style="width: 40%; padding: 5px">
              <span class="ipd_no bold"></span>
            </td>

            <td style="width: 12%; padding: 5px">
              <span class="bold">OPD NO: </span>
            </td>
            <td style="width: 18%; padding: 5px">
              <span class="opd_no"></span>
            </td>
          </tr>

          <tr>
            <td style="width: 10%; padding: 5px">
              <span class="bold">Name: </span>
            </td>
            <td style="width: 40%; padding: 5px">
              <span class="ip_ptname bold"></span>
            </td>

            <td style="width: 12%; padding: 5px">
              <span class="bold">D.O.A: </span>
            </td>
            <td style="width: 18%; padding: 5px">
              <span class="ip_date_adm bold">20-01-2024</span> |
              <span class="ip_time_adm bold">12:30 pm</span>
            </td>
          </tr>

          <tr>
            <td style="width: 10%; padding: 5px">
              <span class="bold">Age: </span>
            </td>
            <td style="width: 40%; padding: 5px">
              <span class="ip_age bold"></span>
            </td>

            <td style="width: 12%; padding: 5px">
              <span class="bold">D.O.O: </span>
            </td>
            <td style="width: 18%; padding: 5px">
              <span class="ip_date_op bold"></span>
            </td>
          </tr>

          <tr>
            <td style="width: 10%; padding: 5px">
              <span class="bold">Sex:</span>
            </td>
            <td style="width: 40%; padding: 5px">
              <span class="ip_gender bold"></span>
            </td>

            <td style="width: 12%; padding: 5px">
              <span class="bold">D.O.D: </span>
            </td>
            <td style="width: 18%; padding: 5px">
              <span class=""></span>
            </td>
          </tr>

          <tr>
            <td style="width: 10%; padding: 5px">
              <span class="bold">Address: </span>
            </td>
            <td style="width: 40%; padding: 5px">
              <span class="ip_address bold"></span>
            </td>

            <td style="width: 12%; padding: 5px">
              <span class="bold">Contact No: </span>
            </td>
            <td style="width: 18%; padding: 5px">
              <span class="ip_phone bold"></span>
            </td>
          </tr>

          <tr></tr>
        </table>

        <!-- <table style="width: 100%;">
                <tr>
                    <td style="padding: 0px 10px;"><span class="">Patient ID: </span> <span class="" style="font-size: 28px;">1</span></td>
                    <td style="padding: 0px 10px;"><span class="">OPD ID: </span> <span class="" style="font-size: 28px;">1</span></td>
                    <td style="padding: 0px 10px;"><span class="">IPD ID: </span> <span class="" style="font-size: 28px;">1</span></td>
                </tr>
            </table> -->
      </div>

      {{-- <div
      style="
        border-left: 1px solid #000000;
        height: 640px;
        margin-left: 93px;
      "
    >     
    </div> --}}
      <div style="position: fixed; bottom: 0; left: 0; width: 100%; margin: 2mm">
        <!-- <div style="margin:10px" class="bold">SPO2: </div>
            <div style="margin:10px" class="bold">PR: </div> -->

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

      <!-- <div style="position: absolute;bottom:120;left:20">
            <div style="margin:10px" class="bold">SPO2: </div>
            <div style="margin:10px" class="bold">PR: </div>
        </div> -->
    </div>
  </body>
</html>
