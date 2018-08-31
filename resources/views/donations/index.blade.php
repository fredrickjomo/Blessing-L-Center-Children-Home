@extends('layouts.main')
@section('content')
<style>
    body ,html{
        background-color: #f8f9fa;
    }
    .sticker{

        font-family: Garamond;
        padding: 0;
        margin: 0;
    }

    .sticker .header{
        background-image:url("../../images/Donate_images/clothing.png");
        height: auto;
        padding-bottom: 30px;
        background-color: #f8f9fa;
    }
    .sticker .col-md-12 button{
        margin-top: 6%;
        text-align: center;
        color: #f8f9fa;
        font-size: 60px;
        line-height: 1.5em;
        background-color: black ;
        opacity: 0.8;
        margin-bottom: 2%;

    }
    .sticker .header h2{
        padding-top: 40px;
        padding-bottom: 40px;
        text-align: center;
        background-color: black ;
        opacity: 0.8;
    }
    .information-division{
        background-color:#062c33;
        //margin-top: 21%;

    }
    .information-division h2{
        background-color: transparent;
        color: #f8f9fa;
        padding-top: 10px;
        text-align: center;
    }
    .information-division .image-div{
        //background-image:url("../../images/Donate_images/18.jpg");
        padding: 0;
    }
    .information-division .col-md-6 .carousel img{
        height: 430px;
        width: 100%



    }
    .information-division .col-md-6 p{
        color: #f8f9fa;
        font-size: 20px;
    }
    .useful-goods{
        background-color: #005cbf;
    }
    .useful-goods h2{
        padding-top: 10px;
        padding-bottom: 0px;
    }
    .useful-goods i{
        font-size: 50px;
        font-weight: bolder;
        margin-left: 48%;
        color:#f8f9fa;
    }
    .useful-goods ol li{
        list-style-type: disc;
        font-size: 20px;
        font-family: Garamond;
        color: #f8f9fa;
        margin-left: 1%;

    }
    .address{
        background-color: #1b1e21;
    }
    .address h2{
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .address p{
        color: #f8f9fa;
        align-items: center;
        text-align: center;
        font-size: 20px;
    }
    .address .inst{
        font-size: 25px;
    }
</style>
    <div class="container-fluid sticker">
        <div class="row">
            <div class="col-md-12 header">
                <div class="row">
                    <div class="col-md-6">
                        <button class="col-md-12 col-12">Donate Goods</button>
                    </div>
                    <div class="col-md-6">
                        <a href="{{asset('donations/donate_financially')}}" ><button class="col-md-12 col-12"><i class="fa fa-money"></i> Donate Financially</button></a>
                    </div>
                </div>


                <h2>Help Make A Difference at <strong>Blessing Learning Centre and Children Home</strong></h2>

                
            </div>
            <div class="col-md-12 information-division">
                <div class="row">
                <div class="col-md-6">
                    <h2>Donating Goods</h2>
                    <p>A really great way to help us out is to donate goods to our institution/orphanage (goods in kind).
                        This can be done by collecting together clothes (new or second hand), books, toys, pencils,bags…
                        etc. and then bundle them up in a parcel and send them out to us or if you can reach us, you can
                        make a personal/group visit to our place with the goods. We have put together a
                        little list below of some useful items to us (our children). Sometimes this can be a little
                        expensive for people so perhaps you could try getting together with a group of friends or
                        colleagues.Over the years we have received plenty of different things in the post, from the
                        ordinary (shoes, watches, clothes) to the extraordinary ones. There is very little that we can’t
                        use.<br>
                    If you're in possession of an item that you think that might be helpful to us and not listed below,
                    dont hesistate to contact us and let us advice accordingly.</p>
                </div>
                <div class="col-md-6 image-div">

                    <div id="myCarousel" class="carousel slide bg-inverse w-100 ml-auto mr-auto" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{asset('images/Donate_images/book-donation.jpg')}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('images/Donate_images/donations.jpg')}}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('images/Donate_images/food-donation.jpg')}}" alt="Third slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('images/Donate_images/sports-balls.jpg')}}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>


                </div>

            </div>
            </div>
            <div class="col-md-12 useful-goods">
                <h2>Useful goods to us:</h2>
                <i class="fa fa-angle-down"></i>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <ol>
                            <li>Library Books (reference books, novels,children's story books)</li>
                            <li>Sports equipment (balls(basketball,volleyball,handball,etc))</li>
                            <li>Toys e.g dolls,cars ,etc</li>
                            <li>School bags(backpacks)</li>
                            <li>Shoes</li>
                            <li>T-shirts and shirts(medium and small sizes)</li>
                            <li>Boys/Girls Jeans(age 8 to adults)</li>
                            <li>Belts(especially for boys)</li>
                            <li>Food stuffs(e.g grains and cerials such as rice and maize)</li>
                            <li>Bar and bathing soaps</li>
                            <li>Stationary, pens, pencils, rubbers</li>
                            <li>...etc</li>
                        </ol>
                    </div>
                    <div class="col-md-3"></div>
                </div>



            </div>
            <div class="col-md-12 address">
                <h2>Our Postal Address to send your package:</h2>
                <p class="inst">Blessing Learning Centre</p>
                <p>P.O BOX 14057-20100</p>
                <p>Postal Code: 20100</p>
                <p>NAKURU</p>
                <p>KENYA</p>
            </div>
            <style>
                .shipping{
                    background-color: transparent;
                }
                .shipping h2{
                    padding-top: 10px;
                    padding-bottom: 10px;
                    color: #721c24;
                }
                .shipping p{
                    font-size: 20px;
                    padding-bottom: 20px;
                }
                .shipping .row .col-md-3 img{
                    height: 80px;
                    padding-bottom: 30px;
                }
            </style>
            <div class="col-md-12 shipping">
                <h2>Shipping and Couriers</h2>
                <p>We encourage and recommend to well wishers and donors who may wish to donate to us
                    to use Kenyan Government Postal Services e.g the <strong>Kenya Airways Cargo</strong>
                and other trusted non governmental couriers such as DHL, G4S, FARGO COURIER LIMITED and TNT Express Worldwide Kenya
                while sending your packages and parcels to us.</p>

                <div class="row">
                    <div class="col-md-3">
                        <img src="{{asset('images/Donate_images/couriers/DHL.png')}}">
                    </div>
                    <div class="col-md-3">
                        <img src="{{asset('images/Donate_images/couriers/FARGO.jpg')}}">
                    </div>
                    <div class="col-md-3">
                        <img src="{{asset('images/Donate_images/couriers/G4S.png')}}">
                    </div>
                    <div class="col-md-3">
                        <img src="{{asset('images/Donate_images/couriers/TNT.png')}}">
                    </div>

                </div>
            </div>

        </div>
    </div>



    @endsection