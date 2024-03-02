@extends('layouts.app')

@section('title', $user->name . 's Bookmark')
    
@section('content')
    @include('mypage.header')
    <h3>Categories</h3>
@endsection
