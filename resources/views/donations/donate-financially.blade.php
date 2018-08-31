@extends('layouts.main')
@section('content')
    <style>
        .donation{
            padding: 0px;
            margin-top: 0;
            font-family: Garamond;
        }
        .col-md-12{
            background-color: rgba(30,36,219,0.33);
        }
        .col-md-12 h1{
            font-size: 40px;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .col-md-12 .col-md-6 button{
            font-size: 30px;
            margin-bottom: 4%;

        }
        .col-md-12 .col-md-6 button:hover{
            background-color: black;
            color: #f8f9fa;
        }
        .col-md-12 .col-md-6 p{
            font-size: 20px;
        }

        .col-md-12 .col-md-6 li{
            list-style-type: decimal;
            font-size: 20px;
        }
        .col-md-12 .col-md-6 a{
            color: #005cbf;
        }
        .col-md-12 .col-md-6 a:hover{
            color: #1c7430;
        }
        .col-md-12 .col-md-6 h4,h5{
            margin-left: 25px;
        }
        .payment{
            background-color: #f8f9fa;
            padding: 0;
        }
        .payment i {
            font-size: 30px;

        }
        .payment #western-union{
            color: yellow;
            background-color: black;
        }
        .payment #paypal{
            color: #005cbf;
        }
        .payment #bank-transfer{
            color: #1c7430;
            font-weight: bold;
        }
        #donate-financially{
            display: none;
        }
        .payment img{
            height: 445px;
            width: 100%;
        }
        #quote{
            font-family: Georgia;
            font-style: italic;
            font-size: 20px;
        }
        .more-info{
            background-color:rgba(16,52,133,0.75);
        }
        .more-info h2{
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .more-info p{
            font-size: 20px;
            color: #f8f9fa;
        }
        .more-info a:hover{
            color: black;

        }
    </style>
    <div class="container-fluid  donation ">
        <div class="row">
            <div class="col-md-12 ">
                <div class="row">
                    <!--left hand side div-->
                    <div class="col-md-6">
                        <h1>Donate Financially</h1>
                        <p>Help us <strong>run</strong> the orphanage, <strong>shelter</strong>, <strong>cloth</strong>, <strong>feed</strong> and <strong>educate</strong> the needy</p>
                        <button class="col-md-4">Give Now</button>
                        <p>Donate using any of the methods available by clicking on the <strong>Give Now</strong>
                            button above and see how you can donate your finance<br></p>
                        <p id="quote">"The life of a man consists not in seeing visions and dreaming dreams, but in active charity and in willing
                            serving"-Henry Wadsworth Longfellow</p>
                        <p>Read more on financial donation...<i class="fa fa-angle-down"></i></p>
                    </div>
                    <!--right side sub div-->
                    <div class="col-md-6 payment">
                        <img id="blc" src="{{asset('images/others/blc1.jpg')}}">
                        <div id="donate-financially">
                        <h4>Give Now:</h4>
                        <h5>Payment Methods :</h5>
                        <ol>
                            <li>
                                <i class="pf pf-bank-transfer" id="bank-transfer"></i>&nbsp;<strong>Bank Transfer</strong> (Only in Kenya): - For Donations within Kenya,
                                Send the amount you wish to donate to <strong>Blessing Learning Center</strong> to:<br>
                                Bank Name:<strong> Cooperative Bank</strong><br>
                                Account Number: <strong>01109737004500</strong>
                            </li>
                            <li>
                                <i class="pf pf-western-union-alt" id="western-union"></i>&nbsp;<strong>Western Union:</strong>We accept financial donations via Western Union, Make payment
                                then <a href="{{route('Contact_Us.index')}}">contact us</a> by leaving us with the <strong>payment  details</strong> so
                                that we can easily access the funds. This method is open to everyone regardless of the location (country).
                            </li>
                            <li>
                                <i class="pf pf-paypal" id="paypal"></i>&nbsp;or<i class="fa fa-credit-card" id="paypal" aria-hidden="true"></i>&nbsp;<strong>PayPal/Visa Card</strong>(All Countries): -We accept
                                donations via paypal/Visa card also. If you wish to donate through this method, please use
                                <a href="{{route('paypal')}}"> <i class="pf pf-paypal" id="paypal"></i></a>&nbsp;or
                                <a href="" onclick="visaCard()">
                                    <i class="fa fa-credit-card" id="paypal" aria-hidden="true"></i></a>.
                                <br>


                            </li>
                        </ol>
                            <script>
                                function visaCard() {
                                    window.open('{{url("/enter-amount")}}',"_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=500,width=650,height=550");
                                }
                            </script>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12 more-info">
                <h2>Financial Donation</h2>

                <p>We're very thankful for your interest in supporting us financially by donating to our institution/orphanage,
                    there are different options/ways that you can help out - depending on which
                    country you are in. Feel free to contact us for more information</p>
                <p>We believe that transparency is extremely important and want to be
                    clear that there are absolutely zero administration fees deducted from donations
                    independent of banking charges.</p>
                <p>Please Note that:<br></p>
                <p>
                    ALL THE DONATIONS MADE BY OUR WELL WISHERS, WILL BE USED FOR THE CHILDREN AS A WHOLE,
                    OFTEN GOING TOWARDS THINGS LIKE BLANKETS, CLOTHES, FOOD AND SOMETIMES EVEN SPECIAL PROGRAMS
                    LIKE ADDITIONAL SCHOOLING (TUITION FEES) OR CHRISTMAS PRESENTS. IF YOU WOULD LIKE MORE INFORMATION
                    ABOUT THIS, OR ANY OTHER MONTHLY PAYMENT OPTIONS, OR IF YOU WOULD LIKE YOUR DONATIONS TO GO TOWARDS
                    SOMETHING SPECIFIC, PLEASE FEEL FREE TO <a href="{{route('Contact_Us.index')}}">CONTACT US.</a>

                </p>
            </div>


        </div>

    </div>
    <script src="{{asset('js/jquery-3.2.1.js')}}"></script>
<script>
    $(document).ready(function () {
        $(":button").click(function () {
            $("#blc").hide(3000);
            $("#donate-financially").show(3000);
        });
        
    });
</script>
    @endsection