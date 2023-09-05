<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('images/icon.jpg') }}" rel="icon" type="image/gif">
    <title>Login</title>

    <!-- Font Awesome -->
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet" />

    {{-- bootstrap --}}
    <link href="{{ asset('assets/bootstrap-5.0.2/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/bootstrap-5.0.2/js/bootstrap.min.js') }}"></script>


    {{-- JQuery --}}
    <script src="{{ asset('assets/jquery-3.5.1.min.js') }}"></script>

    {{-- axios --}}
    <script src="{{ asset('assets/axios.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    {{-- SnackBar --}}
    <link href="{{ asset('assets/SnackBar-master/dist/snackbar.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/SnackBar-master/dist/snackbar.min.js') }}"></script>


    {{-- Cookie --}}
    <script src="{{ asset('assets/js.cookie.js') }}"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/CheckID.css') }}">

    {{-- Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SCHXYFRTK1"></script>


    <style>
        @media only screen and (max-width: 600px) {
            .resolution-show-cate {
                display: none;
            }
        }
    </style>

</head>

<body>

    <div class="container mt-3">

        {{-- <div class="loading" style="display: none">Loading&#8230;</div> --}}
        <div class="loading" style="display: none">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        {{-- @include('templates.alert_noti') --}}

        <form class="centered">

            <div class="text-center mb-4">
                <img src="{{ asset('images/UFUND.png') }}" alt="" id="icon_ufond_login">
                {{-- <h1>UAT</h1> --}}
            </div>
            {{-- <div class="mb-3">
                <label for="id_card" class="form-label collectes-ville text-center"> กรุณากรอกเลขที่บัตรประชาชน </label>
                <input type="email" class="form-control" id="id_card" aria-describedby="idHelp" placeholder="Search"
                    maxlength="13">
            </div> --}}

            <div class="mb-3">
                <label for="id_card" class="form-label collectes-ville text-center"> กรุณากรอกเลขที่บัตรประชาชน
                </label>
                <input type="tel" class="form-control" id="id_card" aria-describedby="idHelp"
                    placeholder="เลขที่บัตรประชาชน" maxlength="13">
            </div>
            <div class="mb-3">
                <label for="Inputb_date" class="form-label">กรุณากรอกวัน เดือน ปีเกิด(ค.ศ)</label>
                <input type="tel" class="form-control" id="b_date" placeholder="วันเกิด">
                <div id="b_dateHelp" class="form-text">ex. วันเกิด 12 มีนาคม ค.ศ.2000 ให้กรอกเป็น 12032000</div>
            </div>

            <div class="text-center mt-3">
                <button type="button" id="btn_submit" class="btn btn-outline-dark"
                    style="width: 80%; border-radius: 2rem;"> เข้าสู่ระบบ </button>
            </div>
        </form>


        <!-- Modal Multi APP_ID-->
        {{-- <div class="modal fade" id="Multi_APP_ID_Modal" tabindex="-1" aria-labelledby="Multi_APP_ID_Modal" aria-hidden="true"> --}}
        <div class="modal fade" id="Multi_APP_ID_Modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg justify-content-center">
                <div class="modal-content border-0" style="background-color: #fff0;">
                    <div class="row h-100" id="list_APP_ID">

                        {{-- <div class="col-12 d-flex justify-content-center mt-2">
                        <div class="card" style="max-width: 600px;">
                            <div class="row g-0">
                                <div class="col-md-4 text-center">
                                    <img src="{{ asset('images/Category/Ipad.png') }}" class="img-fluid rounded-start" style="width: 10rem;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Card title</h5>
                                        <p class="card-text">This is a wider card with supporting text below as a
                                            natural lead-in to additional content. This content is a little bit longer.
                                        </p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins
                                                ago</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    </div>
                </div>
            </div>
        </div>

</body>

</html>
<script>
    $(document).ready(function() {


        // Google Analytics
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-SCHXYFRTK1');


        Cookies.remove('APP_ID');
        Cookies.remove('CUSTOMER_NAME');
        Cookies.remove('QUOTATION_ID');


        var token = document.head.querySelector('meta[name="csrf-token"]');
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

        function get_ip() {
            return $.getJSON("http://jsonip.com/?callback=?").then(function(data) {
                return data
            });
        }


        const get_device_info = async () => {

            var device_obj = new Object();

            (function() {
                'use strict';

                var module = {
                    options: [],
                    header: [navigator.platform, navigator.userAgent, navigator.appVersion,
                        navigator.vendor, window.opera
                    ],
                    dataos: [{
                            name: 'Windows Phone',
                            value: 'Windows Phone',
                            version: 'OS'
                        },
                        {
                            name: 'Windows',
                            value: 'Win',
                            version: 'NT'
                        },
                        {
                            name: 'iPhone',
                            value: 'iPhone',
                            version: 'OS'
                        },
                        {
                            name: 'iPad',
                            value: 'iPad',
                            version: 'OS'
                        },
                        {
                            name: 'Kindle',
                            value: 'Silk',
                            version: 'Silk'
                        },
                        {
                            name: 'Android',
                            value: 'Android',
                            version: 'Android'
                        },
                        {
                            name: 'PlayBook',
                            value: 'PlayBook',
                            version: 'OS'
                        },
                        {
                            name: 'BlackBerry',
                            value: 'BlackBerry',
                            version: '/'
                        },
                        {
                            name: 'Macintosh',
                            value: 'Mac',
                            version: 'OS X'
                        },
                        {
                            name: 'Linux',
                            value: 'Linux',
                            version: 'rv'
                        },
                        {
                            name: 'Palm',
                            value: 'Palm',
                            version: 'PalmOS'
                        }
                    ],
                    databrowser: [{
                            name: 'Chrome',
                            value: 'Chrome',
                            version: 'Chrome'
                        },
                        {
                            name: 'Firefox',
                            value: 'Firefox',
                            version: 'Firefox'
                        },
                        {
                            name: 'Safari',
                            value: 'Safari',
                            version: 'Version'
                        },
                        {
                            name: 'Internet Explorer',
                            value: 'MSIE',
                            version: 'MSIE'
                        },
                        {
                            name: 'Opera',
                            value: 'Opera',
                            version: 'Opera'
                        },
                        {
                            name: 'BlackBerry',
                            value: 'CLDC',
                            version: 'CLDC'
                        },
                        {
                            name: 'Mozilla',
                            value: 'Mozilla',
                            version: 'Mozilla'
                        }
                    ],
                    init: function() {
                        var agent = this.header.join(' '),
                            os = this.matchItem(agent, this.dataos),
                            browser = this.matchItem(agent, this.databrowser);

                        return {
                            os: os,
                            browser: browser
                        };
                    },
                    matchItem: function(string, data) {
                        var i = 0,
                            j = 0,
                            html = '',
                            regex,
                            regexv,
                            match,
                            matches,
                            version;

                        for (i = 0; i < data.length; i += 1) {
                            regex = new RegExp(data[i].value, 'i');
                            match = regex.test(string);
                            if (match) {
                                regexv = new RegExp(data[i].version + '[- /:;]([\\d._]+)',
                                    'i');
                                matches = string.match(regexv);
                                version = '';
                                if (matches) {
                                    if (matches[1]) {
                                        matches = matches[1];
                                    }
                                }
                                if (matches) {
                                    matches = matches.split(/[._]+/);
                                    for (j = 0; j < matches.length; j += 1) {
                                        if (j === 0) {
                                            version += matches[j] + '.';
                                        } else {
                                            version += matches[j];
                                        }
                                    }
                                } else {
                                    version = '0';
                                }
                                return {
                                    name: data[i].name,
                                    version: parseFloat(version)
                                };
                            }
                        }
                        return {
                            name: 'unknown',
                            version: 0
                        };
                    }
                };

                var e = module.init(),
                    debug = '';

                debug += 'os.name = ' + e.os.name + '<br/>';
                debug += 'os.version = ' + e.os.version + '<br/>';
                debug += 'browser.name = ' + e.browser.name + '<br/>';
                debug += 'browser.version = ' + e.browser.version + '<br/>';

                // debug += '<br/>';
                debug += 'navigator.userAgent = ' + navigator.userAgent + '<br/>';
                debug += 'navigator.appVersion = ' + navigator.appVersion + '<br/>';
                debug += 'navigator.platform = ' + navigator.platform + '<br/>';
                debug += 'navigator.vendor = ' + navigator.vendor + '<br/>';

                device_obj["os"] = e
                // console.log(e)
            }());

            // console.log(device_obj);
            return device_obj;

        }

        // $.getJSON('//freegeoip.net/json/?callback=?', function(data) {
        //     console.log(JSON.stringify(data, null, 2));
        // });

        // function IDMask() {
        //     var num = $(this).val().replace(/\D/g, '');
        //     $(this).val(num.substring(0, 1) + '-' + num.substring(1, 5) + '-' + num.substring(5, 10) + '-' + num.substring(10, 12) + '-' + num.substring(12, 14));
        // }
        // $('#id_card').keyup(IDMask);

        const isNumericInput = (event) => {
            const key = event.keyCode;
            return ((key >= 48 && key <= 57) || // Allow number line
                (key >= 96 && key <= 105) // Allow number pad
            );
        };

        const isModifierKey = (event) => {
            const key = event.keyCode;
            return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
                (key === 8 || key === 9 || key === 13 || key === 46) ||
                // Allow Backspace, Tab, Enter, Delete
                (key > 36 && key < 41) || // Allow left, up, right, down
                (
                    // Allow Ctrl/Command + A,C,V,X,Z
                    (event.ctrlKey === true || event.metaKey === true) &&
                    (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
                )
        };

        const enforceFormat = (event) => {
            // Input must be of a valid number format or a modifier key, and not longer than ten digits
            if (!isNumericInput(event) && !isModifierKey(event)) {
                event.preventDefault();
            }
        };

        // const formatToPhone = (event) => {
        //     if (isModifierKey(event)) {
        //         return;
        //     }

        //     const input = event.target.value.replace(/\D/g, '').substring(0,
        //     13); // First ten digits of input only
        //     const OneID = input.substring(0, 1);
        //     const TwoID = input.substring(1, 5);
        //     const ThreeID = input.substring(5, 10);
        //     const FoueID = input.substring(10, 12);
        //     const FiveID = input.substring(12, 13);

        //     if (input.length > 12) {
        //         event.target.value = `${OneID}-${TwoID}-${ThreeID}-${FoueID}-${FiveID}`;
        //     } else if (input.length > 10) {
        //         event.target.value = `${OneID}-${TwoID}-${ThreeID}-${FoueID}`;
        //     } else if (input.length > 5) {
        //         event.target.value = `${OneID}-${TwoID}-${ThreeID}`;
        //     } else if (input.length > 1) {
        //         event.target.value = `${OneID}-${TwoID}`;
        //     }
        // };

        const inputElement = document.getElementById('id_card');
        inputElement.addEventListener('keydown', enforceFormat);

        const inputElement_BDate = document.getElementById('b_date');
        inputElement_BDate.addEventListener('keydown', enforceFormat);
        // inputElement.addEventListener('keyup', formatToPhone);

        $("body").keyup(function(event) {
            if (event.keyCode === 13) {
                if ($('#id_card').val() != '' && $('#b_date').val() != '') {
                    $("#btn_submit").click();
                }
            }
        });


        $('#btn_submit').click(function() {
            $(".loading").css("display", "block");
            // var id_card = $('#id_card').val().replace(/[^0-9 ]/g, "");
            axios({
                    method: 'POST',
                    url: 'Check_IDCard',
                    data: {
                        id_card: $('#id_card').val().replace(/[^0-9 ]/g, ""),
                        b_date: $('#b_date').val().replace(/[^0-9 ]/g, ""),
                    }
                }).then(function(response) {
                    console.log(response);

                    if (response.data == "Invalid") {
                        Snackbar.show({
                            actionText: 'close',
                            pos: 'top-center',
                            actionTextColor: '#dc3545',
                            backgroundColor: '#323232',
                            width: 'auto',
                            text: 'ข้อมูลไม่ถูกต้อง กรุณาตรวจสอบข้อมูลอีกครั้ง'
                        });
                        $(".loading").css("display", "none");
                    } else if (response.data == "NoData") {
                        Snackbar.show({
                            actionText: 'close',
                            pos: 'top-center',
                            actionTextColor: '#dc3545',
                            backgroundColor: '#323232',
                            width: 'auto',
                            text: 'ไม่พบข้อมูลในระบบ'
                        });
                        $(".loading").css("display", "none");
                    } else if (response.data[0].APP_ID) {
                        if (response.data.length > 1) {
                            // var booleanValue = listOfObjecs.filter((item) =>  item.STATUS_ID != '4')
                            // console.log(booleanValue);
                            choice_APP_ID(response.data);
                        } else {
                            Cookies.set('APP_ID', response.data[0].APP_ID);
                            // Cookies.set('CUSTOMER_NAME', response.data[0].CUSTOMER_NAME);
                            if (response.data[0].CUSTOMER_NAME) {
                                Cookies.set('CUSTOMER_NAME', response.data[0].CUSTOMER_NAME);
                            } else if (response.data[0].FIRST_NAME) {
                                Cookies.set('CUSTOMER_NAME', response.data[0].FIRST_NAME + ' ' + response.data[0].LAST_NAME);
                            }
                            Cookies.set('QUOTATION_ID', response.data[0].QUOTATION_ID);
                            // log_login(response.data)
                            window.location = '{{ url('/Milestone') }}';
                        }
                    } else if (response.data[0].QUOTATION_ID) {
                        Cookies.set('QUOTATION_ID', response.data[0].QUOTATION_ID);
                        Cookies.set('CUSTOMER_NAME', response.data[0].CUSTOMER_NAME);
                        // log_login(response.data)
                        window.location = '{{ url('/Milestone') }}';
                    } else {
                        Snackbar.show({
                            actionText: 'close',
                            pos: 'top-center',
                            actionTextColor: '#dc3545',
                            backgroundColor: '#323232',
                            width: 'auto',
                            text: 'เกิดข้อผิดพลาด กรุณาลองอีกครั้ง'
                        });
                        $(".loading").css("display", "none");
                    }

                })
                .catch(function(error) {
                    Snackbar.show({
                        actionText: 'close',
                        pos: 'top-center',
                        actionTextColor: '#dc3545',
                        backgroundColor: '#323232',
                        width: 'auto',
                        text: 'SYSTEM ERROR'
                    });
                    $(".loading").css("display", "none");
                    console.log(error);
                });
        });

        const choice_APP_ID = (data) => {
            $(".loading").css("display", "none");
            console.log(data)
            let html = '';
            // {{ asset('images/Category/${data[i].product.CATEGORY_NAME}.png') }}
            for (let i = 0; i < data.length; i++) {
                // alert(data[i].product.CATEGORY_NAME);
                const myJSON = JSON.stringify(data[i]);
                html += `
                    <div class="col-12 justify-content-center mt-2">
                        <div class="card">
                            <div class="row g-0">
                                <div class="col-sm-2 col-md-4 text-center resolution-show-cate">
                                    <img src="{{ asset('images/Category/${data[i].product.CATEGORY_NAME}.png') }}" class="img-fluid rounded-start" style="width: 10rem;">
                                </div>
                                <div class="col-sm-8 col-md-8">
                                    <div class="card border-0 h-100 justify-content-center">
                                        <div>
                                            <div class="card-body">
                                                <h5 class="card-title">สัญญาที่ ${i + 1}</h5>
                                                <h4 class="card-text">${data[i].product.SERIES_NAME}</h4>
                                                <button type="button" value='${ myJSON }' id="btn_select_contract" class="btn btn-outline-success">ตรวจสอบ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `
            }
            $('#list_APP_ID').html(html);
            $('#Multi_APP_ID_Modal').modal('show');
        }


        $(document).on("click", "#btn_select_contract", function(e) {
            e.preventDefault();
            const obj = JSON.parse($(this).val());
            // console.log(obj)
            Cookies.set('APP_ID', obj.APP_ID);
            Cookies.set('CUSTOMER_NAME', obj.CUSTOMER_NAME);
            Cookies.set('QUOTATION_ID', obj.QUOTATION_ID);
            // log_login(response.data)
            window.location = '{{ url('/Milestone') }}';
        })


        const log_login = async (data) => {

            let data_log = new Object();
            let Device = new Object();
            data_log['data'] = data[0]

            data_log['data_login'] = {
                id_card: $('#id_card').val().replace(/[^0-9 ]/g, ""),
                b_date: $('#b_date').val().replace(/[^0-9 ]/g, ""),
            }

            let newData = await get_device_info();

            let IP_client = await get_ip().then(function(returndata) {
                return returndata.ip
            });
            Device = {
                IP: IP_client,
                OS_Name: newData.os.os.name,
                OS_Version: newData.os.os.version,
                browser: newData.os.browser.name
            }
            data_log['device_info'] = Device

            axios({
                    method: 'POST',
                    url: 'LOG_Login',
                    data: data_log
                }).then(function(response) {
                    // console.log(response);
                    // window.location = '{{ url('/Milestone') }}';
                    if (response.data.code == '99999') {
                        window.location = '{{ url('/Milestone') }}';
                    } else {
                        Snackbar.show({
                            actionText: 'close',
                            pos: 'top-center',
                            actionTextColor: '#dc3545',
                            backgroundColor: '#323232',
                            width: 'auto',
                            text: 'SYSTEM ERROR',
                            onClose: function() {
                                location.reload();
                            }
                        });
                    }
                    $(".loading").css("display", "none");
                })
                .catch(function(error) {
                    // console.log(error);
                    Snackbar.show({
                        actionText: 'close',
                        pos: 'top-center',
                        actionTextColor: '#dc3545',
                        backgroundColor: '#323232',
                        width: 'auto',
                        text: 'SYSTEM ERROR',
                        onClose: function() {
                            location.reload();
                        }
                    });
                });
        }


    });
</script>
