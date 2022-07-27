<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('images/icon.jpg') }}" rel="icon" type="image/gif">
    <title>Milestone</title>

    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet" />

    {{-- bootstrap --}}
    <link href="{{ asset('assets/bootstrap-5.0.2/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/bootstrap-5.0.2/js/bootstrap.min.js') }}"></script>

    {{-- SnackBar --}}
    <link href="{{ asset('assets/SnackBar-master/dist/snackbar.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/SnackBar-master/dist/snackbar.min.js') }}"></script>


    {{-- JQuery --}}
    <script src="{{ asset('assets/jquery-3.5.1.min.js') }}"></script>

    {{-- axios --}}
    <script src="{{ asset('assets/axios.min.js') }}"></script>

    {{-- Cookie --}}
    <script src="{{ asset('assets/js.cookie.js') }}"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Milestone.css') }}">

</head>

<body>

    @php
        $TAX_ID = Session::get('TAX_ID');
    @endphp

    <div class="container mt-3">

        {{-- <div class="loading" style="display: none">Loading&#8230;</div> --}}
        <div class="loading" style="display: none">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="row">
            <div class="col text-start">
                @include('templates.Icon_header')
                {{-- <h1>UAT</h1> --}}
            </div>
            <div class="col text-end align-self-center">
                <button type="button" id="logout" class="btn btn-sm btn-danger">ออกจากระบบ</button>
            </div>
        </div>


        <div class="row mt-3">
            {{-- <div class="col-lg-4 col-md-8 col-sm-12">
                สวัสดีค่ะ คุณ<span id="name"></span>
                <br>
                ยินดีต้อนรับสู่บริการช่วยเหลือในการติดตามผลการขอผ่อนชำระสินค้าสำหรับนักศึกษา
                <br>
                -------------------------------------------
                <br>
                <u>สินค้าที่เช่าซื้อ</u> : <span id="CATEGORY_NAME"></span>
                <br>
                <u>ยี่ห้อ</u> : <span id="BRAND_NAME"></span>
                <br>
                <u>รุ่น/แบบ</u> : <span id="SERIES_NAME"></span>
                <br>
                -------------------------------------------
                <div id="DIV_PDF_APP" style="display: none">
                    <i class="fas fa-file-pdf fa-lg" style="color: red; cursor: pointer;" title="ดาวน์โหลด" id="PDF_APP"></i>
                    PDF ใบคำขอสินเชื่อ
                    <br>
                    -------------------------------------------
                </div>
                <br>
                U-FUND ผ่อนง่ายไม่ต้องใช้บัตรเครดิต
            </div> --}}
        </div>
        <div class="card" style="font-size: 1.1rem;">
            <div class="card-header" style="background-color: #18aba4; font-size: 1.2rem;">
                ข้อมูลลูกค้า
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6" id="col_information">
                        สวัสดีค่ะ/ครับ คุณ <u><span id="name"></span></u>
                        <br>
                        ยินดีต้อนรับสู่บริการช่วยเหลือในการติดตามผลการขอผ่อนชำระสินค้าสำหรับนักศึกษา
                        <br>
                        ----------------------------------------
                        <br>
                        <span id="text_contract" style="display: none">
                            <u>เลขที่สัญญา</u> : <span id="Contract_number"></span>
                            <br>
                        </span>
                        <u>สินค้าที่เช่าซื้อ</u> : <span id="CATEGORY_NAME"></span>
                        <br>
                        <u>ยี่ห้อ</u> : <span id="BRAND_NAME"></span>
                        <br>
                        <u>รุ่น/แบบ</u> : <span id="SERIES_NAME"></span>
                        <br>
                        ----------------------------------------
                        <div id="DIV_PDF_APP" style="display: block">
                            <i class="fas fa-file-pdf fa-lg" style="color: red; cursor: pointer;" title="ดาวน์โหลด"
                                id="PDF_APP"></i>
                            PDF ใบคำขอสินเชื่อ
                            <br>
                            ----------------------------------------
                        </div>
                        <div id="DIV_QR_DOWN" style="display: none">
                            <div class="card" style="border-color: #ff0000;">
                                <div class="card-body">
                                    {{-- กรุณาชำระเงินดาวน์ จำนวน 2.5 บาท ผ่าน QR code บน Mobile Banking App ดาวน์โหลดที่ : https://gettr.im/t/cW17pEz --}}
                                    <span id="QR_DOWN_TXT"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6" id="col_Approve" style="display: none">
                        กรุณาเตรียมเงินดาวน์และเอกสาร ดังนี้
                        <br>
                        1.เงินดาวน์จำนวน <span id="M_Down"></span> บาท
                        <br>
                        2.บัตรประชาชน (ฉบับจริง)
                        <br>
                        3.บัตรนักศึกษา/ระเบียบประวัตินักศึกษา/หนังสือรายงานตัว (ฉบับจริง)
                        <br><br>
                        กรุณาติดต่อสาขา <span id="Company"></span>
                        <br>
                        แจ้งรหัส Approve Code : <u><span id="Approve_Code"></span></u> กับเจ้าหน้าที่

                        <br><br>
                        หากมีข้อสงสัย <span style="">@Line</span> : <a href="https://line.me/ti/p/@ufund"
                            style="color:#25e425; text-decoration: none;"> @ufund</a>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6" id="col_etc_rework" style="display: none;color:red">
                        * การขออนุมัติของท่านอยู่ในสถานะ Rework เนื่องจาก
                        <br>
                        <div id="list_etc_rework"></div>
                    </div>
                </div>
                <div class="d-none" id="div_guar">
                    <hr>
                    <div class="d-none" id="div_url_guar">
                        ลิงค์กรอกข้อมูล "<span class="font-weight-bold"><u> ผู้ค้ำประกัน </u></span>"
                        <br>
                        <span id="url_guar"></span>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 mt-1">
                            <div class="card">
                                <div class="card-body">
                                    <p class="fs-7 text-muted mb-0">ข้อมูลผู้ค้ำประกัน</p>
                                    <p class="text-center fs-5 mb-0" id="Gurantor_ACTIVE"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 mt-1">
                            <div class="card">
                                <div class="card-body">
                                    <p class="fs-7 text-muted mb-0">สถานะการยินยอมค้ำประกัน</p>
                                    <p class="text-center fs-5 mb-0" id="Gurantor_ACCEPT"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 mt-1">
                            <div class="card">
                                <div class="card-body">
                                    <p class="fs-7 text-muted mb-0">ผลการตรวจสอบสถานะผู้ค้ำประกันเบื้องต้น</p>
                                    <p class="text-center fs-5 mb-0" id="Gurantor_RESULT"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-none" id="div_contract_status">
                    <hr style="color: red;">
                    <p class="mt-3 text-center" style="color: red;" id="txt_header_contract_status"></p>
                    ภายใน 7 วันจะมีเจ้าหน้าที่ติดต่อเพื่อแจ้งรายละเอียดการนำโปรไฟล์ควบคุมออก กรุณารอรับสายเจ้าหน้าที่
                    หรือ สอบถามเพื่มเติมที่ <span style="">@Line</span> : <span
                        style="color:#25e425">@ufund</span>
                </div>

            </div>
            {{-- <span class="d-none" id="div_guar">
                <br><br>
                ลิงค์กรอกข้อมูล "<span class="font-weight-bold"><u> ผู้ค้ำประกัน </u></span>"
                <br>
                <span id="url_guar"></span>
            </span> --}}
            <div class="card-footer text-center text-muted" style="font-size: 0.9rem;">
                U-FUND ผ่อนง่ายไม่ต้องใช้บัตรเครดิต
            </div>
        </div>


        <div class="container mt-3" style="margin-top: 5% !important;">

            <div class="text-center mb-4" style="display: none" id="div_customer">
                <button type="button" id="btn_Customer" class="btn btn-outline-success"
                    style="width: 50%; border-radius: 2rem;"> ตรวจสอบการผ่อนชำระ </button>
            </div>
            <br>

            <div class="row container group_circle">
                <div class="col-sm-12 col-md-3 col-lg-3 circle_margin mb-4" style="color: #00000030;" id="step1">
                    {{-- <i class="fas fa-user-edit fa-4x"></i> --}}
                    <img src="{{ asset('images/Step/Step1.png') }}" class="img_step"
                        style="width: 12rem; filter: grayscale(100%);" id="step1_img">
                    <div class="text-center mt-2">
                        กรอกใบสมัคร
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 circle_margin mb-4" style="color: #00000030;" id="step2">
                    {{-- <i class="fas fa-user-check fa-4x"></i> --}}
                    <img src="{{ asset('images/Step/Step2.png') }}" class="img_step"
                        style="width: 12rem; filter: grayscale(100%);" id="step2_img">
                    <div class="text-center mt-2">
                        ยืนยันตัวตน
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 circle_margin mb-4" style="color: #00000030;" id="step3">
                    {{-- <i class="fas fa-user-clock fa-4x"></i> --}}
                    <img src="{{ asset('images/Step/Step3.png') }}" class="img_step"
                        style="width: 12rem; filter: grayscale(100%);" id="step3_img">
                    <div class="text-center mt-2">
                        <span id="txt_approve">รอการอนุมัติ</span>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 circle_margin mb-4" style="color: #00000030;" id="step4">
                    {{-- <i class="fas fa-paper-plane fa-4x"></i> --}}
                    <img src="{{ asset('images/Step/Step4.png') }}" class="img_step"
                        style="width: 12rem; filter: grayscale(100%);" id="step4_img">
                    <div class="text-center mt-2">
                        <span id="txt_Deliver">รอรับสินค้า</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4" style="margin-bottom: 5rem !important;">
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                    id="Progress_bar" style="width: 25%;" aria-valuemin="0" aria-valuemax="100">25%</div>
            </div>
        </div>

        {{-- <div class="button-corner" title="คำถามที่พบบ่อย" style="cursor: pointer;" id="btn_faq">
            <img src="{{ asset('images/FAQ.png') }}" alt="" style="width: 15%;">
        </div> --}}


    </div>

</body>

</html>
<script>
    $(document).ready(function() {

        var env = '{{ env('APP_ENV') }}';

        if (env == 'production') {
            env_K2_url = 'https://ufund.comseven.com'
        } else {
            env_K2_url = 'https://43.254.133.148'
        }


        $(".loading").css("display", "block");

        // Function init
        check_state();

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

        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

        var token = document.head.querySelector('meta[name="csrf-token"]');
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

        console.log(Cookies.get())
        $('#name').text(Cookies.get('CUSTOMER_NAME'))

        if (!Cookies.get('QUOTATION_ID') && !Cookies.get('APP_ID')) {
            window.location = '{{ url('/') }}';
        }
        // $('#Progress_bar').css('width','50%');
        // $('#Progress_bar').text('50%');

        function urlify(text) {
            var urlRegex = /(https?:\/\/[^\s]+)/g;
            return text.replace(urlRegex, function(url) {
                return '<a href="' + url + '" target="_blank" >' + url + '</a>';
            })
        }

        function check_state() {
            axios({
                    method: 'POST',
                    url: 'Check_State_Milestone',
                    data: {
                        Qid: (Cookies.get('QUOTATION_ID') ? Cookies.get('QUOTATION_ID') : null),
                        APP_ID: (Cookies.get('APP_ID') ? Cookies.get('APP_ID') : null),
                    }
                }).then(function(response) {
                    console.log(response.data);

                    $('#SERIES_NAME').text(response.data['product'][0].SERIES_NAME)
                    $('#CATEGORY_NAME').text(response.data['product'][0].CATEGORY_NAME)
                    $('#BRAND_NAME').text(response.data['product'][0].BRAND_NAME)

                    // alert(response.data['APP_ID'])
                    if (response.data['APP_ID']) {
                        Cookies.set('APP_ID', response.data['APP_ID']);
                    }


                    if (response.data['QR_Down']) {
                        var txt = response.data['QR_Down']['SEND_MSG'];
                        var html = urlify(txt);
                        $('#QR_DOWN_TXT').html(html);
                        $('#DIV_QR_DOWN').css('display', 'block');
                        // console.log(html)
                    }

                    if (response.data['CONTRACT']) {
                        $('#Contract_number').text(response.data['CONTRACT'][0].CONTRACT_NUMBER);
                        $('#text_contract').css('display', 'block');
                    }


                    /////////////////////////// Guarantor /////////////////////////////////////////////////
                    if (response.data['Guarantor'].count == 1) {

                        $('#div_url_guar').removeClass('d-none');

                        let url = null;

                        if (response.data['Guarantor'].QT_NOTPASS == 1) {
                            url = env_K2_url + '/Runtime/Runtime/Form/Form.GuarantorPreInfo/?PST_GUAR_ID=' +
                                response.data['Guarantor'].PST_GUAR_ID + '&STATE=CHANGEQUO'
                        } else {
                            url =
                                env_K2_url + '/Runtime/Runtime/Form/Form.GuarantorAuthen/?QUATATION_ID=' +
                                response.data['Guarantor'].QUOTATION_ID + '&PST_GUAR_ID=' + response.data[
                                    'Guarantor'].PST_GUAR_ID
                        }

                        if (response.data['Guarantor'].url_accept_guarantor == 1) {
                            url =
                                env_K2_url + '/Runtime/Runtime/Form/Form.GuarantorAuthen/?QUATATION_ID=' +
                                response.data['Guarantor'].QUOTATION_ID + '&PST_GUAR_ID=' + response.data[
                                    'Guarantor'].PST_GUAR_ID
                        }

                        $('#url_guar').html('<a href="' + url + '" target="blank"> ' + url + ' </a>');
                    }

                    if (response.data['Guarantor'].Guarantor_Result) {

                        $('#div_guar').removeClass('d-none');

                        if (response.data['Guarantor'].Guarantor_Result['FLAG_GUARANTOR'] == 1) {

                            $('#Gurantor_ACTIVE').html('<span class="text-success">มีผู้ค้ำประกัน</span>')

                            $txt_Gurantor_ACCEPT = response.data['Guarantor'].Guarantor_Result[
                                'ACCEPT_STATUS'];
                            $txt_Gurantor_RESULT = response.data['Guarantor'].Guarantor_Result[
                                'RESULT_GUARANTOR'];

                            $RESULT_obj = [{
                                    id: 'WAIT',
                                    color: 'text-warning',
                                },
                                {
                                    id: 'PASS',
                                    color: 'text-success',
                                },
                                {
                                    id: 'NOTPASS',
                                    color: 'text-danger',
                                },
                            ]
                            // console.log($RESULT_obj.filter(x => x.id == $txt_Gurantor_RESULT)[0].color)
                            $('#Gurantor_ACCEPT').html($txt_Gurantor_ACCEPT == 1 ?
                                '<span class="text-success">ยินยอม</span>' : ($txt_Gurantor_ACCEPT ==
                                    0 ? '<span class="text-danger">ไม่ยินยอม</span>' : '-'));
                            $('#Gurantor_RESULT').html('<span class="' + $RESULT_obj.filter(x => x.id ==
                                    $txt_Gurantor_RESULT)[0].color + '">' + $txt_Gurantor_RESULT +
                                '</span>')
                        } else {
                            $('#Gurantor_ACTIVE').html('<span class="text-danger">ไม่มีผู้ค้ำประกัน</span>')
                            $('#Gurantor_ACCEPT').text('-')
                            $('#Gurantor_RESULT').text('-')
                        }
                    }
                    /////////////////////////// End Guarantor /////////////////////////////////////////////////



                    /////////////////////////// Contract Status /////////////////////////////////////////////////

                    if (response.data['CONTRACT']) {
                        if (response.data['CONTRACT'][0].STATUS_ID) {

                            let cont_status = response.data['CONTRACT'][0].STATUS_ID;
                            if (cont_status == '53') {
                                $('#div_guar').addClass('d-none');
                                $('#div_contract_status').removeClass('d-none')
                                $('#txt_header_contract_status').text(
                                    'UFUND ได้ปิดสัญญาล่วงหน้าให้คุณเรียบร้อยแล้ว')
                            } else if (cont_status == '40') {
                                $('#txt_header_contract_status').text(
                                    'UFUND ได้ปิดสัญญาให้คุณเรียบร้อยแล้ว')
                                $('#div_guar').addClass('d-none');
                                $('#div_contract_status').removeClass('d-none')
                            }
                        }
                    }

                    /////////////////////////// End Contract Status /////////////////////////////////////////////////


                    if (response.data['step'] == 'StepWaitKYC') {

                        $('#Company').text(response.data['Company']);
                        $('#M_Down').text(numberWithCommas(parseFloat(response.data['Money_Down']).toFixed(
                            2)));
                        $('#Approve_Code').text(response.data['APPROVE_CODE']);
                        $('#col_Approve').css('display', 'block');
                        $('#col_information').css('padding-right', '20px')
                        $('#col_information').css('border-right', '1px solid #ccc')

                        $('#DIV_PDF_APP').css('display', 'none')

                        $('#step1').css('color', '#000000');
                        $('#step1_img').css('filter', 'grayscale(0%)');

                        $('#Progress_bar').css('width', '25%');
                        $('#Progress_bar').text('25%');

                    } else if (response.data['step'] == 'StepWaitApprove') {

                        // $('#Company').text(response.data['Company']);
                        // $('#M_Down').text(response.data['Money_Down']);
                        // $('#Approve_Code').text(response.data['APPROVE_CODE']);
                        // $('#col_Approve').css('display','block');

                        // style="padding-right:20px; border-right: 1px solid #ccc;"
                        $('#step1').css('color', '#000000');
                        $('#step2').css('color', '#000000');
                        $('#step1_img').css('filter', 'grayscale(0%)');
                        $('#step2_img').css('filter', 'grayscale(0%)');
                        $('#Progress_bar').css('width', '50%');
                        $('#Progress_bar').text('50%');
                    } else if (response.data['step'] == 'StepRework') {

                        let item = response.data.etc;
                        let html = '';

                        let results = item.reduce(function(results, item) {
                            (results[item.CreateDate] = results[item.CreateDate] || []).push(item);
                            return results;
                        }, {})


                        let count_rework = Object.keys(results).length;
                        for (let date_key of Object.keys(results)) {
                            // console.log(date_key)
                            let txt_date = '';
                            let time = null;
                            if (date_key != '' && date_key != 'null') {
                                let date = (date_key.split(' ')[0]).split('-');
                                time = (date_key.split(' ')[1]).split('.')[0]
                                txt_date = date[2] + '-' + date[1] + '-' + date[0];
                            }



                            html += `
                                <b> Rework ${count_rework} </b> ${txt_date == '' || txt_date == null ? '' : '<u>วันที่</u> ' + txt_date + ' <u>เวลา</u> ' + time + ' น.'} <br>
                                ${(function() {
                                    subhtml = ''
                                    for (let i = 0; i < results[date_key].length; i++) {
                                        subhtml += `
                                        *${results[date_key][i].STD_STATUS_DESCRIPTION} ${results[date_key][i].STR_STATUS_REASON == null || results[date_key][i].STR_STATUS_REASON == '' ? ' ': '- ' +  results[date_key][i].STR_STATUS_REASON}

                                        ${(function() {
                                            text_callback = '';
                                            if(results[date_key][i].STD_STATUS_CODE == 'RW3'){
                                                text_callback = '<small class="text-muted"> (กรุณา ติดต่อที่ Line : <a style="color:#06c755; text-decoration:none" href="http://line.me/ti/p/@ufund" target="blank">@ufund</a>) </small>';
                                            }else if(results[date_key][i].STD_STATUS_CODE != 'RW3' && results[date_key][i].STATUS_CODE == "RW"){
                                                text_callback = '<small class="text-muted"> (กรุณาติดต่อที่สาขา ที่ท่านเลือกทำรายการ) </small>';
                                            }

                                            return text_callback;
                                        })()}

                                        <br>
                                        `;
                                    }
                                    return subhtml;
                                })()}
                                <br>
                            `;
                            count_rework--
                        }
                        $('#list_etc_rework').html(html)
                        $('#col_etc_rework').css('display', 'block');

                        $('#step1').css('color', '#000000');
                        $('#step2').css('color', '#000000');
                        $('#step1_img').css('filter', 'grayscale(0%)');
                        $('#step2_img').css('filter', 'grayscale(0%)');

                        $('#Progress_bar').css('width', '50%');
                        $('#Progress_bar').text('50%');
                    } else if (response.data['step'] == 'StepReject') {
                        Snackbar.show({
                            actionText: 'close',
                            pos: 'top-center',
                            duration: 15000,
                            actionTextColor: '#dc3545',
                            backgroundColor: '#323232',
                            width: 'auto',
                            text: 'คำขอของท่านไม่ผ่านการอนุมัติ'
                        });

                        $('#step1').css('color', '#000000');
                        $('#step2').css('color', '#000000');
                        $('#step3').css('color', '#ff0000');
                        $('#step1_img').css('filter', 'grayscale(0%)');
                        $('#step2_img').css('filter', 'grayscale(0%)');
                        $('#step3_img').css('filter', 'grayscale(0%)');

                        $("#step3_img").attr("src", "{{ asset('images/Step/Step3_Reject_frown.png') }}");

                        $('#txt_approve').text('ไม่ผ่านการอนุมัติ');

                        $('.progress-bar').css('background-color', '#ff0000');
                        $('#Progress_bar').css('width', '75%');
                        $('#Progress_bar').text('75%');
                    } else if (response.data['step'] == 'StepApprove') {

                        // $('#Company').text(response.data['Company']);
                        // $('#M_Down').text(response.data['Money_Down']);
                        // $('#Approve_Code').text(response.data['APPROVE_CODE']);
                        // $('#col_Approve').css('display','block');
                        // $('#col_information').css('padding-right','20px')
                        // $('#col_information').css('border-right','1px solid #ccc')

                        $('#txt_approve').text('ผ่านการอนุมัติ');

                        $('#step1').css('color', '#000000');
                        $('#step2').css('color', '#000000');
                        $('#step3').css('color', '#000000');
                        $('#step1_img').css('filter', 'grayscale(0%)');
                        $('#step2_img').css('filter', 'grayscale(0%)');
                        $('#step3_img').css('filter', 'grayscale(0%)');

                        $('#Progress_bar').css('width', '75%');
                        $('#Progress_bar').text('75%');
                    } else if (response.data['step'] == 'StepDeliver') {
                        $('#txt_approve').text('ผ่านการอนุมัติ');
                        $('#txt_Deliver').text('รับสินค้า');
                        $('#div_customer').css('display', 'block')
                        $('.progress-bar-striped').css('background-image', 'none')

                        $('#step1').css('color', '#000000');
                        $('#step2').css('color', '#000000');
                        $('#step3').css('color', '#000000');
                        $('#step4').css('color', '#000000');
                        $('#step1_img').css('filter', 'grayscale(0%)');
                        $('#step2_img').css('filter', 'grayscale(0%)');
                        $('#step3_img').css('filter', 'grayscale(0%)');
                        $('#step4_img').css('filter', 'grayscale(0%)');


                        $('#Progress_bar').css('width', '100%');
                        $('#Progress_bar').text('100%');
                    }

                    $(".loading").css("display", "none");
                    invocation();
                })
                .catch(function(error) {
                    console.log(error);
                    setTimeout(function() {
                        // location.reload();
                    }, 5000);
                });
        }


        $(document).on("click", "#PDF_APP", function(e) {
            clearTimeout(initial)
            invocation();
            $(".loading").css("display", "block");
            axios({
                    method: 'POST',
                    url: 'PDF_APP',
                    data: {
                        APP_ID: Cookies.get('APP_ID'),
                    },
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/pdf'
                    },
                }).then(function(response) {
                    // console.log(response.data);
                    // openDoc(response.data.PDF_APP[0]['PDF_NAME'])

                    if (response.data.PDF_APP.length != 0) {
                        openDoc(response.data.PDF_APP[0]['PDF_NAME'])
                    } else if (response.data.URL_APP) {
                        window.open(
                            env_K2_url + '/Runtime/Runtime/Form/Preview+Application/?APP_ID=' +
                            response.data.URL_APP['APP_ID'] + '&PERSION_ID=' + response.data
                            .URL_APP['PERSION_ID'] + '&PROD_ID=' + response.data.URL_APP[
                                'PROD_ID'])
                        $(".loading").css("display", "none");
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
                    console.log(error);
                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                });
        });


        function openDoc(data_response) {
            var name_PDF = data_response.split('<name>').pop().split('</name>')[0];
            var data_PDF = data_response.split('<content>').pop().split('</content>')[0];

            console.log(name_PDF)

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
                // console.log(url
                window.location = url;
            } else {
                downloadLink.click();
            }

            $(".loading").css("display", "none");
        }

        $('#btn_Customer').on('click', function() {
            window.location = '{{ url('/Customer') }}';
        });


        $('#btn_faq').on('click', function() {
            clearTimeout(initial)
            invocation();
            // window.location.href = "FAQ";
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
