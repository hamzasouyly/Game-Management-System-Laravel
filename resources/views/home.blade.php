
@extends('layouts.app')

@section('style')
    <style>
        /* body{
            background: red;
        } */
    </style>
@endsection

@section('title', 'Home')

@section('content')

@foreach ($classes as $class)
    <h3>{{ $class->title }}</h3>
    <p>{{ $class->discription }}</p>
    <img src="uploads/backgrounds/{{ $class->image }}" alt="" width="300px">
    {{-- <img src="uploads/imagesMale/{{ $class->image }}" alt=""> --}}

    {{-- @if ($class->images_males)
@foreach ($class->images_males as $image_male)
    <h1>{{ $image_male->id }}</h1>
@endforeach
@endif --}}


        @if ($class->images_male)
        @foreach ($class->images_male as $image_male)
            <h1>{{ $image_male->id }}</h1>
            <p>{{ $image_male->imageM }}</p>
        @endforeach
        @endif
    
    @if ($class->roles)
        @foreach ($class->roles as $role)
            <h1>{{ $role->title }}</h1>
            <p>{{ $role->discription }}</p>
        @endforeach
    @endif

@endforeach






      {{-- categorys --}}

      
      
@endsection

@section('script')
    <script>

    </script>
@endsection