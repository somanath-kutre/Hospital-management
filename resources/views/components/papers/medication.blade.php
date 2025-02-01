<!DOCTYPE html>
<html>

<head>
    <style>
        .page-header,
        .page-header-space {
            height: 170px;
        }

        .center {
            text-align: center;
        }

        .underlined {
            text-decoration: underline;
        }

        .space {
            letter-spacing: 0.1em;
        }

        .neg-margin {
            margin-top: -10px;
        }

        .page-footer,
        .page-footer-space {
            height: 40px;
        }

        .page-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            border-top: 1px solid black;
        }

        .page-header {
            position: fixed;
            top: 0mm;
            width: 100%;
            /* border-bottom: 1px solid black; */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 0px 0px;
        }

        .tbody th,
        .tbody td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }

        #trh th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }

        #trh th {
            text-align: left;
        }

        .details td {
            text-align: left;
        }
        .title {
          font-size: 32px;
        }

        @media print {
            @page {
                size: A5 landscape;
                margin: 2mm;
            }

            #customers {
                margin-top: 20px;
            }

            .main-table {
                page-break-after: always;
            }

            .main-table:not(:first-child) {
                margin-top: 185px;
            }

            .main-table:last-child {
                page-break-after: avoid;
            }

            #tbody tr {
                page-break-inside: avoid;
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }

            button {
                display: none;
            }

            body {
                margin: 10;
            }
            .bold{
                font-weight:bold;
            }

            #tbody th,
            #tbody td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 10px;
            }

            #trh th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 10px;
            }

            #trh th {
                text-align: left;
            }

            .details td {
                text-align: left;
            }

            table {
                border-collapse: collapse;
                width: 100%;
                margin: 10px 0px;
            }

            .page-header-space {
                height: 14 0px;
            }

            .page-header {
                position: fixed;
                top: 0mm;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="">
        <div class="page-header hidden" style="text-align: center">
            <div class="header">
                {{-- <div class="info">
                    <h2 class="center underlined">ASHWINI HOSPITAL</h2>
                    <p class="center" style="margin-top: -10px">
                        Shivsagar Arcade, Ground Floor,1264, Ramling Khind, Belagavi -
                        590001 <span>Phone: 0831-2429214, 2408357</span>
                    </p>
                </div> --}}

                <div style="width: 100%; display: flex; flex-direction: row;margin-top:20px">
                    <div style="width: 20%">
                        <img
                        src="https://app.drsnshettihospital.com/img/logo.jpeg"
                        alt=""
                        style="width: 80%; margin-top: -10px"
                      />
                     <p style="margin-top: 2px;" class="bold">KMC Reg. No. 21465</p>
                    </div>
                    <div style="width: 80%">
                      <div style="margin-left: 10px;margin-top:-50px">
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
                          1264, Shivsagar Arcade, Ground Floor, Ramling Khind,
                         <br> BELAGAVI - 590 001, Phone: 0831-2429214, 2408357
                        </p>
                      </div>
                    </div>
                  </div>

                <div>
                    {{-- <div style="width: 60%; text-align: left; margin-left: 10px">
                        <span style="">
                            <strong>Dr. S. N. SHETTI</strong> MS, FAIS, FIAGES <br />
                            Consultant General Surgeon & Endoscopic Surgeon
                        </span>
                        <br />


                    </div> --}}
                    <div style="width: 100%; margin-top: -15px">
                        <table class="details">
                            <tr>
                                <td colspan="2">Name: <span class="ip_ptname bold"></span></td>
                                <td>OPD No: <span class="opd_no bold"></span></td>
                                <td>Age: <span class="ip_age bold"></span></td>
                                <td>Sex: <span class="ip_gender bold"></span></td>
                                <td>Date: <span class="ip_date bold"></span></td>
                            </tr>
                            {{-- <tr>
                                
                                <td>Date: <span class="ip_date_adm bold"></span></td>
                            </tr> --}}
                        </table>
                    </div>
                </div>
            </div>
            <hr style="border-bottom:1px solid #000000;margin:-10px 0px 10px 0px">
            <br />
            {{-- <button type="button" onClick="window.print()" style="background: pink">
                PRINT ME!
            </button> --}}
            <div style="float: left;;margin:-20px 0px 0px 10px">
                <svg xmlns="http://www.w3.org/2000/svg" height="32" width="28"
                    viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                        d="M32 0C14.3 0 0 14.3 0 32V192v96c0 17.7 14.3 32 32 32s32-14.3 32-32V224h50.7l128 128L137.4 457.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L288 397.3 393.4 502.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L333.3 352 438.6 246.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 306.7l-85.8-85.8C251.4 209.1 288 164.8 288 112C288 50.1 237.9 0 176 0H32zM176 160H64V64H176c26.5 0 48 21.5 48 48s-21.5 48-48 48z" />
                </svg>
            </div>
            <br>
        </div>

        <div class="page-footer hidden">

            <div style="display: flex">
                <div style="width: 70%; text-align: left; padding: 10px 5px">
                    <span style="font-size: 12px">Note:
                        1)Please check the medication given to you 2)No substitution
                        3) In case of doubt or any allergic recation contact your doctor
                        4) Please bring this prescription on your every visit without fail
                    </span>
                    <br />

                </div>
                <div style="width: 30%; margin-top: 10px ;margin-right: 20px;">
                    <table class="">
                        <tr>
                            <td colspan="2" style="text-align: right;">Doctor Signature</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <td>
                        <div class="page-header-space"></div>
                    </td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="div-pres">
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
    </div>

</body>


</html>
