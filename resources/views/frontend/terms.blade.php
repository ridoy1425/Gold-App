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
        @foreach ($term as $termtitle)
        <h1>{{ $termtitle->title }}</h1>
        @endforeach
    </div>
</section>

<section class="inner-page">
    @foreach ($term as $termDescription)
    <div class="container d-flex justify-content-center">
        <div class="inner-page-content">
            <h2>{{ $termDescription->sub_title }}</h2>
            <p>{{ $termDescription->description }}</p>
        </div>
    </div>
    @endforeach
</section>

@endsection

@section('script-lib')

@endsection

@push('custom-js')

@endpush

