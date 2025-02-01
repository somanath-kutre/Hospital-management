<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <style>
      @media print {
            @page {
                size: A4 landscape; /* Set the page size to A5 */
                margin: 10mm 10mm; /* Set the margins as needed */
            }
        }
    .bsc-thead th {
      border: 1px solid #000000;
      width: calc(100% / 10);
      padding: 10px 0px;
    }
    .bsc-body td {
      border: 1px solid #000000;
      width: calc(100% / 10);
      padding: 20px 0px;
    }
    table {
      border-collapse: collapse;
    }
    .bold{
        font-weight: bold;
    }
    @page{
        margin : 2mm;
    }
  </style>
  <body>
    <style>
       @page {
                size: A4 landscape; /* Set the page size to A5 */
                margin: 5mm 10mm; /* Set the margins as needed */
            }
    </style>
    <div class="page-header" style="text-align: center">
      <div class="header">
        <!-- <div class="info">
          <h2 class="center underlined" style="margin-top: 0px">
            ASHWINI HOSPITAL
          </h2>
        </div> -->

        <div style="width: 100%">
          <table style="width: 100%">
            <tr>
              <td class="left" style="width: 33%;">
                <div style="text-align: left">
                  <h2>ASHWINI HOSPITAL</h2>
                  <p style="margin-top: -20px">
                    Shivsagar Arcade, Ramling Khind,
                    <br />Belagavi - 590002 <br />
                    <span>Phone: 0831-2429214, 2408357</span>
                  </p>
                </div>
              </td>

              <td class="" style="text-align: center;width: 33%;">
                <div style="text-align: left;"><h2>BLOOD SUGAR CHART</h2></div>
              </td>
              <td class="left" style="width: 33%;">
                <div style="width: 100%; margin-top: 0px;">
                  <table class="details">
                    <tr>
                      <td colspan="2" style="text-align: left;">Patient Name: <span class="ip_ptname bold">Rohit Rajendra Takale</span></td>
                    </tr>
                    <tr>
                      <td style="text-align: left;">Ward: <span class="ip_ward bold"></span></td>
                      <td style="text-align: left;">Bed No: <span class="ip_bed_no bold"></span></td>
                    </tr>
                    <tr>
                      <td colspan="2" style="text-align: left;">Consultant Dr. <span class="bold">Shridhar Shetty</span></td>
                    </tr>
                  </table>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <br />
    </div>
    <div>
      <table style="width: 100%">
        <thead class="bsc-thead">
          <tr>
            <th>DATE</th>
            <th>TIME</th>
            <th>F.B.S</th>
            <th>PRE LUNCH</th>
            <th>P.P.B.S</th>
            <th>PRE DINNER</th>
            <th>R.B.S</th>
            <th>UNITS</th>
            <th></th>
            <th>REMARKS</th>
          </tr>
        </thead>
        <tbody class="bsc-body"></tbody>
      </table>
    </div>
  </body>
  <script>
    $(document).ready(function () {
      for (var i = 0; i < 13; i++) {
        $(".bsc-body").append(`<tr>
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
