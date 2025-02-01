<x-app-layout>

    <div class="meds">
        <x-papers.medication />
    </div>


    <div class="p-4">
        <x-button class="btn-prt-meds">Print it</x-button>
    </div>



    <script>
        $(document).ready(function() {
            print_meds();

            function print_meds() {
                var list = <?php echo $medicines; ?>;
                var p_data = <?php echo $patient_data; ?>;

                p_name = p_data[0]['patient_name'];
                p_age = p_data[0]['p_age'];
                p_reg = p_data[0]['aid'];
                opd_no = p_data[0]['opd_no'];
                p_a_date = p_data[0]['admission_date'];
                p_sex = p_data[0]['gender'];

                $('.ip_ptname').html(p_name);
                $('.ip_age').html(p_age);
                $('.opd_no').html(opd_no);
                $('.ip_reg_no').html(p_reg);
                $('.ip_date_adm').html(p_a_date);
                $('.ip_gender').html(p_sex);
                $('.ip_date').html(p_a_date);
                var n = 0;
                var currentTable = createNewTable(); // Initialize with the first table

                $.each(list, function(ind, val) {
                    var divHeight = currentTable.height();
                    console.log("Current Table Height: " + divHeight + " pixels");

                    if (divHeight > 320) {
                        currentTable = createNewTable(); // Create a new table if the height exceeds 400px
                    }

                    // If this is the first row in the new table, add the table header
                    if (currentTable.find("tbody").children().length === 0) {
                        currentTable.find("thead").append(`
  <tr id="trh" style="">
    <th style="width:10%">SL NO</th>
    <th><span style="margin-left:5px">Name Of The Drug</span></th>
    <th>Dosage</th>
    <th>Qty</th>
  </tr>
`);
                    }

                    currentTable.find(".tbody").append(`
<tr role="row">
  <td rowspan="1" colspan="1">${(n = n + 1)}</td>
  <td rowspan="1" colspan="1">${val.medicine}</td>
  <td rowspan="1" colspan="1">${val.dosage}</td>
  <td rowspan="1" colspan="1">${val.strenth}</td>
</tr>
`);
                });

                // Function to create a new table and append it to the .div-pres element
                function createNewTable() {
                    var newTable = $(
                        "<div class='main-table'><table id='customers' style='margin: 0px'><thead></thead><tbody class='tbody'></tbody></table></div>"
                    );
                    $(".div-pres").append(newTable);
                    return newTable;
                }
            }

            $('.btn-prt-meds').click(function(e) {
                e.preventDefault();
                var html = $('.meds').html();
                var printWindow = window.open("");
                printWindow.document.write(html);
                printWindow.print();
                printWindow.close();
                window.location.href = "/receptionist/patients";
            });

            trigger_print();

            function trigger_print() {
                $('.btn-prt-meds').trigger('click');
            }
        });
    </script>
</x-app-layout>
