@extends('layouts.app')

@section('title', 'Authors')

@section('content')
    <div class="d-flex justify-content-end my-2">
        <a href="{{route('book.create')}}" class="btn btn-dark" title="Add book">
            <i class="fa-solid fa-circle-plus"></i> Add Book
        </a>
    </div>
    <div class="card p-5">
          <h3>Authors Page</h3>    
    </div>
@endsection