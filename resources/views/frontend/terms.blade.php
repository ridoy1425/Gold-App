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
            <h1>{{ $refund[0]->title ?? '' }}</h1>
        </div>
    </section>

    <section class="inner-page">
        <div class="container d-flex justify-content-center">
            <div class="inner-page-content">
                @foreach ($refund as $refundDescription)
                    <h2>{{ $refundDescription->sub_title ?? '' }}</h2>
                    <p>{{ $refundDescription->description ?? '' }}</p>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('script-lib')
@endsection

@push('custom-js')
@endpush
