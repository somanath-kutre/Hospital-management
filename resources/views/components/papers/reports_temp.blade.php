<div>


    <style>
        .prt_table {
            border-collapse: collapse;
            border: 1px solid #000000;
            page-break-before: always
        }

        .prt_table td,
        .prt_table th {
            border: 1px solid #000000;
            padding: 5px;
        }

        thead {
            display: table-header-group;
        }

        .title {
            font-size: 32px;
        }

        .bold {
            font-weight: bold;
        }
        .main_table_div table.prt_table:first-child {
                page-break-after: always;
                margin-top: 210px !important;
                width: 100%;
            }

            .main_table_div table.prt_table:not(:first-child) {
                position: relative;
                top: 210px;
                left: 0;
                width: 100%;
            }
            .main_table_div table.prt_table:last-child {
                page-break-after: avoid;
            }
    </style>
    <div style="position: fixed;top:0;left:0;padding: 0px 10px">
        <div style="width: 100%; display: flex; flex-direction: row">
            <div style="width: 25%">
                <img src="https://app.drsnshettihospital.com/img/logo.jpeg" alt=""
                    style="width: 80%; margin-top: 25px" />
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
          ">
                        1264, Shivsagar Arcade, Ground Floor, Ramling Khind, <br />
                        BELAGAVI - 590 001 Ph: 0831 2429214, 2408357
                    </p>
                </div>
            </div>
        </div>
        <div>
            <h2 style="letter-spacing: 0.1em;text-align:center;margin-top:-20px;">CASE REGISTER</h2>
            <div style="margin-top: -10px;text-align:center;font-size:24px">From:<span class="f_date bold"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                TO:<span class="t_date bold"></span></div>
        </div>
    </div>
    <div class="main_table_div" style="padding: 0px 10px">
        <table class="prt_table ">
            <thead class="">
                <tr>
                    <th>SL NO</th>
                    <th>PATIENT NAME</th>
                    <th>OPD NO</th>
                    <th>SERVICES</th>
                    <th>FEES RECIEVED</th>
                </tr>
            </thead>
            <tbody class="prt_body">
            </tbody>    
        </table>
    </div>

</div>