
<div class="operation_notes">
    <style>
        .padding-tb-small {
            padding: 10px 0px;
        }
        .bold {
          font-weight: bold;
        }
        .title {
          font-size: 32px;
        }
        @media print {
                @page {
                    size: A4; /* Set the page size to A5 */
                    margin: 10mm 5mm; /* Set the margins as needed */
                    padding: 20px;
                }
            }
    </style>
    {{-- header table  --}}

    {{-- <table class="" style="width:100%">
        <tr>
            <td class="padding-tb-small">
                <div class="bold center" style="font-size: 32px;">ASHWINI HOSPITAL</div>
            </td>
        </tr>
        <tr>
            <td class="padding-tb-small" class="b-500 ">
                <div class="center">1264, Shivsagar Arcade, Ground Floor,<br>Ramling Khind, BELGAUM -
                    590 001 <br> Ph: 0831 2429214, 2408357 <br><strong>Reg. No. BLG00151AANH</strong></div>
            </td>
        </tr>
    </table> --}}

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
    <hr style="border: 1px solid #000000;margin:-10px 0px 10px 0px">
    {{-- header table  ends --}}
    <div class="bold center underlined" style="font-size: 24px;margin-bottom:5px;">Operation Notes</div>

    <table style="width: 100%;border-collapse:collapse">
        <tr>
            <td class="padding-tb-small" colspan="2"> Patient Name:
                <span class="ip_ptname bold"></span>
            </td>
            <td class="padding-tb-small">Age:
                <span class="ip_age bold"></span> Years
            </td>
            <td class="padding-tb-small">Sex:
                <span class="ip_gender bold"></span>
            </td>
        </tr><br/>
        <tr>
            <td class="padding-tb-small" colspan="2">Relative:
                <span class="ip_hus_father_nm bold"></span>
            </td>
            <td class="padding-tb-small" colspan="2"> Address:
                <span class="ip_address bold">Shahapur Belagavi</span>
            </td>

        </tr>
        <br/>
        <tr>
            <td class="padding-tb-small"> OPD No:
                <span class="opd_no bold"></span>
            </td>
            <td class="padding-tb-small"> IPD No:
                <span class="ipd_no bold"></span>
            </td>
            <td class="padding-tb-small" colspan="2"> Date:
                <span class="bold"></span>
            </td>
        </tr>

        <tr>
            <td class="padding-tb-small" colspan="4">
                Pre-Operative Diagnosis: <span class=" bold"></span>
            </td>
        </tr>
        <tr>
            <td class="padding-tb-small" colspan="4">
                Operation: <span class="ip_operation bold"></span>
            </td>
        </tr>
        <tr>
            <td class="padding-tb-small" style="width: 33%">
                Surgeon: <span class="p_name bold">Dr. S. N. SHETTI</span>
            </td>
            <td class="padding-tb-small" style="width: 33%">
                O T Nurse: <span class=" bold"></span>
            </td>
            <td colspan="2" class="padding-tb-small" style="width: 33%">
                Assistant Name: <span class=" bold"></span>
            </td>
        </tr>

        <tr>
            <td colspan="2" class="padding-tb-small">Anaesthetist Name: <span class=" bold"></span></td>
            <td colspan="2" class="padding-tb-small">Type Of Anaesthesia: <span class=" bold"></span></td>
        </tr>
        <tr>
            <td colspan="2" class="padding-tb-small">Operation Start time: <span class=" bold"></span></td>
            <td colspan="2" class="padding-tb-small">Operation End time: <span class=" bold"></span></td>
        </tr>
        <tr>

        </tr>
    </table>
    <hr style="border: 1px solid #000000;margin:50px 0px">
    <div class="bold" style="min-height: 350px">Incision: </div>
    <div class="bold" style="min-height: 400px">Procedure: </div>
    <div class="bold" style="min-height: 300px">Findings: </div>
    <div style="min-height: 50px">
        <span class="bold" >Material for Histo-Pathology: </span> &nbsp; <span class="bold" style="border: 1px solid #000000;padding:0px 5px" >C/S | HPE</span>
       
    </div>
    <div class="bold" style="position: fixed; bottom:5;right:20;font-size:20px">Signature</div>
   

</div>
