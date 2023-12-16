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
        @foreach ($refund as $refunds)
        <h1>{{ $refunds->title }}</h1>
        @endforeach
    </div>
</section>

<section class="inner-page">
    @foreach ($refund as $refundDescription)
    <div class="container d-flex justify-content-center">
        <div class="inner-page-content">
            <h2>{{ $refundDescription->sub_title }}</h2>
            <p>{{ $refundDescription->description }}</p>
        </div>
    </div>
    @endforeach
</section>

@endsection

@section('script-lib')

@endsection

@push('custom-js')

@endpush

