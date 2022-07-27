<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('images/icon.jpg') }}" rel="icon" type="image/gif">
    <title>Customer Information</title>

    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet" />

    {{-- bootstrap --}}
    <link href="{{ asset('assets/bootstrap-5.0.2/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/bootstrap-5.0.2/js/bootstrap.min.js') }}"></script>


    {{-- JQuery --}}
    <script src="{{ asset('assets/jquery-3.5.1.min.js') }}"></script>

    {{-- axios --}}
    <script src="{{ asset('assets/axios.min.js') }}"></script>


    {{-- SnackBar --}}
    <link href="{{ asset('assets/SnackBar-master/dist/snackbar.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/SnackBar-master/dist/snackbar.min.js') }}"></script>


    {{-- Cookie --}}
    <script src="{{ asset('assets/js.cookie.js') }}"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Customer.css') }}">

</head>

<body>

    <div class="container mt-3">

        {{-- <div class="loading" style="display: none">Loading&#8230;</div> --}}
        <div class="loading" style="display: none"><div></div><div></div><div></div><div></div></div>

        {{-- <div>
            <img src="{{ asset('images/UFUND.png') }}" alt="" style="width: 15%; cursor: pointer;" id="icon_ufond"
                onclick="window.location = '{{ url('/') }}'">
        </div> --}}
        <div class="row">
            <div class="col text-start">
                @include('templates.Icon_header')
                {{-- <h1>UAT</h1> --}}
            </div>
            <div class="col text-end align-self-center">
                <button type="button" id="logout" class="btn btn-sm btn-danger">ออกจากระบบ</button>
            </div>
        </div>

        <div class="row mt-3" style="font-size: 1.1rem;">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header" style="background-color: #18aba4; font-size: 1.2rem;">
                        ข้อมูลลูกค้า
                    </div>
                    <div class="card-body body_card_customer">

                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-9">
                                สวัสดีค่ะ/ครับ คุณ <u><span id="name"></span></u>
                                <br>
                                <span id="alertDate" style="color: red; display:none">[แจ้งเตื่อน]</span>
                                -----------------------------------------
                                <br>
                                ได้ทำการเช่าซื้อสินค้า : <u><span id="BRAND_NAME"></span></u>
                                <br>
                                รุ่นสินค้า : <u><span id="CATEGORY_NAME"></span></u>
                                <br>
                                รุ่นย่อย : <u><span id="SERIES_NAME"></span></u>
                                <br>

                                <span id="span_color">
                                    สี : <u><span id="COLOR_NAME"></span></u>
                                </span>
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-3 mt-3 text-center" style="display: none" id="div_QR">
                                <a id="href_QR">
                                    <h6>คลิกเพื่อสแกนชำระเงิน</h6>
                                    <img id="img_qrcode" src="{{ asset('images/QR_Code.png') }}"
                                        style="width: 8rem; border: 2px solid red;" class="mb-1">
                                    <p id="QR_price"> </p>
                                </a>
                            </div>
                        </div>
                        -----------------------------------------
                        <br>
                        ที่อยู่จัดส่งเอกสาร บ้านเลขที่ <u><span id="A2_NO"></span></u>
                        แขวง/ตำบล <u><span id="SUB_DISTRICT_NAME"></span></u>
                        เขต/อำเภอ <u><span id="DISTRICT_NAME"></span></u>
                        จังหวัด <u><span id="PROVINCE_NAME"></span> <span id="SUB_DISTRICT_ID"></span></u>
                        <br>
                        <br>
                        <br>
                        ผ่อนชำระงวดละ <u><span id="INSTALL_AMT"></span> บาท</u>
                        จำนวนงวดที่ผ่อนทั้งหมด <u><span id="INSTALL_NUM"></span> งวด</u>
                        วันที่ชำระงวดแรก <u><span id="FIRST_DUEDATE"></span></u>
                        <br>
                        -----------------------------------------
                        <br>
                        <span id="Count_repay" style="color: red">ยอดเงินค่าเช่าซื้อคงเหลือ</span>
                        <br>
                        -----------------------------------------
                        <br>
                        บริษัทฯ จะมีอัพเดตใบแจ้งยอดชำระ ให้กับลูกค้าล่วงหน้า 15 วัน ก่อนถึงวันกำหนดชำระค่างวด 
                        หากชำระล่าช้าบริษัทฯ จะมีการคิดค่าปรับ และค่าติดตามทวงถาม ตามเงื่อนไขของบริษัทฯ 
                        รายละเอียดแนบท้าย ตามใบแจ้งยอดชำระ
                        <br>
                    </div>
                    <div class="card-footer footer_card_customer">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-3" style="cursor: pointer;" title="ดาวน์โหลด"
                                id="PDF_CONTRACT">
                                <i class="fas fa-file-pdf fa-lg" style="color: red;"></i>
                                PDF สัญญาเช่าซื้อ
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-3" style="cursor: pointer;" title="ดาวน์โหลด"
                                id="PDF_RPDOWN">
                                <i class="fas fa-file-pdf fa-lg" style="color: red;"></i>
                                PDF ใบเสร็จเงินดาวน์
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-3" style="cursor: pointer;" title="ดาวน์โหลด"
                                id="PDF_TPDOWN">
                                <i class="fas fa-file-pdf fa-lg" style="color: red;"></i>
                                PDF ใบกำกับภาษีเงินดาวน์
                            </div>
                        </div>
                        -----------------------------------------
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-3" style="cursor: pointer;" title="ดาวน์โหลด"
                                id="PDF_TBDOWN">
                                <i class="fas fa-file-pdf fa-lg" style="color: red;"></i>
                                PDF ตารางค่างวด
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-9" style="cursor: pointer; display:none;"
                                title="ดาวน์โหลด" id="PDF_INSURANCE">
                                <i class="fas fa-file-pdf fa-lg" style="color: red;"></i>
                                PDF ใบรับสิทธิประโยชน์การประกันภัย
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <br>
                -------------------------------------------
                <br>
                <u>สินค้าที่เช่าซื้อ</u> : <span id="CATEGORY_NAME"></span>
                <br>
                <u>ยี่ห้อ</u> : <span id="BRAND_NAME"></span>
                <br>
                <u>รุ่น/แบบ</u> : <span id="SERIES_NAME"></span>
                <br> --}}

                <br>
            </div>
        </div>


        <div class="container-sm" style="margin-bottom: 5%">
            <div style="font-size: 1.6rem;" class="text_header_table">
                รายการใบแจ้งหนี้/การรับชําระ
            </div>
            <div class="table-responsive">
                <table class="table table-hover text-center table_customer">
                    <thead>
                        <tr>
                            <th scope="col">งวดที่</th>
                            <th scope="col">วันครบกำหนดชำระ</th>
                            <th scope="col">ค่างวด/เดือน</th>
                            <th scope="col">เลขที่ใบแจ้งหนี้</th>
                            <th scope="col">สถานะการชำระ</th>
                            <th scope="col">ยอดเงินเรียกเก็บ</th>
                            <th scope="col">ใบแจ้งหนี้ (PDF)</th>
                            <th scope="col">ใบเสร็จ (PDF)</th>
                            <th scope="col">ใบกำกับภาษี (PDF)</th>
                        </tr>
                    </thead>
                    <tbody id="Tbody">

                    </tbody>
                </table>
            </div>
        </div>

        <a href="javascript:;" id="testAnchor">
            {{-- <div class="text-center mt-3" style="margin-bottom: 10%">
            <button type="button" id="btn_calcu" class="btn btn-outline-dark" style="border-radius: 2rem;"> คํานวนยอดปิด
            </button>
        </div> --}}


            {{-- <div>
            <div class="button-corner" title="คำถามที่พบบ่อย" style="cursor: pointer;" id="btn_faq">
                <img src="{{ asset('images/FAQ.png') }}" alt="" style="width: 15%;">
            </div>
        </div> --}}


    </div>

