<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

  </head>
  <body>
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
      @media print {
        @page {
          margin: 2mm;
          size: A5; /* Set the page size to A5 */
        }
      }

        .title {
          font-size: 32px;
        }
    </style>

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

    {{-- <div class="info">
      <h2 class="center underlined">ASHWINI HOSPITAL</h2>
      <p class="center" style="margin-top: -10px">
        Shivsagar Arcade, Ground Floor,1264, Ramling Khind, <br />
        Belagavi - 590002 <span>Phone: 0831-2429214, 2408357</span>
      </p>
    </div> --}}

    {{-- <div style="width: 100%">
      <table style="width: 100%">
        <tr>
          <td>
            <span style="">
              <strong>Dr. S. N. SHETTI</strong> <sub>MS, FAIS, FIAGES</sub>  <br />
              <strong> Consultant General Surgeon & Endoscopic Surgeon</strong
              ><br />
              KMC Reg.No.21465
            </span>
          </td>
          <td style="float: right">
          <span class="refer_date bold"></span>
          </td>
        </tr>
      </table>
    </div> --}}


    <div style="width: 100%; display: flex; flex-direction: row;margin-top:20px">
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
    <div style="margin:-20px 0px -30px 0px">
      <span class="refer_date bold"></span>
    </div>

    {{-- <div style="width: 100%; position: fixed; bottom: 0">
      <table style="width: 100%">
        <tr>
          <td></td>
          <td style="float: right;margin-right:10px">
            <span>Yours Sincerely,</span><br><br><br>
            <div><strong>Dr. S. N. Shetti</strong></div>
          </td>
        </tr>
        
      </table>
    </div> --}}
  </body>
</html>
