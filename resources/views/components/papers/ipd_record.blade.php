<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
          @media print {
            @page {
                size: A4 landscape; /* Set the page size to A5 */
                margin: 10mm 2mm; /* Set the margins as needed */
            }
        }
      .page-header,
      .page-header-space {
        height: 120px;
      }
      .page-header-space {
        height: 14 0px;
        /* margin-bottom: 10px; */
      }


      .page-header {
        position: fixed;
        top: 0mm;
        width: 100%;
        /* margin-bottom: 20px; */
        /* border-bottom: 1px solid black;  */
        /* background: yellow;  */
      }
      .ipd-table {
        border-collapse: collapse;
      }
      .ipd-table th,
      .ipd-table td {
        border: 1px solid #000000;
        padding: 10px;
      }
      .page-footer,
      .page-footer-space {
        height: 30px;
      }
      .left{
        text-align: left;
      }

      .page-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        /* border-top: 1px solid black; */
        /* background: yellow;  */
      }
     
    </style>
  </head>
  <body>
    <style>
       @page {
        margin: 5mm 10mm;
        size: A4 landscape;
      }
    </style>
    <div class="page-header" style="text-align: center">
      <div class="header">
        <div class="info">
          <p
            style="
              text-align: left;
              padding: 5px;
              border: 1px solid #000000;
              border-radius: 5px;
              width: 180px;
              padding-left: 30px;
              margin-left: 30px;
              font-weight: bold;
            "
          >
            INPATIENT RECORD
          </p>
          <h2 class="center underlined" style="margin-top: -30px;font-size:32px">
            ASHWINI HOSPITAL
          </h2>
        </div>

       
        <div style="width: 100%;margin-top:-30px">
          <table style="width: 100%;">
            <tr>
              <td class="left" style="width:40%">NAME OF THE PATIENT: <span class=" ip_ptname bold"> </span></td>
              <td class="left" style="width:15%">D.O.A: <span class=" ip_date_adm bold"> </span></td>
              <td class="left" style="width:15%">D.O.O: <span class=" ip_date_op bold"> </span></td>
              <td class="left" style="width: 15%">D.O.D: <span class=" ip_date_dis"></span></td>
              <td class="left" style="width:15%">ROOM NO: <span class=" ip_room_no"></span> <hr> BED NO: <span class="ip_cot_no bold"></span></td>
            </tr>  
          </table>
        </div>
      </div>
      <br />
    </div>

    <div class="page-footer">
      <span style="font-weight: bold; padding: 0px 10px">M.O.Sign</span>
    </div>

    <table style="width: 100%">
      <thead>
        <tr>
          <td>
            <!--place holder for the fixed-position header-->
            <div class="page-header-space"></div>
          </td>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td class="div-pres">
            <div>
              <table class="ipd-table" style="width: 100%;">
                <thead>
                  <th style="width: 5%">SLNO</th>
                  <th style="width: 35%">DRUGS</th>
                  <th colspan="3" style="width: 10%"></th>

                  <th colspan="3" style="width: 10%"></th>

                  <th colspan="3" style="width: 10%"></th>

                  <th colspan="3" style="width: 10%"></th>

                  <th colspan="3" style="width: 10%"></th>

                </thead>
                <tbody class="tbody"></tbody>
              </table>
            </div>
          </td>
        </tr>
      </tbody>

      <tfoot>
        <tr>
          <td>
            <!--place holder for the fixed-position footer-->
            <div class="page-footer-space"></div>
          </td>
        </tr>
      </tfoot>
    </table>
  </body>
  <script>
    $(document).ready(function () {
      var n = 0;
      for (let i = 0; i < 14; i++) {
        n++;
        m = n;

        var word = "";
        if (n == 11) {
          word =
            '<div style="text-align:right !important;font-weight:bold">TEMP</div>';
        } else if (n == 12) {
          word =
            '<div style="text-align:right !important;font-weight:bold">PULSE</div>';
        } else if (n == 13) {
          word =
            '<div style="text-align:right !important;font-weight:bold">RESP</div>';
        } else if (n == 14) {
          word =
            '<div style="text-align:right !important;font-weight:bold">B.P</div>';
        } else {
          word = `&nbsp;`;
        }

        if (m > 10) {
          m = "";
        }

        $(".tbody").append(`
        <tr>
            <td>${m}</td>
            <td>${word}</td>

            <td></td>
            <td></td>
            <td></td>  
            
            <td></td>
            <td></td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>
            
        </tr>`);
      }
    });
  </script>
</html>