</body>

</html>
<script>
    $(document).ready(function() {

        $(".loading").css("display", "block");

        var env = '{{ env('APP_ENV') }}';

        if (env == 'production') {
            env_K2_url = 'https://ufund.comseven.com'
        } else {
            env_K2_url = 'https://43.254.133.148'
        }

        // $(document).on('click', "#btn_calcu", function() {
        //     // window.open('https://10.102.1.12/Runtime/Runtime/Form/PreviewInvoiceAdhoc280820/?CONTRACT_ID=6050&ID=91010&INVOICE_ID=125773', '_blank');
        //     url =
        //         'https://10.102.1.12/Runtime/Runtime/Form/PreviewInvoiceAdhoc280820/?CONTRACT_ID=6050&ID=91010&INVOICE_ID=125773'
        //     var tab = window.open("");
        //     tab.document.write("<!DOCTYPE html><html>" + document.getElementsByTagName("html")[0]
        //         .innerHTML + "</html>");
        //     tab.document.close();
        //     window.location.href = url;
        //     // var url ='https://ufund.comseven.com/Runtime/Runtime/Form/Preview+Table+Calculate/?&app_id=101181&contract_id=1026';
        //     // getBase64FromUrl(dataURI)

        //     // axios({
        //     //         method: 'POST',
        //     //         url: 'TEST_API',
        //     //     }).then(function(response) {
        //     //         console.log(response);
        //     //     })
        //     //     .catch(function(error) {
        //     //         console.log(error);
        //     //     });

        // });


        // Function init
        List_Customer();

        var token = document.head.querySelector('meta[name="csrf-token"]');
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

        if (!Cookies.get('QUOTATION_ID') && !Cookies.get('APP_ID')) {
            window.location = '{{ url('/') }}';
        }

        console.log(Cookies.get())
        $('#name').text(Cookies.get('CUSTOMER_NAME'))

        var initial;

        function invocation() {
            initial = window.setTimeout(
                function() {
                    Redirect();
                }, 180000);
        }

        function Redirect() {
            // window.location = '{{ url('/') }}';
        }

        $("body").mouseover(function() {
            clearTimeout(initial)
            invocation();
        });


        var formatter = new Intl.NumberFormat('th-TH', {
            style: 'currency',
            currency: 'THB',
        });

        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }


        // var monthNamesThai = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม",
        //     "สิงหาคม", "กันยายน", "ตุลาคม", "พฤษจิกายน", "ธันวาคม"
        // ];

        // var dayNames = ["วันอาทิตย์ที่", "วันจันทร์ที่", "วันอังคารที่", "วันพุทธที่", "วันพฤหัสบดีที่",
        //     "วันศุกร์ที่", "วันเสาร์ที่"
        // ];

        function List_Customer() {
            axios({
                    method: 'POST',
                    url: 'List_Customer_Information',
                    data: {
                        Qid: (Cookies.get('QUOTATION_ID') ? Cookies.get('QUOTATION_ID') : null),
                        APP_ID: (Cookies.get('APP_ID') ? Cookies.get('APP_ID') : null),
                    }
                }).then(function(response) {
                    console.log(response.data);

                    $('#SERIES_NAME').text(response.data['product'][0].SERIES_NAME)
                    $('#CATEGORY_NAME').text(response.data['product'][0].CATEGORY_NAME)
                    $('#BRAND_NAME').text(response.data['product'][0].BRAND_NAME)
                    $('#COLOR_NAME').text(response.data['product'][0].COLOR_NAME)

                    if (!response.data['product'][0].COLOR_NAME) {
                        $('#span_color').css('display', 'none')
                    }

                    $('#A2_NO').text(response.data['Address'][0].A3_NO)
                    $('#SUB_DISTRICT_NAME').text(response.data['Address'][0].SUB_DISTRICT_NAME)
                    $('#DISTRICT_NAME').text(response.data['Address'][0].DISTRICT_NAME)
                    $('#PROVINCE_NAME').text(response.data['Address'][0].PROVINCE_NAME)
                    $('#SUB_DISTRICT_ID').text(response.data['Address'][0].POST_CODE_ID)


                    var First_date = new Date(response.data['Customer_card'][0].DUEDATE);
                    var First_result = First_date.toLocaleDateString(
                        "en-GB", {
                            year: "numeric",
                            month: "2-digit",
                            day: "2-digit",
                        });

                    $('#INSTALL_AMT').text(numberWithCommas(parseFloat(response.data['Customer_card'][0].INSTALL_AMT).toFixed(2)))
                    $('#INSTALL_NUM').text(response.data['Customer_card'].length)
                    $('#FIRST_DUEDATE').text(First_result)

                    if (response.data.PDF_INSURANCE) {
                        $('#PDF_INSURANCE').css('display', 'block')
                    }


                    // if (response.data.QR_Code) {
                    //     var data_QR_Code = response.data.QR_Code
                    //     var regex = /<img.*?src='(.*?)'/;
                    //     var src = regex.exec(data_QR_Code.QRCODE_FILE);
                    //     // console.log(src);
                    //     var elem = document.createElement("div");
                    //     elem.innerHTML = data_QR_Code.QRCODE_FILE;

                    //     var images = elem.getElementsByTagName("img");
                    //     var link_QR = null;
                    //     for (var i = 0; i < images.length; i++) {
                    //         link_QR = images[i].src;
                    //         // console.log(images[i].src);
                    //     }
                    //     $('#href_QR').attr("href", link_QR);
                    //     $('#href_QR').attr('target', '_blank');

                    //     var QR_amt = (data_QR_Code.INV_AMT.length) - 2;
                    //     var qr_int = '';
                    //     var qr_float = '';
                    //     var sum_qr = '';
                    //     for(let i = 0 ; i < data_QR_Code.INV_AMT.length; i++){
                    //         if(i < QR_amt){
                    //             qr_int += data_QR_Code.INV_AMT[i]
                    //         }else{
                    //             qr_float += data_QR_Code.INV_AMT[i]
                    //         }
                    //     }
                    //     sum_qr =  numberWithCommas(parseFloat(qr_int + '.' + qr_float).toFixed(2)) 
                    //     // alert(sum_qr)

                    //     $('#QR_price').text(sum_qr + ' บาท')

                    //     $('#div_QR').css("display", "block");
                    // }


                    // substr Date
                    // alert(response.data.today)
                    var today = response.data.today;
                    var now_day = today.split('/')[0];
                    var now_month = today.split('/')[1];
                    var now_year = today.split('/')[2];


                    var Customer_card = response.data.Customer_card;
                    var html = "";
                    var count_sum = 0
                    var text_data_late = '';
                    var REF_NO_data = null;

                    for (let i = 0; i < Customer_card.length; i++) {

                        // var d = new Date(Customer_card[i].DUEDATE);
                        // var date_card = Customer_card[i].DUEDATE;

                        var date = new Date(Customer_card[i].DUEDATE);
                        var result = date.toLocaleDateString(
                            "en-GB", {
                                year: "numeric",
                                month: "2-digit",
                                day: "2-digit",
                            });

                        var card_day = result.split('/')[0];
                        var card_month = result.split('/')[1];
                        var card_year = result.split('/')[2];

                        //  check Date Late
                        if (card_month < now_month && card_year <= now_year) {
                            if (Customer_card[i].RECEIPT_NUMBER == null) {
                                REF_NO_data = Customer_card[i].INVOICE_NUMBER;
                                text_data_late += result + ' , ';
                                $('#alertDate').css('display', 'block')
                            }
                        }

                        if (card_month == now_month && now_year == card_year) {
                            if ((now_day + 3) > card_day) {
                                if (Customer_card[i].RECEIPT_NUMBER == null) {
                                    text_data_late += result;
                                    // $('#alertDate').text('[* ค่างวดของท่านประจำวันที่ ' + result +
                                    //     ' เกินกำหนดชำระ กรุณาชำระเงินตามกำหนด]')
                                    $('#alertDate').css('display', 'block')
                                }
                            }

                            if (Customer_card[i].RECEIPT_NUMBER == null && Customer_card[i].INVOICE_NUMBER !=null) {
                                REF_NO_data = Customer_card[i].INVOICE_NUMBER;
                            }

                        }

                        if (card_month >= now_month && now_year >= card_year) {
                            if (Customer_card[i].RECEIPT_NUMBER == null && Customer_card[i].INVOICE_NUMBER != null) {
                                REF_NO_data = Customer_card[i].INVOICE_NUMBER;
                            }
                        }
                        // check Count Repay
                        if (Customer_card[i].RECEIPT_NUMBER == null) {
                            data = parseFloat(Customer_card[i].INSTALL_AMT).toFixed(2);
                            count_sum = parseFloat(count_sum) + parseFloat(data);
                        }

                        // html += '<tr>' +
                        //     '<th scope="row">' + Customer_card[i].INSTALL_NUM + '</th>' +
                        //     // '<td>' + Customer_card[i].DUEDATE + '</td>' +
                        //     '<td>' + result + '</td>' +
                        //     '<td>' + parseFloat(Customer_card[i].INSTALL_AMT).toFixed(2) + '</td>' +
                        //     '<td>' + (Customer_card[i].INVOICE_NUMBER != null ? Customer_card[i].INVOICE_NUMBER : '-') + '</td>' +
                        //     '<td>' + (Customer_card[i].RECEIPT_NUMBER != null ? 'ชำระเรียบร้อย' :'ยังไม่ชำระ') + '</td>' +
                        //     '<td>' + (Customer_card[i].SUM_AMT != null ? parseFloat(Customer_card[i].SUM_AMT).toFixed(2) : '-') + '</td>' +
                        //     '<td>' + (Customer_card[i].INVOICE_ID != null ?'<i class="fas fa-file-pdf fa-lg" style="color: red; cursor: pointer;" title="ดาวน์โหลด" id="PDF_INVOICE_NUMBER" data_value="' +Customer_card[i].INVOICE_ID + '" data_INVOICE_NUMBER="' + Customer_card[i].INVOICE_NUMBER + '"></i>' : '-') + '</td>' +
                        //     '<td>' + (Customer_card[i].REPAY_ID != null && Customer_card[i].INVOICE_NUMBER != 1 ?'<i class="fas fa-file-pdf fa-lg" style="color: red; cursor: pointer;" title="ดาวน์โหลด" id="PDF_REPAY_ID" data_value="' + Customer_card[i].REPAY_ID + '"  data_RECEIPT_NUMBER="' + Customer_card[i].RECEIPT_NUMBER + '"></i>' : '-') + '</td>' +
                        //     '<td>' + (Customer_card[i].TAX_INVOICE_ID != null && Customer_card[i].INVOICE_NUMBER != 1 ?'<i class="fas fa-file-pdf fa-lg" style="color: red; cursor: pointer;" title="ดาวน์โหลด" id="PDF_TAX_INVOICE" data_value="' +Customer_card[i].TAX_INVOICE_ID + '" data_RECEIPT_NUMBER="' + Customer_card[i].RECEIPT_NUMBER + '"></i>' : '-') + '</td>' +
                        //     '</tr>';

                        html += `
                            <tr>
                                <th scope="row"> ${Customer_card[i].INSTALL_NUM} </th>
                                <td> ${result} </td>
                                <td> ${parseFloat(Customer_card[i].INSTALL_AMT).toFixed(2)} </td>
                                <td> ${(Customer_card[i].INVOICE_NUMBER != null ? Customer_card[i].INVOICE_NUMBER : '-')} </td>
                                <td> ${(Customer_card[i].RECEIPT_NUMBER != null ? 'ชำระเรียบร้อย' : 'ยังไม่ชำระ')} </td>
                                <td> ${(Customer_card[i].SUM_AMT != null ? parseFloat(Customer_card[i].SUM_AMT).toFixed(2) : '-')} </td>
                                <td> ${(Customer_card[i].INVOICE_ID != null ? '<i class="fas fa-file-pdf fa-lg" style="color: red; cursor: pointer;" title="ดาวน์โหลด" id="PDF_INVOICE_NUMBER" data_value="' + Customer_card[i].INVOICE_ID + '" data_INVOICE_NUMBER="' + Customer_card[i].INVOICE_NUMBER + '"></i>' : '-')} </td>
                                <td> ${(Customer_card[i].RECEIPT_NUMBER != null && Customer_card[i].INVOICE_NUMBER != 1 ?'<i class="fas fa-file-pdf fa-lg" style="color: red; cursor: pointer;" title="ดาวน์โหลด" id="PDF_REPAY_ID" data_value="' + Customer_card[i].REPAY_ID + '"  data_RECEIPT_NUMBER="' + Customer_card[i].RECEIPT_NUMBER + '"></i>' : '-')} </td>
                                <td> ${(Customer_card[i].RECEIPT_NUMBER != null && Customer_card[i].TAX_INVOICE_ID != null && Customer_card[i].INVOICE_NUMBER != 1 ?'<i class="fas fa-file-pdf fa-lg" style="color: red; cursor: pointer;" title="ดาวน์โหลด" id="PDF_TAX_INVOICE" data_value="' +Customer_card[i].TAX_INVOICE_ID + '" data_RECEIPT_NUMBER="' + Customer_card[i].RECEIPT_NUMBER + '"></i>' : '-')} </td>
                            </tr>
                            `
                    }

                    if (REF_NO_data != null && REF_NO_data != 1) {
                        GET_QR_Code(REF_NO_data)
                    }

                    txtalert = '[* ค่างวดของท่านประจำวันที่ ' + text_data_late +
                        ' เกินกำหนดชำระ กรุณาชำระตามบิลเรียกเก็บ <br> และขออภัย หากท่านชำระเรียบร้อยแล้ว กรุณารอรับใบเสร็จ ภายใน 7วันทำการ ]'
                    $('#alertDate').html(txtalert)
                    $('#Tbody').html(html);
                    // $('#Count_repay').text('ยอดเงินค่าเช่าซื้อคงเหลือ ' + formatter.format(count_sum))
                    if(response.data.CONTRACT[0].STATUS_ID == "53" || response.data.CONTRACT[0].STATUS_ID == "40"){
                        $('#Count_repay').text('ยอดเงินค่าเช่าซื้อคงเหลือ 0 บาท')
                    }else{
                        $('#Count_repay').text('ยอดเงินค่าเช่าซื้อคงเหลือ ' + numberWithCommas(parseFloat(count_sum).toFixed(2)) + ' บาท')
                    }

                    $(".loading").css("display", "none");

                })
                .catch(function(error) {
                    console.log(error);
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                });
        }

        // Get QR_Code
        function GET_QR_Code(REF_NO_data) {
            $(".loading").css("display", "block");
            clearTimeout(initial)
            invocation();
            axios({
                    method: 'POST',
                    url: 'QR_Code',
                    data: {
                        Ref_NO: REF_NO_data,
                    },
                }).then(function(response) {
                    var data_QR_Code = response.data.QR_Code
                    // var regex = /<img.*?src='(.*?)'/;
                    // var src = regex.exec(data_QR_Code.QRCODE_FILE);
                    // console.log(src);
                    var elem = document.createElement("div");
                    elem.innerHTML = data_QR_Code.QRCODE_FILE;

                    var images = elem.getElementsByTagName("img");
                    var link_QR = null;
                    for (var i = 0; i < images.length; i++) {
                        link_QR = images[i].src;
                        // console.log(images[i].src);
                    }
                    $('#href_QR').attr("href", link_QR);
                    $('#href_QR').attr('target', '_blank');

                    $('#img_qrcode').attr("src", link_QR);

                    var QR_amt = (data_QR_Code.INV_AMT.length) - 2;
                    var qr_int = '';
                    var qr_float = '';
                    var sum_qr = '';
                    for (let i = 0; i < data_QR_Code.INV_AMT.length; i++) {
                        if (i < QR_amt) {
                            qr_int += data_QR_Code.INV_AMT[i]
                        } else {
                            qr_float += data_QR_Code.INV_AMT[i]
                        }
                    }
                    sum_qr = numberWithCommas(parseFloat(qr_int + '.' + qr_float).toFixed(2))
                    // alert(sum_qr)

                    $('#QR_price').text(sum_qr + ' บาท')

                    $('#div_QR').css("display", "block");
                    $(".loading").css("display", "none");
                })
                .catch(function(error) {
                    console.log(error);
                    setTimeout(function() {
                        // location.reload();
                    }, 5000);
                });
        }


        // INVOICE
        $(document).on("click", "#PDF_INVOICE_NUMBER", function(e) {
            var id = $(this).attr('data_value');
            var INVOICE_NUMBER = $(this).attr('data_INVOICE_NUMBER')
            var iurl = 'PDF_INVOICE';
            GET_PDF_Table(iurl, id, 'INVOICE', INVOICE_NUMBER)
        });


        // REPAY
        $(document).on("click", "#PDF_REPAY_ID", function(e) {
            var id = $(this).attr('data_value');
            var RECEIPT_NUMBER = $(this).attr('data_RECEIPT_NUMBER')
            var iurl = 'PDF_REPAY';
            GET_PDF_Table(iurl, id, 'REPAY', RECEIPT_NUMBER)
        });


        // TAX
        $(document).on("click", "#PDF_TAX_INVOICE", function(e) {
            var id = $(this).attr('data_value');
            var RECEIPT_NUMBER = $(this).attr('data_RECEIPT_NUMBER')
            var iurl = 'PDF_TAX_INVOICE';
            GET_PDF_Table(iurl, id, 'TAX_INVOICE', RECEIPT_NUMBER)
        });

        function GET_PDF_Table(iurl, id, type, number) {
            $(".loading").css("display", "block");
            clearTimeout(initial)
            invocation();
            axios({
                    method: 'POST',
                    url: iurl,
                    data: {
                        PDF_ID: id,
                        APP_ID: Cookies.get('APP_ID'),
                        Number: number
                    },
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/pdf'
                    },
                }).then(function(response) {
                    // console.log(response.data.PDF_Base64);
                    if (response.data.PDF_Base64.length != 0) {
                        openDoc(response.data.PDF_Base64[0]['PDF_NAME'])
                    } else if (response.data.URL_APP) {
                        open_URL(type, response.data.URL_APP)
                    } else {
                        $(".loading").css("display", "none");
                        Snackbar.show({
                            actionText: 'close',
                            pos: 'top-center',
                            duration: 15000,
                            actionTextColor: '#dc3545',
                            backgroundColor: '#323232',
                            width: 'auto',
                            text: 'ข้อมูลอยู่ระหว่างการประมวลผล กรุณาโหลดใหม่ในวันถัดไป'
                        });
                    }

                })
                .catch(function(error) {
                    // console.log(error);
                    setTimeout(function() {
                        // location.reload();
                    }, 5000);
                });
        }


        // CONTRACT
        $(document).on("click", "#PDF_CONTRACT", function(e) {
            iurl = 'PDF_CONTRACT'
            Get_PDF_Content(iurl, 'CONTRACT')
        });


        // TBDOWN
        $(document).on("click", "#PDF_TBDOWN", function(e) {
            iurl = 'PDF_TBDOWN'
            Get_PDF_Content(iurl, 'TBDOWN')
        });

        // RPDOWN
        $(document).on("click", "#PDF_RPDOWN", function(e) {
            iurl = 'PDF_RPDOWN'
            Get_PDF_Content(iurl, 'RPDOWN')
        });

        $(document).on("click", "#PDF_TPDOWN", function(e) {
            iurl = 'PDF_TPDOWN'
            Get_PDF_Content(iurl, 'TPDOWN')
        });

        $(document).on("click", "#PDF_INSURANCE", function(e) {
            iurl = 'PDF_INSURANCE'
            Get_PDF_Content(iurl)
        });



        function Get_PDF_Content(iurl, type) {
            $(".loading").css("display", "block");
            axios({
                    method: 'POST',
                    url: iurl,
                    data: {
                        APP_ID: Cookies.get('APP_ID'),
                    },
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/pdf'
                    },
                }).then(function(response) {
                    // console.log(response.data);
                    if (response.data.PDF_Base64.length != 0) {
                        openDoc(response.data.PDF_Base64[0]['PDF_NAME'])
                    } else if (response.data.URL_APP) {
                        open_URL(type, response.data.URL_APP)
                    } else {
                        $(".loading").css("display", "none");
                        Snackbar.show({
                            actionText: 'close',
                            pos: 'top-center',
                            duration: 15000,
                            actionTextColor: '#dc3545',
                            backgroundColor: '#323232',
                            width: 'auto',
                            text: 'ข้อมูลอยู่ระหว่างการประมวลผล กรุณาโหลดใหม่ในวันถัดไป'
                        });
                    }
                })
                .catch(function(error) {
                    // console.log(error);
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                });
        }



        function openDoc(data_response) {
            var name_PDF = data_response.split('<name>').pop().split('</name>')[0];
            var data_PDF = data_response.split('<content>').pop().split('</content>')[0];
            // console.log(name_PDF)

            const linkSource = `data:application/pdf;base64,${data_PDF}`;
            const downloadLink = document.createElement("a");
            const fileName = name_PDF;
            downloadLink.href = linkSource;
            downloadLink.download = fileName;
            // downloadLink.click();

            var isSafari = navigator.vendor && navigator.vendor.indexOf('Apple') > -1 && navigator.userAgent &&
                navigator.userAgent.indexOf('CriOS') == -1 && navigator.userAgent.indexOf('FxiOS') == -1;
            if (isSafari) {
                var binary = atob(data_PDF.replace(/\s/g, ''));
                var len = binary.length;
                var buffer = new ArrayBuffer(len);
                var view = new Uint8Array(buffer);
                for (var i = 0; i < len; i++) {
                    view[i] = binary.charCodeAt(i);
                }

                // create the blob object with content-type "application/pdf"               
                var blob = new Blob([view], {
                    type: "application/pdf"
                });
                var url = URL.createObjectURL(blob);
                // window.location = url;
                var new_tab = window.open([url]);

                if (new_tab == undefined) {

                    var newload = (window.location.href = [url]);

                    if (newload == undefined) {
                        alert('Please disable your popup blocker');
                    }
                }
            } else {
                downloadLink.click();
            }

            $(".loading").css("display", "none");
        }


        const open_URL = (type, data) => {
            // console.log(type)
            // console.log(data)

            let list_url = [{
                    type: 'CONTRACT',
                    url: env_K2_url + '/Runtime/Runtime/Form/EditContract+HirePurhcase/?APP_ID=' +
                        data.APP_ID + '&PERSION_ID=' + data.PERSION_ID + '&PROD_ID=' + data.PROD_ID +
                        '&CONTRACT_ID=' + data.CONTRACT_ID
                },
                {
                    type: 'RPDOWN',
                    url: env_K2_url + '/Runtime/Runtime/Form/ReGen__Preview+Receipt+Payment/?_state=GenReceiptDownAmount&CONTRACT_ID=&ID=' +
                        data.CONTRACT_ID + '&REPAY_ID=' + data.REPAY_ID + '&PROD_ID=' + data.PROD_ID +
                        '&PERSON_ID=' + data.PERSON_ID + '&APP_ID=' + data.APP_ID
                },
                {
                    type: 'TPDOWN',
                    url: env_K2_url + '/Runtime/Runtime/Form/ReGen__Preview+TAX+Repayment/?_state=GenPDF_TaxDown&CONTRACT_ID=&ID=' +
                        data.CONTRACT_ID + '&REPAY_ID=' + data.REPAY_ID + '&PROD_ID=' + data.PROD_ID +
                        '&PERSON_ID=' + data.PERSON_ID + '&APP_ID=' + data.APP_ID
                },
                {
                    type: 'TBDOWN',
                    url: env_K2_url + '/Runtime/Runtime/Form/Re-GenTableCalculate/?CONTRACT_ID=' +
                        data.CONTRACT_ID + '&APP_ID=' + data.APP_ID + '&PERSON_ID=' + data.PERSION_ID
                },
                {
                    type: 'INVOICE',
                    // url: env_K2_url + '/Runtime/Runtime/Form/PreviewInvoiceAsof020820/?CONTRACT_ID=' +
                    //     data.CONTRACT_ID + '&ID=' + data.ID + '&INVOICE_ID=' + data.INVOICE_ID,
                    url: env_K2_url + '/Runtime/Runtime/Form/PreviewInvoiceAsof020820__ReadOnly/?CONTRACT_ID=' +
                        data.CONTRACT_ID + '&ID=' + data.ID + '&INVOICE_ID=' + data.INVOICE_ID,
                },
                {
                    type: 'REPAY',
                    url: env_K2_url + '/Runtime/Runtime/Form/ReGen__Preview+Receipt+Payment/?_state=GenManualReceipt&CONTRACT_ID=' +
                        data.CONTRACT_ID + '&ID=' + data.ID + '&REPAY_ID=' + data.REPAY_ID +
                        '&PROD_ID=' + data.PROD_ID + '&PERSON_ID=' + data.PERSION_ID +
                        '&APP_ID=' + data.APP_ID
                },
                {
                    type: 'TAX_INVOICE',
                    url: env_K2_url + '/Runtime/Runtime/Form/ReGen__Preview+TAX+Repayment/?_state=GenPDF&CONTRACT_ID=' +
                        data.CONTRACT_ID + '&ID=' + data.ID + '&REPAY_ID=' + data.REPAY_ID +
                        '&PROD_ID=' + data.PROD_ID + '&PERSON_ID=' + data.PERSION_ID +
                        '&APP_ID=' + data.APP_ID
                }
            ]


            var URL_K2 = list_url.find(x => x.type === type).url
            // window.open(URL_K2)
            // window.location.href = URL_K2
            var new_tab = window.open([URL_K2]);

            if (new_tab == undefined) {

                var newload = (window.location.href = [URL_K2]);

                if (newload == undefined) {
                    alert('Please disable your popup Blocker');
                }
            }


            $(".loading").css("display", "none");
        }


        $('#btn_faq').on('click', function() {
            clearTimeout(initial)
            invocation();
            var url = 'FAQ';
            window.open(url, '_blank');
        });

        $("#logout").on('click', function() {
            $(".loading").css("display", "block");
            Cookies.remove('APP_ID');
            Cookies.remove('CUSTOMER_NAME');
            Cookies.remove('QUOTATION_ID');
            window.location = '{{ url('/') }}';
        })

    })
</script>
