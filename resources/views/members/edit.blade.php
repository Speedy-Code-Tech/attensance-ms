{{-- resources/views/members/edit.blade.php --}}

@extends('layouts.main', ['title' => 'Edit Member'])

@section('content')
    @include('edit-profile', ['formAction' => route('members.update', $member), 'cardTitle' => 'Member Details'])
@endsection
