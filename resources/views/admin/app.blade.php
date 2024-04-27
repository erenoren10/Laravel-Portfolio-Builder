<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:title" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:description" content="Fillow : Fillow Saas Admin  Bootstrap 5 Template">
    <meta property="og:image" content="https:/fillow.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>İleri Ajans - YP</title>

    <link rel="shortcut icon" type="image/ico" href="{{ asset('backend/images') }}/favicon.ico">
    <link href="{{ asset('backend/vendor') }}/jquery-nice-select/css/nice-select.css" rel="stylesheet">
    <link href="{{ asset('backend/vendor') }}/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/vendor') }}/nouislider/nouislider.min.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    


    <link href="{{ asset('backend/css') }}/style.css" rel="stylesheet">
    <style>
        th.sorting {
            border-right: 1px solid #ccc;
        }
    </style>
    <style>
            #file {
            background-color: beige;
        }
        a {
        color: #0074d9; /* Metin rengini değiştirin */
        text-decoration: none; /* Alt çizgiyi kaldırın */
        }
        a.button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #0074d9;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        }

        a.button:hover {
        background-color: #0056b3; /* Fare üzerine gelindiğinde renk değişimi */
        }

    </style>
</head>

<body>
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="main-wrapper">
        @include('admin.body.nav_header')
        @include('admin.body.chatbox')
        @include('admin.body.header')
        @include('admin.body.sidebar')
        @yield('admin')
     
    </div>




    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('backend/vendor') }}/global/global.min.js"></script>
    <script src="{{ asset('backend/vendor') }}/chart.js/Chart.bundle.min.js"></script>
    <script src="{{ asset('backend/vendor') }}/jquery-nice-select/js/jquery.nice-select.min.js"></script>

    {{-- <script src="{{ asset('backend/vendor') }}/apexchart/apexchart.js"></script> --}}
    <script src="{{ asset('backend/vendor') }}/chart.js/Chart.bundle.min.js"></script>

    <script src="{{ asset('backend/vendor') }}/peity/jquery.peity.min.js"></script>

    <script src="{{ asset('backend/js') }}/dashboard/dashboard-1.js"></script>
    <script src="{{ asset('backend/vendor') }}/owl-carousel/owl.carousel.js"></script>
    <script src="{{ asset('backend/js') }}/custom.min.js"></script>
    <script src="{{ asset('backend/js') }}/dlabnav-init.js"></script>
    <script src="{{ asset('backend/js') }}/demo.js"></script>
    <script src="{{ asset('backend/js') }}/styleSwitcher.js"></script>


    <script src="{{ asset('backend/vendor') }}/ckeditor/ckeditor.js"></script>


    <script>
        function cardsCenter() {

            /*  testimonial one function by = owl.carousel.js */



            jQuery('.card-slider').owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                //center:true,
                slideSpeed: 3000,
                paginationSpeed: 3000,
                dots: true,
                navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 1
                    },
                    800: {
                        items: 1
                    },
                    991: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1600: {
                        items: 1
                    }
                }
            })
        }

        jQuery(window).on('load', function() {
            setTimeout(function() {
                cardsCenter();
            }, 1000);
        });
    </script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;
                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;
                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;
                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="{{ asset('backend/js/code.js') }}"></script>
    <script src="{{ asset('backend/js/validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js" ></script>

</body>

</html>
