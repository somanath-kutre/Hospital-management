const html = `<html><head><title>Print</title>
<style>       
    @media print {
table {
border-collapse: collapse;
width: 100%;
border-radius:10px;
}

table th, table td {
// border: 1px solid black !important;
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
#bottom-left-div2 {
    position: fixed;
    bottom: 40px;
    left: 10px;
    padding: 10px; 
    }
    #bottom-left-div3 {
        position: fixed;
        bottom: 70px;
        left: 10px;
        padding: 10px; 
        }
.cert_content {
line-height: 1.5; 
}
.refer_content {
    line-height: 1.5; 
}
body {font-family: 'Poppins', sans-serif;
font-family: 'Work Sans', sans-serif; }

/* Hide non-printable elements */
.no-print {
display: none;
}
}</style></head><body>`;

var fullDate = new Date();
var tarik = fullDate.getDate();
var month = fullDate.getMonth() + 1; // Adding 1 to get the correct month
var varsh = fullDate.getFullYear();

// Adding leading zeros to day and month if they are less than 10
tarik = tarik < 10 ? '0' + tarik : tarik;
month = month < 10 ? '0' + month : month;

current_date = `${tarik}/${month}/${varsh}`;
console.log(current_date);


sign = `<div id="bottom-left-div" style="margin-bottom:80px;"><h4>Signature</h4></div>`;
date = `<div id="bottom-left-div"><h4>Date: ${current_date}</h4></div>`;

head_for_fitness = `<h2 class="center" style="margin-top:10px; text-decoration:underline ;line-height:30px;">CERTIFICATE OF MEDICAL FITNESS</h2>`;

head_for_med_cert = `<h2 class="center" style="margin-top:10px; text-decoration:underline ;line-height:30px;">MEDICAL CERTIFICATE</h2>`;

head_case_paper = `<h2 class="center" style="margin-top:10px; text-decoration:underline">OPD Case Paper</h2>`;

spo = `<div id="bottom-left-div3"><h4>SPO2: </h4></div>`;
pr = `<div id="bottom-left-div2"><h4>Date: </h4></div>`;
time = `<div id="bottom-left-div"><h4>Time: </h4></div>`;

const certificate = `<div><span style="font-size:18px;">I, </span><b><span style="font-size:18px;">Dr. Shridhar Shetty</span></b><span style="font-size:18px;"><span style="font-size:20px;"><span style="font-size:18px;"><span style="font-size:18px;"><span style="font-size:18px;"><span style="font-size:18px;"><span style="font-size:18px;"><span style="font-size:18px;"><span style="font-size:18px;"> do here certify that I have carefully examined Mr./Ms _______________________ son/daughter of _________ age ________ whose signature is given below, is fit both physically and mentally for duties in government/private organization. I further certify that before arriving this decision, I carefully reviewed his previous medical status.</span></span></span></span></span></span></span></span></span></div>`;

