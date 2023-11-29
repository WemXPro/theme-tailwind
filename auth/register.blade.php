@extends(Theme::path('auth.wrapper'))

@section('title', __('auth.sign_up'))

@section('container')
    @if (!isset($_GET['step']) or $_GET['step'] == 'account')
        @include(Theme::path('auth.registration.account'))
    @elseif($_GET['step'] == 'verification')
        @include(Theme::path('auth.registration.verify_email'))
    @elseif($_GET['step'] == 'account_pending')
        @include(Theme::path('auth.registration.account_pending'))
    @else
        @include(Theme::path('auth.registration.personalize'))
    @endif
@endsection
