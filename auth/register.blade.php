@extends('auth::wrapper')

@section('title', __('auth.sign_up'))

@section('container')
    @if (!isset($_GET['step']) or $_GET['step'] == 'account')
        @include('auth::registration.account')
    @elseif($_GET['step'] == 'verification')
        @include('auth::registration.verify_email')
    @elseif($_GET['step'] == 'account_pending')
        @include('auth::registration.account_pending')
    @else
        @include('auth::registration.personalize')
    @endif
@endsection
