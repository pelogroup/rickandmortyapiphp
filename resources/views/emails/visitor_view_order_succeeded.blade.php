<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- include head -->
@include('view_visitor.head')
<!-- /include head -->

<body id="bg">

<!-- Boxed Layout -->
<div id="page" class="site boxed-layout">


    <!-- Preloader -->

    <div class="preeloader">
        <div class="preloader-spinner"></div>
    </div>
    <!--	-->
    <!--/ End Preloader -->


{{-- -}}
@include('view_visitor.visitor_navbar')
{{- --}}

<!-- Contact Us -->
    <section class="contact-us section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-12">
                    <!-- Contact Form -->
                    <div class="contact-form-area m-top-30">
                        <h4>{{$title}}</h4>
                        
                        <p>
                            Dear <b>customer,</b> 
                        Your payment has been received.
                        </p>
                        <p>
                        Here are your payment details:
                        </p>

                         <div>
                    {!! '<p>Customer: '.$customerName.'</p><p> Order: '. $orderName. '</p><p>Order Reference number: '.$orderNumber. '</p><p>Paid amount: '.strtoupper($productPrintCurrency).' '. number_format($orderPrice, 0). '</p><p>Date and Time of the transaction: '.$dateTransaction.'</p><p>Last four digits debit/Credit Card: '.$cardLastFour.'</p><p>Status: '. $orderStatus. '</p>' !!}

                        {{--!! 'Order number: '.$orderNumber. '</br>Paid amount: '. $orderPrice !!--}}
                        </div>
                        {{-- -}}
                        <p>Order:  <b> {{ $productPrintName }}</b>  {{ $productPrintCurrency.''.number_format($productPrintPrice, 0) }} </p>
                        {{-- --}}

                    </div>
                    <!--/ End contact Form -->
                </div>





                <div class="col-lg-5 col-md-5 col-12">
                    <br class="contact-box-main m-top-30">
                    <p class="contact-title">
                        {{-- -}}<h2>Order: {{ $productPrintName.' '.$productPrintCurrency.''.number_format($productPrintPrice, 0) }}</h2>
                        Dear <b>customer,</b>
                        {{-- --}}
                        {{-- -}}
                        </br>
                        You are about to pay {{ $productPrintCurrency.''.number_format($productPrintPrice, 0) }} to
                        <b> Pelo Group Limited </b> for the product/service <b>{{ $productPrintName }}</b>.
                        {{-- --}}
                    </p>

                    <p>
                        Pelo Group Limited is registered in England and Wales under company number 13268133 and with our registered office at 79 Penny Meadow, Ashton Under-Lyne, OL6 6EL, United Kingdom.
                    </p>
                    <p>
                        <b>As one-off payment, we did not save your debit/credit card details.</b>
                        {{--We will contact you as soon as possible (within 24 hours). Your ordered product/service will be available as soon as we get all requirements (logo, images, texts, etc.)--}}
                    </p>

                    </br>
                    <p>
                        <b>Not found the right package for you?</b>
                        For any tailored package, please <a href="{{ route('contact') }}"> <b style="color: blue">get in touch here</b>. </a>

                    </p>




                    <!--/ End Single Contact -->
                    {{-- -}}
                    <div class="button">
                        <a href="{{ route('view.index', 'our-portfolio') }}" class="bizwheel-btn theme-1">Our Works<i class="fa fa-angle-right"></i></a>
                    </div>
                    {{-- --}}
                </div>
            </div>
        </div>
</div>
</section>
<!--/ End Contact Us -->










{{-- -}}
<!-- Section -->
@yield('content_visitor')
<!-- /Section -->
{{-- --}}




<!-- include foot -->
@include('emails.email_footer')
<!-- /include foot -->

</body>
</html>