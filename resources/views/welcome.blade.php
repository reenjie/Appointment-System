<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Medical CLinic</title>

    <!-- Fonts -->
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/css/home.css', '../../node_modules/bootstrap/dist/css/bootstrap.css', '../../node_modules/bootstrap/dist/js/bootstrap.bundle.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body style="background-color: rgb(210, 216, 218)">

    {{--  --}}

    <nav class="shadow">
        <div class="logo" onclick="window.location.href='..' ">
            <span class="title">MC <br>
                <span class="subtitle">clinic Appointment</span>
            </span>

        </div>
       
        <div class="tabs">
            <ul class="menutabs">
                <li onclick="window.location.href='..'" style="cursor: pointer"><a id="home"
                        href="..">Home</a>
                    <div class="line"></div>
                </li>
                <li>
                    <div class="dropdown">
                        <a href="javascript:void()" class="">Clinics</a>


                        <ul class="dropdown-menu">

                            @foreach ($clinics as $item)
                                <li> <a href="" class="dropdown-item">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="line"></div>
                </li>
                <li>


                    <div class="dropdown">
                        <a href="javascript:void()" class="">Doctors</a>


                        <ul class="dropdown-menu">
                            @foreach ($doc as $item)
                                <li> <a href=""
                                        class="dropdown-item">Dr.{{ $item->firstname . ' ' . $item->lastname }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="line"></div>
                </li>


                @if (Route::has('login'))

                    @auth
                        {{-- if loginn --}}
                        @if (Auth::user()->user_type == 'superadmin')
                            <a href="{{ route('superadmin.dashboard') }}" style="text-decoration: none;color:aliceblue">
                            @elseif(Auth::user()->user_type == 'admin')
                                <a href="{{ route('admin.dashboard') }}" style="text-decoration: none;color:aliceblue">
                        @endif


                        <span class="hf " style="font-size:25px">Hi! </span> <span class="hf"
                            style="text-transform:capitalize">{{ Auth::user()->name }}</span>

                        </a>
                    @else
                        {{-- <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a> --}}
                        <li><a href="{{ route('login') }}">Signin</a>
                            <div class="line"></div>
                        </li>

                        {{-- @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                @endif --}}
                    @endauth

                @endif


            </ul>
        </div>

        <button id="btnbars" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight"><i class="fas fa-bars"></i></button>

    </nav>

    <div class="banner">
        <h2 class="af">Welcome to
            <br>
            <span class="af">
                Medical Clinic
            </span>

        </h2>
        {{--  --}}



        <img src="{{ asset('img/3.png') }}" alt="" id="img3">
        <button class="booknow af" onclick="window.location.href='Book' ">Book Now</button>
    </div>

    <div class="main">

        <div class="container reveal">



            <div class="row mt-5 aboutus">
                <div class="col-md-6">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="https://ak.picdn.net/shutterstock/videos/299479/thumb/1.jpg"
                                    class=" w-100 d-block img-thumbnail" alt="..." style="height: 400px">
                            </div>
                            <div class="carousel-item">
                                <img src="https://swall.teahub.io/photos/small/175-1759123_medical-background-images-hd-medical-pictures-for-background.png"
                                    class=" w-100 d-block img-thumbnail" style="height: 400px" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://thumbs.dreamstime.com/z/medical-theme-8825451.jpg"
                                    class=" w-100 d-block img-thumbnail" alt="..." style="height: 400px">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="container">
                        <h1 style="text-align: center;font-weight:bolder" class="af">ABOUT US</h1><br>
                        <p class="p">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque aperiam illum similique
                            dolor voluptatibus nam voluptas sapiente praesentium vitae dolores quo aut, exercitationem
                            tempora laborum rerum nihil porro possimus perferendis.
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque aperiam illum similique
                            dolor voluptatibus nam voluptas sapiente praesentium vitae dolores quo aut, exercitationem
                            tempora laborum rerum nihil porro possimus perferendis.
                        </p>
                    </div>

                </div>


            </div>




            {{-- @for ($i = 0; $i < 100; $i++)
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae quam totam inventore laudantium esse nulla rem est similique ullam sit ipsa, temporibus quo corporis placeat repellendus adipisci. Expedita, quasi explicabo.
                        @endfor --}}
        </div>

        <div class="overview reveal">

            <div class="row">

                <div class="col-md-5">
                    <img src="{{ asset('img/1.png') }}" alt="" id="img1">
                    <br>


                </div>
                <div class="col-md-6">
                    <h2 class="mt-5">KEEP IN TOUCH</h2>


                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Name</h5>
                                    <input type="text" class="txtbox" placeholder="Enter Name">
                                </div>
                                <div class="col-md-12">
                                    <h5>Email</h5>
                                    <input type="email" class="txtbox" placeholder="Enter Email">
                                </div>
                                <div class="col-md-12">
                                    <h5>Message</h5>
                                    <textarea name="" id="" cols="6" rows="6" class="txtbox" style="resize: none"
                                        placeholder="Type your Message here.."></textarea>
                                </div>

                            </div>
                            <button id="submitbtn">Submit</button>

                        </div>
                    </div>
                    <br><br>

                </div>


            </div>

        </div>


        <footer class="mt-5">
            <br>
            <h5 class="" style="text-align:center mt-5">
                All rights Reserved &middot; 2022


            </h5>


        </footer>


    </div>



    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" id="canvasbody">

        </div>
    </div>
    @if (session('Success'))
        <script>
            swal("Your Password Changed Successfully!", "You can now login and feel free to give us some feedbacks. Thank you!",
                "success");
        </script>
    @endif

    <script>
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                } else {
                    reveals[i].classList.remove("active");
                }
            }
        }

        window.addEventListener("scroll", reveal);

        // To check the scroll position on page load
        reveal();
        $('#btnbars').click(function() {
            $('.tabs ul').attr('style', 'display:inline-block;z-index:1');
        })
        var nav = $('.tabs').html();
        $('#canvasbody').html(nav);

        $('#submitbtn').click(function() {
            $('.txtbox').val('');

            swal("Thanks for Sending Message!", "We get back to you Soon!", "success")
        })
    </script>

</body>

</html>
