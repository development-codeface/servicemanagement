<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
<link rel="shortcut icon" href="{{ asset('assets/frontend/img/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{ asset('assets/frontend/img/favicon.ico')}}" type="image/x-icon">
 <title>NetProclivity</title>
    <link href="{{ asset('assets/frontend/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/frontend/css/media-1000-685.css')}}" rel="stylesheet" type="text/css">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>




</head>
<body>
<div class="inner_banner">
	 <div class="top_sec"><div class="container">
     <div class="top_sec_left">
                <a href="https://www.facebook.com/"><img src="{{ asset('assets/frontend/img/facebook.png')}}"  alt=""/></a>
                <a href="https://twitter.com/"><img src="{{ asset('assets/frontend/img/twitter.png')}}"  alt=""/></a>
                <a href="https://www.instagram.com/"><img src="{{ asset('assets/frontend/img/instagram.png')}}"  alt=""/></a>
                <a href="https://www.linkedin.com"><img src="{{ asset('assets/frontend/img/linkedin.png')}}"  alt=""/></a></div>
            <!-- <div class="top_sec_right">
                <form>
                    <input type="text" name="search" placeholder="Search..">
                </form>
                <div class="login_sec"><a href="">login</a> | Global - English</div>
            </div> -->
        </div>
    </div>
    <header>
        <div class="container">
        <a href="{{URL::Route('Netproclivity')}}"><div class="logo">
            <img src="{{ asset('assets/frontend/img/logo.png')}}"   alt=""/>
            </div></a>
            <nav>
            <?php $menus= App\Models\Menus::get();?>
                <ul>
                    @foreach($menus as $menu)

                        @if($menu->menu_id ==1)<li style="cursor: pointer;" @if(Request::segment(1)== 'about_us')  class="active"  @endif ><a href="{{URL::Route('AboutUs',$menu->menu_id)}}">About Us</a> </li>@endif
                        @if($menu->menu_id ==2)<li @if(Request::segment(1)== 'executive-team')  class="active"  @endif ><a href="{{URL::Route('ExecutiveTeam',$menu->menu_id)}}">Executive Team</a></li>@endif
                        @if($menu->menu_id ==3)<li  @if(Request::segment(1)== 'services')   class="active"  @endif ><a data-toggle="dropdown" href="{{URL::Route('Services',$menu->menu_id)}}"> Our Services</a> 
                        <ul class="dropdown-menu">
                        <li><a href="{{URL::Route('Services',3)}}">All Services</a></li>
                        <li><a href="{{URL::Route('Digitaltransformation',9)}}">Digital Transformation</a></li>
                        <li><a href="{{URL::Route('Experiencetransformation',11)}}">Experience Transformation</a></li>
                        <li><a href="{{URL::Route('Itstaffingtransformation',13)}}">IT Staffing Transformation</a></li>
                        </ul>@endif</li>
                        @if($menu->menu_id ==7)<li @if(Request::segment(1)== 'contact-us')  class="active"  @endif ><a href="{{URL::Route('Contact',$menu->menu_id)}}">Contact Us </a></li>@endif

                    @endforeach
                </ul>
            </nav>

    </header>
<?php
$attachments= App\Models\Attachments::where('menu_id',Request::segment(2))->first();
?>
     @if(!empty($attachments))
     <img src="{{ url('data/banners/'.$attachments->attachment_url) }}"   alt=""/>

     @endif
    

    @yield('header')

</head>

    <section id="content">
        @yield('content')
    </section>
{{--Delete Modal--}}


<footer><div class="container">
        <div class="col-sm-12 footer_sec">
        <?php  $about=\App\Models\Pages::where('menu_id',1)->first();?>
            <div class="col-sm-5">
            <a href="{{URL::Route('AboutUs',1)}}"><img src="{{ asset('assets/frontend/img/logo.png')}}"   alt=""/></a>
                <!-- <h3>About Netproclivity</h3> -->
                <p>{!! str_limit($about->content,175) !!}</p>
                
            </div>
            
            
            <div class="col-sm-3">
                <h3>Netproclivity</h3>
                <?php  $menus=\App\Models\Menus::orderBy('menu_order','asc')-> get();?>
                <ul>
                @foreach($menus as $menu)

@if($menu->menu_id ==1)<li style="cursor: pointer;" @if(Request::segment(1)== 'about_us')  class="active"  @endif ><a href="{{URL::Route('AboutUs',$menu->menu_id)}}">{{$menu->menu_name}} </a></li>@endif
@if($menu->menu_id ==2)<li @if(Request::segment(1)== 'executive-team')  class="active"  @endif ><a href="{{URL::Route('ExecutiveTeam',$menu->menu_id)}}">{{$menu->menu_name}}</a> </li>@endif 
@if($menu->menu_id ==3)<li @if(Request::segment(1)== 'services')  class="active"  @endif ><a href="{{URL::Route('Services',$menu->menu_id)}}">{{$menu->menu_name}}</a> </li>@endif                      

@if($menu->menu_id ==9)<li @if(Request::segment(1)== 'digital-transformation')  class="active"  @endif ><a href="{{URL::Route('Digitaltransformation',$menu->menu_id)}}">{{$menu->menu_name}} </a></li>@endif
@if($menu->menu_id ==11)<li @if(Request::segment(1)== 'experience-transformation')  class="active"  @endif ><a href="{{URL::Route('Experiencetransformation',$menu->menu_id)}}">{{$menu->menu_name}} </a></li>@endif
@if($menu->menu_id ==13)<li @if(Request::segment(1)== 'itstaffing-transformation')  class="active"  @endif ><a href="{{URL::Route('Itstaffingtransformation',$menu->menu_id)}}">{{$menu->menu_name}} </a></li>@endif
@if($menu->menu_id ==7)<li @if(Request::segment(1)== 'contact-us')  class="active"  @endif ><a href="{{URL::Route('Contact',$menu->menu_id)}}">{{$menu->menu_name}} </a></li>@endif
@endforeach
                </ul>
            </div>
            
            <div class="col-sm-3 contactFooter">
                <h3>Contact Me</h3>
                <p>Head Office Address, <br>
                    P.O. Box 58. , P.C.111, <br>
                    California, US Cities</p>
                <p><span class="glyphicon glyphicon-map-marker"></span> California, US Cities<br>

                    <span class="glyphicon glyphicon-earphone"></span> +098 8732 873212<br>

                    <span class="glyphicon glyphicon-envelope"></span> support@netproclivity.com</p>
            </div>
        </div></div>
    
        
</footer>
<script src="{{ asset('assets/frontend/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{ asset('assets/frontend/js/hammer.min.js')}}"></script>
<script src="{{ asset('assets/frontend/js/sequence.min.js')}}'"></script>
<script src="{{ asset('assets/frontend/js/sequence-theme.modern-slide-in.js')}}"></script>
<script src="{{ asset('assets/frontend/js/jquery.validate.min.js')}}"></script>

<script>// When the DOM is ready, run this function
    $(document).ready(function() {
        //Set the carousel options
        $('#quote-carousel').carousel({
            pause: true,
            interval: 4000,
        });
        
    });</script>
@yield('footer')


</body>
</html>
