@extends('layouts.www')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/ckeditor-styles.css') }}">
@endsection

@section('content')

    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{Storage::url('iconos/porta1.jpeg')}}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown">Bienvenidos a la ESCUELA HUERTO GETSEMANI</h1>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Ver Grados</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{Storage::url('iconos/porta2.jpeg')}}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Animate a probar!</h5>
                                <h1 class="display-3 text-white animated slideInDown">Inicia los grados ya!</h1>
                                <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-4">
        <div class="text-center mb-4">
            <h4 class="section-title bg-white text-center text-primary px-3">Últimas Noticias</h4>
        </div>

        <div class="row mb-2" style="@media (min-width: 720px) {height: 500px}">
            <div class="col-md-9 mb-2">
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="3" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="4" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        @foreach ($data as $item)
                            @php
                                $active = '';
                                if ($loop->first){
                                    $active = 'active';
                                }
                            @endphp
                            <div class="carousel-item  {{$active}}" data-bs-interval="10000">
                                <img src="{{Storage::url($item->files_fotos[0]->file)}}" class="d-block w-100"  style="max-height: 720px; opacity: 1" alt="..." >
                                <div class="carousel-caption d-none d-md-block">
                                    <h5 class="py-2" >
                                        <a href="{{route('new_detalle', $item->slug)}}" class="a-titulo">{{Str::title($item->titulo)}}</a>
                                    </h5>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-md-3 ">
                <div class="card" style="width: 100%">
                    <div class="card-header text-white fw-bold" style="background: rgb(236, 57, 162)">
                      Links de Interés
                    </div>
                    <ul class="list-group list-group-flush rounded" style="background: rgb(236, 57, 162)">
                        <li class="list-group-item w-bold">
                            <a href="#" class="w-bold" style="color: #3b5998"><i class="fab fa-facebook-f ml-2"></i> Facebook</a>
                        </li>
                        <li class="list-group-item">
                            <a class="w-bold" href="#" style="color: rgb(248, 111, 47)"><i class="fab fa-instagram"></i> Instagram</a>
                        </li>
                        <li class="list-group-item">
                            <a href="#"><i class="fas fa-book-reader"></i> Grados</a>
                        </li>

                        <li class="list-group-item">
                            <a href="{{route('new')}}"  style="color: rgb(170, 170, 26)"><i class="fas fa-newspaper"></i> Noticias</a>
                        </li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{Storage::url('iconos/imagen21.jpg')}}" alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Sobre Nosotros</h6>
                    <p class="mb-4">******************</p>
                    <p class="mb-4">
                        ********************************************************************************
                    </p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Excelentes Profesores</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Grados</p>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="">Ver Grados</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


@endsection
