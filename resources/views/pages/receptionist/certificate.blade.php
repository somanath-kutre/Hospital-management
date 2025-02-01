<link rel="stylesheet" href="{{ asset('css/richtext.min.css') }}">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<x-app-layout>
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
            role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="opd-tab" data-tabs-target="#opd"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Fitness
                    Certificate</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="ipd-tab" data-tabs-target="#ipd" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Thanking Letter</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="other-tab" data-tabs-target="#other" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Medical Certificate</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="opd" role="tabpanel"
            aria-labelledby="profile-tab">

            <textarea class="content" name="example">
          <div class="main-cert">
            <div class="cert-sec" style="line-height:2;margin-top:50px;" >
                
            </div>   
          </div>
        </textarea>

            <div class="mt-5">
                <x-button id="print-cert">Print</x-button>
            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="ipd" role="tabpanel"
            aria-labelledby="dashboard-tab">

            <textarea class="referal-content" name="example">
                <div class="referal-cert">
                  <div class="referal-sec" style="line-height:2;" >
                      
                  </div>   
                </div>
                  
                 
              </textarea>

            <div class="mt-5">
                <x-button id="print-referal">Print</x-button>
            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="other" role="tabpanel"
            aria-labelledby="dashboard-tab">

            <div class="descr my-5">
                <x-label for="descr" value="{{ __('Select the certificate') }}" />
                <x-select id="certificates" class="certificates" name="" :title="'Select The Certificate'" :options="[
                    'AA' => 'Acute Appendicitis',
                    'CBA' => 'Chronic Breast Abscess',
                    '
                                                    ' => 'Chronic Fissure in Ano with Sentinel Pile',
                    'FB' => 'Fibroadema Breast',
                    'FA' => 'Fistula in Ano',
                    'HH' => 'Haemorhoide',
                    'HM' => 'Haemotoma',
                    'HC' => 'Hydrocele',
                    'IH' => 'Incisional Hernia',
                    'IUF' => 'Infected Ulcer Foot',
                    'OT' => 'Ovarian Tumor',
                    'PN' => 'Painful Neurofibroma',
                    'PIDFUA' => 'Pelvic Inflammatery Disease Fibrod Uterus Anemia.',
                    'PHS' => 'Phimosis',
                    'PS' => 'Pilonidal Sinus',
                    'RA' => 'Recurrent Appendicitis.',
                    'SC' => 'Seb Cyst(infected)',
                    'UH' => 'Umbalical Hernia',
                    'UC' => 'Ureteric Calculus.',
                ]" />

            </div>


            <textarea class="med-cert" name="example">
                <div class="med-certificates">
                  <div class="medcert-sec" style="line-height:2;margin-top:50px; font-size:18px" >
                      
                  </div>   
                </div>
                  
                 
              </textarea>

            <div class="mt-5">
                <x-button id="print-certs">Print</x-button>
            </div>
        </div>
    </div>

    <div class="letter_head_referal hidden">
        <x-papers.header_referal />
    </div>

    <div class="printable" id="printable">
        <div class="hidden">
            <x-letter-head />
        </div>
        <br>
    </div>

    <div class="head-title hidden">

    </div>

    <div class="hidden app_sign">
        <div class="" style="font-size:18px;margin-top:50px">
            <strong> Signature of the Applicatnt: </strong>
        </div>
    </div>

    <div class="thank_div hidden" >
        <div style="margin-top:-40px">Thanking you<br><br>
            <span>Yours Sincerely</span><br><br>
            <div><strong>Dr. S. N. Shetti</strong></div>
        </div>

    </div>

    <script src="{{ asset('js/jquery.richtext.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/certificates.js') }}"></script>

    <script>
        $(document).ready(function() {
            console.log(current_date);
        });
    </script>

    <script>
        $('.content').richText();
        $('.referal-content').richText();
        $('.med-cert').richText();

        $(document).ready(function() {

            $(".referal-sec").html(referal);
            $(".cert-sec").html(certificate);

            $("#print-cert").click(function(e) {
                e.preventDefault();
                var header = $("#printable").html();
                var cert_content = $(".main-cert").html();
                applicant_sign = $(".app_sign").html();

                title = $('.head-title').html(`${head_for_fitness}`);
                title = $('.head-title').html();

                var printWindow = window.open("");
                printWindow.document.write(html);
                printWindow.document.write(header);
                printWindow.document.write(title);
                printWindow.document.write(cert_content);
                printWindow.document.write(applicant_sign);
                printWindow.document.write(sign, date);
                printWindow.print();
                printWindow.close();
                console.log(cert_content);
            });

            $("#print-referal").click(function(e) {
                e.preventDefault();
                $(".refer_date").html(date);
                thanking = $('.thank_div').html();
                var refer_content = $(".referal-cert").html();
                var header = $('.letter_head_referal').html();
                var printWindow = window.open("");
                printWindow.document.write(header);
                printWindow.document.write(refer_content);
                printWindow.document.write(thanking);
                printWindow.print();
                printWindow.close();
            });

            $("#print-certs").click(function(e) {
                e.preventDefault();
                var header = $("#printable").html();
                var content = $(".med-certificates").html();

                title = $('.head-title').html(`${head_for_med_cert}`);
                title = $('.head-title').html();
                applicant_sign = $(".app_sign").html();

                var printWindow = window.open("");
                printWindow.document.write(html);
                printWindow.document.write(header);
                printWindow.document.write(title);
                printWindow.document.write(content);
                printWindow.document.write(applicant_sign);
                printWindow.document.write(sign, date);
                printWindow.print();
                printWindow.close();
            });

            $(".certificates").change(function(e) {
                e.preventDefault();
                var cert = $(".certificates").val();
                console.log(cert);
                $.each(cert_list, function(ind, val) {
                    if (val.name == cert) {
                        $(".medcert-sec").html(`${val.html}`);
                    }
                });
            });
        });
    </script>
</x-app-layout>
