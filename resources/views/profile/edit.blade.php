@extends('layouts.app')

@section('header', 'Perfil')

@section('content')
    @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    @include('profile.partials.delete-user-form')
@endsection
