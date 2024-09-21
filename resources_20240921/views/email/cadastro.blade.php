@extends('layouts.email')

@if(isset($header) && $header != '')
@section('header', $header)
@endif

@section('textoEmail')
{!! $textoEmail !!}
@endsection
