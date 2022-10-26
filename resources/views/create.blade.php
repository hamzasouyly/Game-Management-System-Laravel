
@extends('layouts.app')

@section('style')
    <style>
        /* body{
            background: red;
        } */
    </style>
@endsection

@section('title', 'Add')

@section('content')

<h1>Create role</h1>
 
    
    <!-- Default form subscription -->
<form class="text-center border border-light p-5" action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">

    @csrf


    <!-- Title -->
    <input type="text" id="defaultSubscriptionFormPassword" class="form-control mb-4" placeholder="Title" name="title">

        <!-- Title -->
        <input type="text" id="defaultSubscriptionFormPassword" class="form-control mb-4" placeholder="image" name="image">


    <!-- Discription -->
    <div class="form-group">
    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Discription" name="discription"></textarea>
    </div>

    <select class="form-control" id="exampleFormControlSelect1" name="classes_id" multiple>
    @foreach ($classes as $class)
            
            <option value="{{ $class->id }}">{{ $class->title }}</option>
            
    @endforeach
    </select>

    {{-- @foreach ($classes as $class)
            <option value="{{ $class->id }}" {{ $class->id === old('class_id') ? 'selected' : '' }}>{{ $class->name }}</option>
            @if ($class->children)
                @foreach ($class->roles as $role)
                    <option value="{{ $role->id }}" {{ $role->id === old('class_id') ? 'selected' : '' }}>&nbsp;&nbsp;{{ $role->name }}</option>
                @endforeach
            @endif
    @endforeach --}}
    

    <!-- Sign in button -->
    <button class="btn btn-info btn-block mt-4" type="submit">Valider</button>


</form>
<!-- Default form subscription -->
      
@endsection