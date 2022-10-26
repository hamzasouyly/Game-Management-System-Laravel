
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

<h1>Create Class</h1>
 
    
    <!-- Default form subscription -->
<form class="text-center border border-light p-5" action="{{ route('home.store') }}" method="post" enctype="multipart/form-data">

    @csrf


    <!-- Title -->
    <input type="text" id="defaultSubscriptionFormPassword" class="form-control mb-4" placeholder="Title" name="title">


    <!-- Discription -->
    <div class="form-group">
    <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Discription" name="discription"></textarea>
    </div>

    {{-- background --}}
    <input type="file" id="defaultSubscriptionFormPassword2" class="form-control mb-4" placeholder="Image" name="image">
    

    {{-- images_males --}}
    <input type="file" id="defaultSubscriptionFormPassword2" class="form-control mb-4" placeholder="Image" name="imagesMale[]" multiple>

    <select class="form-control" id="exampleFormControlSelect1" name="nft_id" multiple>
    @foreach ($nfts as $nft)
            
            <option value="{{ $nft->id }}">{{ $nft->title }}</option>
            
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