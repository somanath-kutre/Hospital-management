$("#confirm_print").click(function(e) {
    e.preventDefault();
    $.each(p_data, function(ind, val) {
        pname = val.name;
        paddress = val.address;
        padmit = val.created_at;
        pdischarge = val.updated_at;
    });
    var contentToPrint = $("#printableContent").html();
    var table = `<table style="margin-bottom:30px">
     <tr>
<th colspan="3" class="center" ><h1>ASHWINI HOSPITAL</h1></th>

</tr>
<tr>
<th colspan="3"  style="text-align: center;">SHIVE SAGAR ARCADE 1264, RAMLINGKHIND , BELGAUM - 590002 </th>

</tr>
<tr>
<td class="bold">Dr. S. N. Shetti. (M.s, FAIS, FIAGES)</td>
<td class="bold">
<div style="display:flex;">
<div>Ph. No:</div>
<div style="margin-left:5px">2429214 <br/><br/>2408357</div>
</div>
</td>
</tr>
</table>`;

    patient_details = `<table style="">

<tr>
<td class="bold">Name: <strong>${pname}</strong> </td>
<td class="bold">
D.O.A: <strong>${padmit}</strong>
</td>
</tr>
<tr>
<td class="bold">Address: <strong>${paddress}</strong></td>
<td class="bold">
D.O.D: <strong>${pdischarge}</strong>
</td>
</tr>
</table>`;

    sign = `<div id="bottom-right-div">
<h4>Signature</h4>
</div>`;
    date = `<div id="bottom-left-div">
<h4>Date: 08/04/2023</h4>
</div>`
    // Open a new window and set its content to the div's content
    var printWindow = window.open("");
    printWindow.document.write(`<html><head><title>Print</title>
<style>       
@media print {

table {
border-collapse: collapse;
width: 100%;
border-radius:10px;
}

table th, table td {
border: 1px solid black !important;
padding: 8px;
text-align: left;

}
.hosp_info{
text-align:center;
}   

.bold{
font-weight:400;}
.center{
text-align: center
}
#bottom-right-div {
position: fixed;
bottom: 10px;
right: 10px;
padding: 10px; 
}
#bottom-left-div {
position: fixed;
bottom: 10px;
left: 10px;
padding: 10px; 
}
body {font-family: 'Poppins', sans-serif;
font-family: 'Work Sans', sans-serif; }

/* Hide non-printable elements */
.no-print {
display: none;
}
}</style></head><body>`);
    printWindow.document.write(table);
    printWindow.document.write(
        '<div><h3 class="">Patient Details</h3></div>');
    printWindow.document.write(patient_details);
    printWindow.document.write(
        '<div><h3 class="">Hospital Bill</h3></div>');
    printWindow.document.write(contentToPrint);
    printWindow.document.write(sign, date);


    printWindow.document.write('</body></html>');
    printWindow.document.close();
    // Print the new window's content
    printWindow.print();
    printWindow.close();

});