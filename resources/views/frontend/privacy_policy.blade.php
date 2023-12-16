@extends('frontend.frontend_master')

@section('style-lib')
@endsection

@push('custom-css')
    <style type="text/css">

    </style>
@endpush

@section('main-content')
    <section class="inner-page-banner">
        <div class="container text-center">
            @foreach ($privacy as $privacytitle)
                <h1>{{ $privacytitle->title ?? '' }}</h1>
            @endforeach
        </div>
    </section>


    <section class="inner-page">
        @foreach ($privacy as $privacys)
            <div class="container d-flex justify-content-center">
                <div class="inner-page-content">
                    <h2>{{ $privacys->sub_title ?? '' }}</h2>
                    <p>{{ $privacys->description ?? '' }}</p>
                </div>
            </div>
        @endforeach
    </section>
@endsection

@section('script-lib')
@endsection

@push('custom-js')
@endpush
