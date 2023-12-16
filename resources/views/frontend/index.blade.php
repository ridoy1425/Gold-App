@extends('frontend.frontend_master')

@section('style-lib')
@endsection

@push('custom-css')
    <style type="text/css">

    </style>
@endpush

@section('main-content')
    <!-- Slider Section -->
    <section class="slider-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1>Buy GOLD</h1>
                    <h2>Get halal profit up to <span class="gold">36 - 48%</span></h2>
                    <h3>Use the World Shine App</h3>
                    <div class="btn-set">
                        <a class="btn no-style"><img src="{{ url('ui/frontend_assets') }}/img/btn/playstore.png"></a>
                        <a class="btn no-style"><img src="{{ url('ui/frontend_assets') }}/img/btn/appstore.png"></a>
                    </div>
                </div>
                <div class="col-lg-6 align-items-end d-flex">
                    <div class="bn-img">
                        <img src="{{ url('ui/frontend_assets') }}/img/banner/banner-img.png">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- How It Works section start -->
    <section class="hiw-section" id="hiw-section">


        <div class="container">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-one-tab" data-toggle="tab" href="#nav-one" role="tab"
                        aria-controls="nav-one" aria-selected="true">
                        <span class="icon">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22.5 22.5V12.5H27.5V22.5H37.5V27.5H27.5V37.5H22.5V27.5H12.5V22.5H22.5ZM25 50C11.1929 50 0 38.807 0 25C0 11.1929 11.1929 0 25 0C38.807 0 50 11.1929 50 25C50 38.807 38.807 50 25 50ZM25 45C36.0457 45 45 36.0457 45 25C45 13.9543 36.0457 5 25 5C13.9543 5 5 13.9543 5 25C5 36.0457 13.9543 45 25 45Z"
                                    fill="#CE9856" />
                            </svg>
                        </span>
                        <span>{{ $category1->tab_title ?? '' }}</span>
                    </a>
                    <a class="nav-link" id="nav-two-tab" data-toggle="tab" href="#nav-two" role="tab"
                        aria-controls="nav-two" aria-selected="false">
                        <span class="icon">
                            <svg width="55" height="41" viewBox="0 0 55 41" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.9114 32.6819C19.3048 36.9459 15.6581 40.2239 11.25 40.2239C6.8419 40.2239 3.19515 36.9459 2.5886 32.6819H0V2.51399C0 1.12556 1.1193 0 2.5 0H37.5C38.8807 0 40 1.12556 40 2.51399V7.54198H47.5L55 17.738V32.6819H49.9115C49.3047 36.9459 45.658 40.2239 41.25 40.2239C36.842 40.2239 33.1953 36.9459 32.5885 32.6819H19.9114ZM35 5.02799H5V25.2669C6.58815 23.6371 8.80165 22.6259 11.25 22.6259C14.7405 22.6259 17.7536 24.6811 19.158 27.6539H33.342C33.7612 26.7665 34.324 25.9605 35 25.2669V5.02799ZM40 20.1119H50V19.3955L44.9793 12.57H40V20.1119ZM41.25 35.1959C42.8828 35.1959 44.2718 34.1466 44.7865 32.6819C44.9248 32.2887 45 31.8656 45 31.4249C45 29.3423 43.321 27.6539 41.25 27.6539C39.179 27.6539 37.5 29.3423 37.5 31.4249C37.5 31.8656 37.5752 32.2887 37.7135 32.6819C38.2282 34.1466 39.6172 35.1959 41.25 35.1959ZM15 31.4249C15 29.3423 13.3211 27.6539 11.25 27.6539C9.17893 27.6539 7.5 29.3423 7.5 31.4249C7.5 31.8656 7.5752 32.2887 7.71338 32.6819C8.22818 34.1466 9.61722 35.1959 11.25 35.1959C12.8828 35.1959 14.2718 34.1466 14.7866 32.6819C14.9248 32.2887 15 31.8656 15 31.4249Z"
                                    fill="url(#paint0_linear_373_60)" />
                                <defs>
                                    <linearGradient id="paint0_linear_373_60" x1="3.65506" y1="3.8475" x2="51.6856"
                                        y2="40.0025" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#CE9856" />
                                        <stop offset="1" stop-color="#E0B24D" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                        <span>{{ $category2->tab_title ?? '' }}</span>
                    </a>
                    <a class="nav-link" id="nav-three-tab" data-toggle="tab" href="#nav-three" role="tab"
                        aria-controls="nav-three" aria-selected="false">
                        <span class="icon">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.01492 31.3075L14.519 22.8035L21.59 29.8745L29.4823 21.9822L25 17.5H37.5V30L33.0178 25.5177L21.59 36.9455L14.519 29.8745L8.33364 36.0597C11.9167 41.4485 18.0436 45 25 45C36.0458 45 45 36.0457 45 25C45 13.9543 36.0458 5.00001 25 5.00001C13.9543 5.00001 5 13.9543 5 25C5 27.204 5.35647 29.3245 6.01492 31.3075ZM2.17 35.203L2.14467 35.1777L2.15435 35.168C0.7697 32.0617 0 28.6207 0 25C0 11.1929 11.1929 0 25 0C38.807 0 50 11.1929 50 25C50 38.8072 38.807 50 25 50C14.8271 50 6.07344 43.924 2.17 35.203Z"
                                    fill="url(#paint0_linear_373_62)" />
                                <defs>
                                    <linearGradient id="paint0_linear_373_62" x1="8.68056" y1="12.5" x2="44.6181"
                                        y2="45.3125" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#CE9856" />
                                        <stop offset="1" stop-color="#DBAB4F" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                        <span>{{ $category3->tab_title ?? '' }}</span>
                    </a>
                    <a class="nav-link" id="nav-four-tab" data-toggle="tab" href="#nav-four" role="tab"
                        aria-controls="nav-four" aria-selected="false">
                        <span class="icon">
                            <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.17756 5.64167C18.9976 -2.4043 33.5113 -1.8441 42.6778 7.32232C52.4407 17.0854 52.4407 32.9145 42.6778 42.6777C32.9145 52.4408 17.0854 52.4408 7.32233 42.6777C1.01109 36.3665 -1.22031 27.5203 0.628065 19.4166L0.819665 18.6349L5.65574 19.9079C3.91196 26.5575 5.64601 33.9303 10.8579 39.1423C18.6683 46.9525 31.3315 46.9525 39.142 39.1423C46.9525 31.3318 46.9525 18.6684 39.142 10.8579C32.098 3.81375 21.1065 3.12258 13.2879 8.78438L12.7349 9.19958L15.2773 11.7418L3.78679 14.3934L6.43843 2.90293L9.17756 5.64167ZM27.5 10V15H33.75V20H20C19.3096 20 18.75 20.5597 18.75 21.25C18.75 21.8638 19.1922 22.374 19.7753 22.4798L20 22.5H30C33.4518 22.5 36.25 25.2983 36.25 28.75C36.25 32.2018 33.4518 35 30 35H27.5V40H22.5V35H16.25V30H30C30.6903 30 31.25 29.4403 31.25 28.75C31.25 28.1362 30.8078 27.626 30.2248 27.5202L30 27.5H20C16.5482 27.5 13.75 24.7017 13.75 21.25C13.75 17.7982 16.5482 15 20 15H22.5V10H27.5Z"
                                    fill="url(#paint0_linear_373_41)" />
                                <defs>
                                    <linearGradient id="paint0_linear_373_41" x1="9.375" y1="5.38194" x2="40.9722"
                                        y2="50" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#CE9856" />
                                        <stop offset="1" stop-color="#DDAE4E" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                        <span>{{ $category4->tab_title ?? '' }}</span>
                    </a>
                    <a class="nav-link" id="nav-five-tab" data-toggle="tab" href="#nav-five" role="tab"
                        aria-controls="nav-five" aria-selected="false">
                        <span class="icon">
                            <svg width="50" height="51" viewBox="0 0 50 51" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M43.0411 16.1301H45.4545C47.965 16.1301 50 18.1934 50 20.7386V29.9558C50 32.5011 47.965 34.5644 45.4545 34.5644H43.0411C41.9227 43.6578 34.2718 50.6944 25 50.6944V46.0859C32.5311 46.0859 38.6364 39.8958 38.6364 32.2601V18.4343C38.6364 10.7986 32.5311 4.60859 25 4.60859C17.4688 4.60859 11.3636 10.7986 11.3636 18.4343V34.5644H4.54545C2.03507 34.5644 0 32.5011 0 29.9558V20.7386C0 18.1934 2.03507 16.1301 4.54545 16.1301H6.95884C8.07725 7.0366 15.7281 0 25 0C34.2718 0 41.9227 7.0366 43.0411 16.1301ZM4.54545 20.7386V29.9558H6.81818V20.7386H4.54545ZM43.1818 20.7386V29.9558H45.4545V20.7386H43.1818ZM15.3624 34.0687L17.7718 30.1602C19.8673 31.4909 22.345 32.2601 25 32.2601C27.655 32.2601 30.1327 31.4909 32.2282 30.1602L34.6377 34.0687C31.8436 35.843 28.54 36.8687 25 36.8687C21.46 36.8687 18.1564 35.843 15.3624 34.0687Z"
                                    fill="url(#paint0_linear_373_42)" />
                                <defs>
                                    <linearGradient id="paint0_linear_373_42" x1="11.236" y1="3.7024"
                                        x2="42.7281" y2="50.2935" gradientUnits="userSpaceOnUse">
                                        <stop offset="0.185906" stop-color="#CA9658" />
                                        <stop offset="1" stop-color="#E6B94B" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                        <span>{{ $category5->tab_title ?? '' }}</span>
                    </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <!-- tab 1 content -->
                <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">
                    <div class="container pt-5">
                        <div class="row">
                            <div class="col-lg-7 d-flex flex-column justify-content-between">
                                <div class="tab-con-box">
                                    <h2 class="title">{{ $category1->sub_title ?? '' }}</h2>
                                    <p>{{ $category1->description ?? '' }}</p>
                                </div>
                                <div class="btn-set wh-bg">
                                    <a class="btn no-style"><img
                                            src="{{ url('ui/frontend_assets') }}/img/btn/playstore.png"></a>
                                    <a class="btn no-style"><img
                                            src="{{ url('ui/frontend_assets') }}/img/btn/appstore.png"></a>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="tab-img">
                                    <img src="{{ url('ui/frontend_assets') }}/img/hiw/tab-img-1.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- tab 2 content -->
                <div class="tab-pane fade" id="nav-two" role="tabpanel" aria-labelledby="nav-two-tab">
                    <div class="container pt-5">
                        <div class="row">
                            <div class="col-lg-7 d-flex flex-column justify-content-between">
                                <div class="tab-con-box">
                                    <h2 class="title">{{ $category2->sub_title ?? '' }}</h2>
                                    <p>{{ $category2->description ?? '' }}</p>
                                </div>
                                <div class="btn-set wh-bg">
                                    <a class="btn no-style"><img
                                            src="{{ url('ui/frontend_assets') }}/img/btn/playstore.png"></a>
                                    <a class="btn no-style"><img
                                            src="{{ url('ui/frontend_assets') }}/img/btn/appstore.png"></a>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="tab-img">
                                    <img src="{{ url('ui/frontend_assets') }}/img/hiw/tab-img-2.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- tab 3 content -->
                <div class="tab-pane fade" id="nav-three" role="tabpanel" aria-labelledby="nav-three-tab">
                    <div class="container pt-5">
                        <div class="row">
                            <div class="col-lg-7 d-flex flex-column justify-content-between">
                                <div class="tab-con-box">
                                    <h2 class="title">{{ $category3->sub_title ?? '' }}</h2>
                                    <p>{{ $category3->description ?? '' }}</p>
                                </div>
                                <div class="btn-set wh-bg">
                                    <a class="btn no-style"><img
                                            src="{{ url('ui/frontend_assets') }}/img/btn/playstore.png"></a>
                                    <a class="btn no-style"><img
                                            src="{{ url('ui/frontend_assets') }}/img/btn/appstore.png"></a>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="tab-img">
                                    <img src="{{ url('ui/frontend_assets') }}/img/hiw/tab-img-1.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- tab 4 content -->
                <div class="tab-pane fade" id="nav-four" role="tabpanel" aria-labelledby="nav-four-tab">
                    <div class="container pt-5">
                        <div class="row">
                            <div class="col-lg-7 d-flex flex-column justify-content-between">
                                <div class="tab-con-box">
                                    <h2 class="title">{{ $category4->sub_title ?? '' }}</h2>
                                    <p>{{ $category4->description ?? '' }}</p>
                                </div>
                                <div class="btn-set wh-bg">
                                    <a class="btn no-style"><img
                                            src="{{ url('ui/frontend_assets') }}/img/btn/playstore.png"></a>
                                    <a class="btn no-style"><img
                                            src="{{ url('ui/frontend_assets') }}/img/btn/appstore.png"></a>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="tab-img">
                                    <img src="{{ url('ui/frontend_assets') }}/img/hiw/tab-img-2.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- tab 5 content -->
                <div class="tab-pane fade" id="nav-five" role="tabpanel" aria-labelledby="nav-five-tab">
                    <div class="container pt-5">
                        <div class="row">
                            <div class="col-lg-7 d-flex flex-column justify-content-between">
                                <div class="tab-con-box">
                                    <h2 class="title">{{ $category5->sub_title ?? '' }}</h2>
                                    <p>{{ $category5->description ?? '' }}</p>
                                </div>
                                <div class="btn-set wh-bg">
                                    <a class="btn no-style"><img
                                            src="{{ url('ui/frontend_assets') }}/img/btn/playstore.png"></a>
                                    <a class="btn no-style"><img
                                            src="{{ url('ui/frontend_assets') }}/img/btn/appstore.png"></a>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="tab-img">
                                    <img src="{{ url('ui/frontend_assets') }}/img/hiw/tab-img-1.png">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- How it works section end -->


    <!-- call to action section start -->
    <section class="cta-section">
        <div class="container text-center">
            <img src="{{ url('ui/frontend_assets') }}/img/cta/cta-img.png">
        </div>
        <div class="cta-text-section">
            <div class="container text-center">
                <h2>Halal & Secure, Trading Platform</h2>
                <h4>Make your halal profit in every month</h4>
            </div>
        </div>
    </section>
    <!-- call to action section end -->


    <!-- FAQ section start -->
    <section class="faq-section" id="faq-section">
        <div class="tab-header-section">
            <div class="container">
                <h2 class="faq-title">Frequently Asked Questions</h2>
            </div>
        </div>

        <div class="container">

            <div id="accordion" class="accordion">
                <div class="card mb-0">
                    @foreach ($questionSection as $questionSections)
                        <div class="card-header" data-toggle="collapse" href="#collapseOne">
                            <a class="card-title">
                                {{ $questionSections->title ?? '' }}
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion">
                            <p>{{ $questionSections->description ?? '' }}</p>
                        </div>
                    @endforeach
                    {{-- <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
			                <a class="card-title">
			                  2. Frequently Asked Questions
			                </a>
			            </div>
			            <div id="collapseTwo" class="collapse" data-parent="#accordion" >
			                <p>Gold is a chemical element; it has symbol Au and atomic number 79. In pure form, it is a bright, slightly orange-yellow, dense, soft, malleable, and ductile metal. </p>
			            </div>

			            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
			                <a class="card-title">
			                  3. Frequently Asked Questions
			                </a>
			            </div>
			            <div id="collapseThree" class="collapse" data-parent="#accordion" >
			                <p>Gold is a chemical element; it has symbol Au and atomic number 79. In pure form, it is a bright, slightly orange-yellow, dense, soft, malleable, and ductile metal. </p>
			            </div>

			            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
			                <a class="card-title">
			                  4. Frequently Asked Questions
			                </a>
			            </div>
			            <div id="collapseFour" class="collapse" data-parent="#accordion" >
			                <p>Gold is a chemical element; it has symbol Au and atomic number 79. In pure form, it is a bright, slightly orange-yellow, dense, soft, malleable, and ductile metal. </p>
			            </div>

			            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
			                <a class="card-title">
			                  5. Frequently Asked Questions
			                </a>
			            </div>
			            <div id="collapseFive" class="collapse" data-parent="#accordion" >
			                <p>Gold is a chemical element; it has symbol Au and atomic number 79. In pure form, it is a bright, slightly orange-yellow, dense, soft, malleable, and ductile metal. </p>
			            </div> --}}

                </div>



            </div>
        </div>

    </section>
    <!-- FAQ section end -->


    <!-- About Section start -->
    <section class="about-section" id="about-section">
        <div class="container">
            <div class="title-section">
                <img src="{{ url('ui/frontend_assets') }}/img/about/about-title-img.png">
                <div class="title-box">
                    <h2>{{ $aboutSection->title ?? '' }}</h2>
                </div>
            </div>
            <div class="about-content">
                <p>{{ $aboutSection->description ?? '' }}</p>
            </div>
        </div>
    </section>
    <!-- About section end -->


    <!-- Process Section Starts -->
    <section class="process-section" id="trading-section">
        <div class="container">
            <div class="row">

                <div class="col-lg-4">
                    <div class="hero-box">
                        <div class="hero-icon one">
                            <img src="{{ url('ui/frontend_assets') }}/img/service/gold.svg">
                        </div>
                        <h3>1. Safe Invest in gold</h3>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="hero-box">
                        <div class="hero-icon two">
                            <img src="{{ url('ui/frontend_assets') }}/img/service/calendar.svg">
                        </div>
                        <h3>2. Collect profit every month</h3>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="hero-box">
                        <div class="hero-icon three">
                            <img src="{{ url('ui/frontend_assets') }}/img/service/handshake.svg">
                        </div>
                        <h3>3. Become a happy partner</h3>
                    </div>
                </div>

            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="btn-set wh-bg">
                <a class="btn no-style"><img src="{{ url('ui/frontend_assets') }}/img/btn/playstore.png"></a>
                <a class="btn no-style"><img src="{{ url('ui/frontend_assets') }}/img/btn/appstore.png"></a>
            </div>
        </div>
    </section>
    <!-- Process Section Ends -->



    <!-- Contact Section Starts -->
    <section class="contact-section" id="contact-section">
        <div class="cloud-space">
            <img src="{{ url('ui/frontend_assets') }}/img/cloud.png">
        </div>
        <div class="contact-form-section text-center">
            <h2 class="title">Contact with us</h2>
            <form action="">
                <div class="f-group">
                    <input type="text" id="name" required class="" placeholder=" ">
                    <label for="name">Your Name</label>
                </div>

                <div class="f-group">
                    <input type="email" id="email" placeholder=" ">
                    <label for="email">Email</label>
                </div>

                <div class="f-group">
                    <input type="text" id="adres" placeholder=" ">
                    <label for="adres">Subject</label>
                </div>

                <div class="f-group">
                    <textarea id="mesge" placeholder=" "></textarea>
                    <label for="mesge">Write your message</label>
                </div>

                <button class="btn btn-black" type="submit">Send Message <i class="fa fa-angle-right"></i></button>
            </form>
        </div>
    </section>
    <!-- Contact Section Ends -->

    <section class="contact-section-bottom">
        <img src="{{ url('ui/frontend_assets') }}/img/footer-top.png">
    </section>
@endsection

@section('script-lib')
@endsection

@push('custom-js')
@endpush
