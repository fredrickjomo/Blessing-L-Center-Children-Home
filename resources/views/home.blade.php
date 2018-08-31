@extends('layouts.main')
@section('content')

    <link rel="stylesheet" href="{{asset('css/custom-css/welcome.css')}}" >
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6 col-12 col-lg-6 alert alert-secondary slider-column" >
                <div id="slideIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slideIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#slideIndicators" data-slide-to="1"></li>
                        <li data-target="#slideIndicators" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{asset('images/image_slider/image1.jpg')}}" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h4>Sponsor</h4>
                                <p>Let's help educate the needy</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/image_slider/blc1.jpg')}}" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h4>Adopt</h4>
                                <p>Let's reduce the number of orphans in the orphanages</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/image_slider/blc2.jpg')}}" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h4>Donate Now</h4>
                                <p>Let's help feed and house the needy</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/image_slider/blc3.jpg')}}" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h4>Help In Fundraising</h4>
                                <p>Help run an orphanage as a home for the needy</p>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/image_slider/image4.jpg')}}" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h4>Help Raise A Charity Event</h4>
                                <p>And be part of us</p>
                            </div>
                        </div>




                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{asset('images/image_slider/image12.jpg')}}" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h4>&ldquo;Orphanages are the only places that left me feeling empty and full at the same time&rdquo;-John M. Simmons</h4>
                            </div>
                        </div>


                    </div>

                    <a class="carousel-control-prev" href="#slideIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#slideIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>


            </div>
            <!--Right side div of the row-->
            <div class="col-md-6 col-12 col-lg6 alert alert-secondary">
                <div class="info">
                    <h1>OUR MISSION:</h1>
                    <p>In the heart of every child is a hunger for home. Not just for food and a place to sleep, but for safety and community. Most importantly for love.
                        <br>At Blessing Learning Centre, found in Nakuru Kenya, there is much more than a home for many Kenyan
                        homeless and vulnerable orphans.
                        We are a family, where God’s love guides us all as we grow and expand year after year.<br>
                        We're working towards bringing hope to the homeless kids of kenya.Take action and help us protect the orphans by
                        sponsoring a child of your choice,making a donation,adopting, funding a project or help host a charity event(s).
                    </p>
                    <p><strong>Mission:</strong>Reach out to the needy children and help them to overcome various challenges</p>
                    <p>&ldquo;Perhaps there are those who are able to go about thier lives unfettered by such concerns.But for those like us, our fate is to face the world as orphans,
                        chasing through long years the shadows of vanished parents.There is nothing for it but to try and see through our missions
                        to the end, as best we can, for until we do so, we will be permitted no calm&rdquo;-by<div id="author">
                        Kazuo Ishiguro,When we were orphans</p></div>

            </div>
        </div>

    </div>
    </div>

    <div class="container">
        <div class="col-12">
            <section>
                In Kenya, it is estimated that there are approximately 3.6 million children aged below 18 years who have been orphaned or who are vulnerable.As per the data from the second Kenya AIDS Indicator Survey (KAIS 2012) to determine the number and profile of orphans and vulnerable children (OVC) in Kenya who were aged below 18 years that was determined.<br><br>
                Kenya AIDS Indicator Survey (KAIS 2012) estimated that there were 2.6 million OVC in Kenya in 2012, of whom 1.8 million were orphans and 750,000 were vulnerable. Among orphans, 15% were double orphans. Over one-third of all the OVC were aged between 10 and 14 years. Households with ≥1 OVC (12% of all households) were usually in the lowest 2 wealth quintiles, and 22% of OVC households had experienced moderate or severe hunger. Receipt of OVC support services was low for medical (3.7%), psychological (4.1%), social (1.3%), and material support (6.2%); educational support was slightly more common (11.5%). Orphanhood among children aged below 15 years increased from 1993 to 2003 (P < 0.01) but declined from 2003 to 2012 (P < 0.01).<br><br>
                The 2.6 million OVC constitute a significant proportion of Kenya's population aged below 18 years. Special attention should be paid to OVC to prevent further vulnerability and ensure their well-being and development as they transition into adulthood.
            </section>


        </div>



    </div>

@endsection
