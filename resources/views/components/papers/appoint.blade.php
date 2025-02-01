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
        }
    </style>
</head>

<body>
    {{-- <div class="info">
        <h2 class="center underlined">ASHWINI HOSPITAL</h2>
        <p class="center" style="margin-top: -10px">
            Shivsagar Arcade, Ground Floor,1264, Ramling Khind, <br />
            Belagavi - 590002 <span>Phone: 0831-2429214, 2408357</span>
        </p>
    </div>

    <div style="width: 100%">
        <table style="width: 100%">
            <tr>
                <td>
                    <span style="">
                        <strong>Dr. S. N. SHETTI</strong> <sub>MS, FAIS, FIAGES</sub> <br />
                        <strong> Consultant General Surgeon & Endoscopic Surgeon</strong><br />
                        KMC Reg.No.21465
                    </span>
                </td>
                <td style="float: right">
                    <span class="refer_date bold"></span>
                </td>
            </tr>
        </table>
    </div> --}}
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

    <div style="width: 100%; position: fixed; bottom: 0">
        <table style="width: 100%">
            <tr>
                <td><strong></strong></td>
                <td style="float: right;margin-right:10px">
                    <div><strong>Signature</strong></div>
                </td>
            </tr>

        </table>
    </div>
    <div style="width: 100%;margin:10px 0px">
        <table style="width:100%">
            <tr>
                <td style="border-bottom:1px solid #000000;padding:5px" colspan="3" style="padding: 5px;">Patient Name:  <span class="ip_ptname bold"></span></td>
            </tr>
            <tr>
                <td style="padding: 5px;margin:0px 15px;border-bottom:1px solid #000000;">OPD No: <span class="opd_no bold"></span></td>
                <td style="padding: 5px;margin:0px 15px;border-bottom:1px solid #000000;">Date of Operation: <span class="bold"></span></td>
                <td style="padding: 5px;margin:0px 15px;border-bottom:1px solid #000000;">Time Of Reporting: <span class="bold"></span></td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #000000;padding: 5px;" colspan="3" >Opertaion: <span class="bold" ></span></td>
            </tr>

        </table>
    </div>

    <div class="bold" style="font-size: 20px;text-align:center;margin:10px 0px 10px 0px">
        APPOINTMENT FOR OPERATION
    </div>
  
    <div class="" >
        <div style="margin: 10px 0px 0px 0px;">Instructions to Patient (Pre-operative)</div>
        <input type="checkbox" ><label for="">Do not take any food or liquid after</label><br>
        <input type="checkbox" ><label for="">Wear Light Clothing</label><br>
        <input type="checkbox" ><label for="">Do not bring any Valuables/Gold Ornaments to the Hospital.</label><br>
        <input type="checkbox" ><label for="">One attender should accompany with the Patient</label><br>
        <input type="checkbox" ><label for="">No refund of advance paid for the absentees</label><br>
        <hr style="border:1px solid #000000">

        <div style="margin: 10px 0px 0px 0px;">पेशन्टसाठी सुचना :</div>
        <input type="checkbox" ><label for="" style="font-size: 12px;">_ _ _ _ _ _ _ _ _ _ _ _  नंतर काही खाऊ नये. पाणि सुद्धा पिऊ नये.</label><br>
        <input type="checkbox" ><label for="" style="font-size: 12px;">साधे कपडे घालावेत.</label><br>
        <input type="checkbox" ><label for="" style="font-size: 12px;">मौल्यवान वस्तु किंवा सोन्याचे दागिने आणू नयेत.</label><br>
        <input type="checkbox" ><label for="" style="font-size: 12px;">रूग्नासोबत एक नातेवाईक नेहमी असावा.</label><br>
        <input type="checkbox" ><label for="" style="font-size: 12px;">ऑपरेशनसाठी दिलेल्या तारखेन न आल्यास किंवा रद्द केल्यास भरलेली ॲडव्हान्स रक्कम, परत मिळणार नाही.</label><br>
        <hr style="border:1px solid #000000">
        
        <div style="margin: 10px 0px 0px 0px;">ರೊಗಿಗಳಿಗೆ ಸೂಚನೆ:</div>
        <input type="checkbox" ><label for="" style="font-size: 12px;">_ _ _ _ _ _ _ _ _ _ _ _ ನಂತರ ನೀರು ಅಥವಾ ಆಹಾರವನ್ನು ಸೇವಿಸಬಾರದು</label><br>
        <input type="checkbox" ><label for="" style="font-size: 12px;">ಸಾದಾ ಬಟ್ಟೆ ಧರಿಸಬೇಕು.</label><br>
        <input type="checkbox" ><label for="" style="font-size: 12px;">ಪೇಷಂಟ ಬರುವಾಗ ಯಾವುದೇ ಬೆಳ್ಳಿ ಬಂಗಾರ ಅಭರಣ ಧರಿಸಬಾರದು.</label><br>
        <input type="checkbox" ><label for="" style="font-size: 12px;">ಪೇಷಂಟ ಜೊತೆ ಒಬ್ಬರು ಇರತಕ್ಕದ್ದು.</label><br>
        <input type="checkbox" ><label for="" style="font-size: 12px;">ಆಪರೇಷನ ತಾರಿಖಿಗೆ ಹಾಜರ ಇಲ್ಲ ದಿದ್ದಲ್ಲಿ ತುಂಬಿರುವ ಅಡವಾನ್ಸ ಹಣ ವಾಪಸ ಸಿಗುವುದಿಲ್ಲ.</label><br>


    </div>
</body>

</html>
