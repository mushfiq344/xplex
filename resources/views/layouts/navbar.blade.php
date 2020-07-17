<!-- Navbar -->
<nav class="navbar-youplay navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav" style="">
                <li class="dropdown dropdown-hover">
                    <a onclick="colorfy(this)" href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Movies <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">
                            <!-- <li><a href="{{ url('/gallery',['movie','bangla','all']) }}">Bangla</a>
                            </li> -->
                            <li><a href="{{ url('/gallery',['movie','english','all']) }}">English</a>
                            </li>
                            <li><a href="{{ url('/gallery',['movie','korean','all']) }}">Korean</a>
                            </li>
                            <li><a href="{{ url('/gallery',['movie','hindi','all']) }}">Hindi</a>
                            </li>
                        </ul>
                        <ul role="menu">
                            <li><a href="{{ url('/gallery',['movie','south indian','all']) }}">South Indian</a>
                            </li>
                            <li><a href="{{ url('/gallery',['movie','animation','all']) }}">Animation</a>
                            </li>
                            <li><a href="{{ url('/gallery',['movie','others','all']) }}">Foreign Movies</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li class="dropdown dropdown-hover ">
                    <a onclick="colorfy(this)" href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        TV-SHOWS <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">
                            <li><a href="{{ url('/galleryForTv',['tv_series','english','all']) }}">Tv Series</a>
                            </li>
                            <li><a href="{{ url('/galleryForTv',['tv_series','animation','all']) }}">Anime Series</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <!-- <li class="dropdown dropdown-hover ">
                    <a onclick="colorfy(this)" href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Games <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">
                            <li><a href="{{ url('/galleryForPcGame',['all']) }}">PC Games</a>
                            </li>
                        </ul>
                    </div>
                </li> -->
                <li>
                    <a href="{{url('/')}}">
                        <img style="margin-top: -15px;" width="140px;" src="{{asset('default_images/site_logo.png')}}">
                    </a>
                </li>
                <!-- <li class="dropdown dropdown-hover ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Others <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">
                            <li><a href="{{ url('ftp/Others/Others/Documentary') }}">Documentery</a>
                            </li>
                            <li><a href="{{ url('ftp/Others/Others/Tutorials') }}">Tutorials</a>
                            <li><a href="{{ url('ftp/Others/Others/Softwares') }}">Softwares</a>
                        </ul>
                    </div>
                </li> -->
                <li>
                    <!-- <a target="_blank"  href="{{url('live_tv')}}"  role="button">
                       Live Tv </span> <span class="label"></span>
                    </a> -->
                </li>

                <li>
                    <!-- <a target="_blank"  href="http://103.102.27.172"  role="button">
                       Live Tv 2</span> <span class="label"></span>
                    </a> -->
                </li>

                <li>
                    <i id="search_icon" class="fa fa-search" data-toggle="modal" data-target="#myModal" style="font-size: 24px;margin-top: 20px"></i>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script type="text/javascript" src="{{asset('../assets/youplay/js/search.js')}}"></script>
@extends('layouts.searchModal')