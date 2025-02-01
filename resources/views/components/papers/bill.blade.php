<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
</head>
<style>
    table {
        /* border: 1px solid #000000; */
        border-collapse: collapse;
        width: 100%;
    }

    /* tr,
    td {
        border: 1px solid #000000;
    } */

    .collapse {
        border-collapse: collapse;
    }

    .border_tb {
        border: 1px solid #000000;
    }

    .center {
        text-align: center;
    }

    .no-margin {
        margin: 0;
    }

    .bold {
        font-weight: bold;
    }

    @page {
        margin: 5mm;
        size: A4;
    }

    .font-16 {
        font-size: 16px;
    }

    .font-18 {
        font-size: 18px;
    }

    .margin-5 {
        margin: 5px 10px;
    }

    .padding-x10-y5 {
        padding: 5px 10px;
    }

    .padding-10 {
        padding: 10px 10px;
    }

    .right {
        float: right;
    }

    .width-50 {
        width: calc(50%);
    }

    .neg-mar {
        margin-top: -10px;
    }
    .paid_in_words{
        text-transform: capitalize;
    }
    .bold {
        font-weight: bold;
      }

      .title {
        font-size: 32px;
      }
</style>

<body>
    <div>

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

        <div style="width: 100%; display: flex; flex-direction: row">
            <div style="width: 25%">
              <img
                src="https://app.drsnshettihospital.com/img/logo.jpeg"
                alt=""
                style="width: 80%; margin-top: 25px"/>
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

        <div class="neg-mar">
            <h3 class="center neg-mar">Bill No: <span class="p_regno"></span></h3>
            <table class="border_tb collapse neg-mar">
                <tr>
                    <td class="border_tb margin-5" style="width:70%">
                        <span class="font-18  margin-5">Name: <span class="bold p_name"> </span></span>
                    </td>
                    <td class="border_tb margin-5"><span class=" font-18 right ">D. O. A: <span class="bold p_admission"></span></span></td>
                </tr>
                <tr>
                    <td class="border_tb margin-5" style="width:70%">
                        <span class="font-18  margin-5">Address: <span class="bold p_address">Sankeshwar Belagavi</span></span>
                    </td>
                    <td class="border_tb margin-5 discharge_td">
                        <span class="font-18 right">D. O. D: <span class="bold p_discharge"></span></span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="neg-margin">
            <h3 class="center">Hospital Bill</h3>

            <table class="border_tb collapse" style="margin-top: -10px">
                <thead>
                    <tr>
                        <td class="border_tb">
                            <div class="margin-5 bold">Description</div>
                        </td>
                        <td class="border_tb">
                            <div class="margin-5 bold">Quantity</div>
                        </td>
                        <td class="border_tb">
                            <div class="margin-5 bold">Price</div>
                        </td>
                        <td class="border_tb">
                            <div class="margin-5 bold">Total</div>
                        </td>
                    </tr>
                </thead>
                <tbody class="hospital_bills">
                    <tr>
                        <td class="border_tb">
                            <div class="padding-x10-y5">Accommodation</div>
                        </td>
                        <td class="border_tb"><span class="padding-x10-y5">1</span></td>
                        <td class="border_tb"><span class="padding-x10-y5">1200</span></td>
                        <td class="border_tb"><span class="padding-x10-y5">1200</span></td>
                    </tr>
                </tbody>
                <tbody class="seprate_inj">
                    <tr>
                        <td colspan="4">
                            <div class="margin-5 bold">I V Fluids & Injections</div>
                        </td>
                    </tr>
                </tbody>
                <tbody class="iv_fluids_bill">
                    <tr>
                        <td class="border_tb">
                            <div class="padding-x10-y5">Injection</div>
                        </td>
                        <td class="border_tb"><span class="padding-x10-y5">1</span></td>
                        <td class="border_tb"><span class="padding-x10-y5">1200</span></td>
                        <td class="border_tb"><span class="padding-x10-y5">1200</span></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="border_tb">
                            <div class="padding-x10-y5 bold right">Total Amount: </div>
                        </td>
                        <td class="border_tb">
                            <div class="padding-x10-y5 bold tot_amt"></div>
                        </td>
                    </tr>
                    <tr class="dis_amt_sec">
                        <td colspan="3" class="border_tb">
                            <div class="padding-x10-y5 bold right">Discount: </div>
                        </td>
                        <td class="border_tb">
                            <div class="padding-x10-y5 bold dis_amt"></div>
                        </td>
                    </tr>
                    {{-- <tr class="adv_amt_sec">
                        <td colspan="3" class="border_tb ">
                            <div class="padding-x10-y5 bold right">Advance: </div>
                        </td>
                        <td class="border_tb">
                            <div class="padding-x10-y5 bold adv_amt">400</div>
                        </td>
                    </tr> --}}
                    <tr>
                        <td colspan="3" class="border_tb">
                            <div class="padding-x10-y5 bold right">Net Balance: </div>
                        </td>
                        <td class="border_tb">
                            <div class="padding-x10-y5 bold rec_amt"></div>
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="padding-x10-y5 font-18 bold margin-5">
            <span>Rupees <span class="paid_in_words"></span>Only</span>
            </div>

            <div class="padding-x10-y5 font-16 margin-5">
            <span>Room rent charges does not include diet charges </span>
            </div>

            <div>
                <p class="bold font-"></p>
            </div>
        </div>

        <div style="position: fixed;bottom:30;left:30;margin:10px">
            <span class="bold font-18">Date: </span>
        </div>
        <div style="position: fixed;bottom:30;right:30;margin:10px">
            <span class="bold font-18">Signature</span>
        </div>
    </div>
</body>
</html>