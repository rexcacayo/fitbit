@extends('layouts.app')

@section('content')
<style>
    .content-wrapper{
        background-color: black !important;
        background-image: none !important;
    }
</style>
<div>
    <div class="videoBack">
        <video src="{{asset('/video/Video entorno FITBIT.mp4')}}" autobuffer autoloop loop autoplay preload muted></video>
    </div>
</div>
@endsection
