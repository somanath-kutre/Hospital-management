$(document).ready(function() {
    // Function to update the bill table
    function updateBillTable(bills) {
        var n = 0;
        $(".add_bill_table").html("");
        $.each(bills, function(ind, val) {
            n++;
            $(".add_bill_table").append(`
                <tr>
                    <td class="px-6 py-4">${n}</td>
                    <td class="hidden admission_id">${val.admission_id}</td>
                    <td class="px-6 py-4">${val.description}</td>
                    <td class="px-6 py-4">${val.amount}</td>
                    <td class="px-6 py-4">${val.qty}</td>
                    <td class="px-6 py-4">${val.amount}</td>
                    <td class="px-6 py-4">
                        <x-button class="hover:bg-white bg-white delete_it" id="delete_it" value="${val.id}">
                            <!-- Your SVG icon here -->
                        </x-button>
                    </td>
                </tr>
            `);
        });
    }

    // Handle the "btn_add_it" click event
    $("#btn_add_it").click(function(e) {
        e.preventDefault();
        var a_id = $(".a_id").val();
        var descr = $(".b_descr").val();
        var b_amt = $(".b_amt").val();
        var qty = $(".b_qty").val();
        var admission_type = "OPD";

        $.ajax({
            type: "POST",
            url: "{{ route('rec.add_new_bill') }}",
            data: {
                admission_id: a_id,
                description: descr,
                amount: b_amt,
                admission_type: admission_type,
                qty: qty
            },
            dataType: "json",
            success: function(response) {
                console.log(response.msg);
                var bills = response.bills;
                $(".b_descr, .b_amt, .b_qty").val("");
                $('#b_descr').focus();
                updateBillTable(bills);
            }
        });
    });

    // Handle the "btn_sub_tmp_bills" click event
    $("#btn_sub_tmp_bills").click(function(e) {
        e.preventDefault();
        var admission_id = $(this).val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save it !'
        }).then((result) => {
            if (result.isConfirmed) {
                confirmBill(admission_id);
            }
        });

        function confirmBill(admission_id) {
            $.ajax({
                type: "POST",
                url: "{{ route('rec.confirm_bill') }}",
                data: { admission_id },
                dataType: "json",
                success: function(response) {
                    console.log(response.msg, response.bills, response.check_bills);

                    if (response.check_bills) {
                        $(".pt_bill_modal").html("<h1>Bills are submitted successfully</h1>");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        alert("There are no bills to submit");
                    }
                }
            });
        }
    });

    // Handle the "delete_it" click event using event delegation
    $(document).on('click', '.delete_it', function(e) {
        e.preventDefault();
        var id = $(this).val();
        var a_id = $(".admission_id").html();

        $.ajax({
            type: "GET",
            url: "{{ route('rec.dlt_service') }}",
            data: { id, a_id },
            dataType: "json",
            success: function(response) {
                console.log(response);
                var bills = response.bills;

                if (response.msg == 'deleted') {
                    swal.fire("Deleted");
                    updateBillTable(bills);
                }
                if (response.msg == 'Unable to delete') {
                    swal.fire("Unable To Delete");
                }
            }
        });
    });

    // Handle the "btn_print" click event
    $(".btn_print").click(function(e) {
        e.preventDefault();
        var id = $(this).val();
        getToPrint(id);
        $("#confirm_print").val(id);

        function getToPrint(a_id) {
            var id = a_id;
            $.ajax({
                type: "GET",
                url: "{{ route('rec.get_to_print') }}",
                data: { id },
                dataType: "json",
                success: function(response) {
                    var p_data = response.patient_data;
                    console.log(p_data);
                    $(".patient_details").html("");
                    var bill_data = response.bill;
                    var amount = 0;
                    $(".final_print_table").html("");
                    $.each(bill_data, function(ind, val) {
                        amount += parseInt(val.amount * val.qty);
                        paid = val.paid;
                        $(".final_print_table").append(`
                            <tr>
                                <td class="py-2 px-4">${val.description}</td>
                                <td class="py-2 px-4">${val.qty}</td>
                                <td class="py-2 px-4">${val.amount}</td>
                                <td class="py-2 px-4">${val.amount * val.qty}</td>
                            </tr>
                        `);
                    });
                    $(".total").html(amount);
                    $(".paid").html(paid);

                    $("#confirm_print").click(function(e) {
                        e.preventDefault();
                        // Rest of your print code
                    });
                }
            });
        }
    });
});
