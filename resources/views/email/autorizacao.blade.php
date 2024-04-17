@extends('layouts.email')

@if(isset($title) && $title != '')
@section('title', $title)
@endif

@section('content')
{!! $content !!}
@endsection

@if(isset($link) && $link != '')
@section('button', 'Confirmar')
@section('link', $link)
@endif

@section('footer')
{!! $footer !!}
@endsection