const referal = `<div style="text-align: left;"><br></div><div style="text-align: left;">Dear Dr. _ _ _ _ _ _ _ _ , Thanks for referring Mr./Mrs. _ _ _ _ _ _ _ _ _ _ _ _ _ . He/She is suffering from _ _ _ _ _ _ _ _ _ _&nbsp; .</div><div style="text-align: left;">I have prescribed the necessary medicines.&nbsp;</div><div style="text-align: left;">I have advised operation.&nbsp;</div><div style="text-align: left;">Urgent |&nbsp; Elective<br>This is for your kind information.</div><div style="text-align: left;"><br></div><div style="text-align: center;"><br></div>`;
const cert_list = [
    {
        name: "AA",
        html: `<span style="font-size:18px;">This is to Certify that Mrs.&nbsp; Prema Shekhar Nannoji age 35 years is Suffering from Appendicitis. She has undergone operation on. 25-04-2023 She was admitted on 21-04-2023 &amp; discharged on 28-04-2023. She is advised to take rest for one month from the date of Discharge.</span>`,
    },
    {
        name: "CBA",
        html: `<span style="font-size:18px;">This is to Certify that Mrs. Vaishali R. Badiger age 36 years is suffering from chronic breast abscess (Rt.) breast. She has undergone operation on 28-02-2023. She is advised to take rest for 5 days from date of discharge. She is fit to resume duty from 04-03-2023.</span>`,
    },
    {
        name: "CFASP",
        html: `<span style="font-size:18px;">This is to Certify that Mrs. GangammaS. Patil age 34 years is Suffering from Chronic fissure in ano with sentinel pile. She has undergone operation on 10-07-2019. She was admitted on 10-07-2019 &amp; discharged on11-07-2019. She is advised to take rest for Fifteen days from the date of Discharge.</span>`,
    },
    {
        name: "FB",
        html: `<span style="font-size:18px;">This is to Certify that Mrs. Vaishali R. Badiger age 36 years is suffering from chronic breast abscess (Rt.) breast. She has undergone operation on 28-02-2023. She is advised to take rest for 5 days from date of discharge.&nbsp; She is fit to resume duty from 04-03-2023.</span>`,
    },
    {
        name: "FA",
        html: `<span style="font-size: 18px;">This is to Certify that Mr. Praveen P. Patil age 23 years is Suffering from Fistula in Ano. He is Undergone Operation on 11-04-2019.&nbsp;</span><span style="font-size: 18px;">He was admitted on 11-04-2019 &amp; discharged on 14-04-2019.He is advised to take rest for 15 Day’s from the date of Discharge.</span>`,
    },
    {
        name: "HH",
        html: `<span style="font-size:18px;">This is to Certify that Mr. Nagangouda A. Meled age 32&nbsp; years is Suffering from Haemorhoide. He has undergone operation on 02-09-2021. He was admitted on 02-09-2021 &amp; discharged on 04-09-2021. He is advised to take rest for 15 days from the date of Discharge.</span>`,
    },
    {
        name: "HM",
        html: `<span style="font-size:18px;">This is to Certify that Mr. Sami Ahmed Khatib age 21&nbsp; years is Suffering from Haemotoma Right Leg. He is advised to take rest from 22-11-2022 to 12-12-2022 as out patient. He is fit resume his duty from 13-12-2022.</span>`,
    },
    {
        name: "HC",
        html: `<span style="font-size:18px;">This is to Certify that Mst. Ayush A Medar age 5 years is Suffering from Hydrocele. He is undergone Operation on 05-06-2019. He was admitted on 05-06-2019 &amp; discharged on 07-06-2019. He is advised to take rest one Month from the date of discharge.</span>`,
    },
    {
        name: "IH",
        html: `<span style="font-size:18px;">This is to Certify that Mrs. Geeta&nbsp; M&nbsp; Patil age 43&nbsp; years is Suffering from Incisional Hernia. She has undergone operation on 29-04-2019. She was admitted on 29-04-2019 &amp; discharged on 03-05-2019. She is advised to take rest for 2 months from the date of Discharge.</span>`,
    },
    {
        name: "IUF",
        html: `<span style="font-size:18px;">This is to Certify that Mrs. Namrata Nirmal Satgouda age 24 years is suffering from Infected ulcer foot Dibrament. She has undergone operation on 27-10-2022. She was admitted on 27-10-2022 &amp; discharged on 27-10-2022. She is advised to take rest for Ten days.</span>`,
    },
    {
        name: "OT",
        html: `<span style="font-size:18px;">This is to Certify that Mrs.&nbsp; Amita Amol Parkar age 35 years is Suffering from Ovarian Tumor. She has undergone operation on 21-11-2022. She was admitted on 21-11-2022 &amp; discharged on 25-11-2022. She is advised to take rest for 1 month. She is fit to resume duty from 01-01-2023</span>`,
    },
    {
        name: "PN",
        html: `<span style="font-size:18px;">This is to Certify that Mr. Sami Ahmed Khatib age 21&nbsp; years is Suffering from Haemotoma Right Leg. He is advised to take rest from 22-11-2022 to 12-12-2022 as out patient. He is fit resume his duty from 13-12-2022</span>`,
    },
    {
        name: "PIDFUA",
        html: `<span style="font-size:18px;">This is to Certify that Mrs. Sakhubai S. Khoragade&nbsp; age 40 years is Suffering from Pelvic Inflammatery Disease&nbsp; Fibrod&nbsp; Uterus Anemia. She has undergone operation on 03-09-2019. She was admitted on 30-08-2019 &amp; discharged on 10-09-2019. She is advised to take rest till 10-10-2019.</span>`,
    },
    {
        name: "PHS",
        html: `<span style="font-size:18px;">This is to certify that Mr. Amit&nbsp; Chandrakant&nbsp; Gavali Age 37 years is suffering from Phimosis. He is undergone Operation on 23-12-2022. He was admitted on 23-12-2022 &amp; discharged on 23-12-2022. He is advised to take rest till 12-01-2023.</span>`,
    },
    {
        name: "PS",
        html: `<span style="font-size:18px;">This is to Certify that Miss. Humataj I. Angolkar age 17 years is Suffering from Pilonidal Sinus. She has undergone Operation on 04-01-2019. She was admitted on 04-01-2019 &amp; discharged on 06-01-2019. She is advised to take rest from 05-01-2019 to 29-01-2019.</span>`,
    },
    {
        name: "RA",
        html: `<span style="font-size:18px;">This is to Certify that Mr. Sainath Balaram Karade Age 30 years is suffering from Appendicitis. He has undergone Operation on 10-01-2023. He was admitted on 10-01-2023 &amp; discharged on 13-01-2023. He is advised to take rest till 31-01-2023. He is fit to Resume Duty from 01-02-2023.</span>`,
    },
    {
        name: "SC",
        html: `<span style="font-size:18px;">This is to Certify that Mr. Suresh A. Pattar age 59&nbsp; years is Suffering from Hand Infection. He has undergone operation on 09-06-2022. He was admitted on 08-06-2022 &amp; discharged on 09-06-2022. He is advised to take rest for 10 days from the date of Discharge.</span>`,
    },
    {
        name: "UH",
        html: `<span style="font-size:18px;">This is to Certify that Mrs. Sapana M. Tashildar age 34 years is Suffering from Umbalical Hernia She has undergone operation on 07-05-2019. She was admitted on 07-05-2019 &amp; discharged on11-05-2019. She is advised to take rest for Fifteen days from the date of Discharge.</span>`,
    },
    {
        name: "UC",
        html: `<span style="font-size:18px;">This is to Certify that Mr. Shivaji S. Birnolli age 55 years is Suffering from (Rt) Upper Ureteric Calculus. He has undergone Operation on 02-04-2019. He was admitted on 01-04-2019 &amp; discharged on 06-04-2019. He is advised to take rest for one Month from the date of Discharge. He is fit to Resume Duty from 10-05-2019.</span>`,
    },
];
