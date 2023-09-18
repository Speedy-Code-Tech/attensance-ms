<!-- resources/views/members/profile.blade.php -->

@extends('layouts.main', ['title' => 'Profile'])

@section('content')
    @include('edit-profile', ['formAction' => route('profile.update', $member), 'cardTitle' => 'Profile'])
@endsection
