@extends('layout')

@php
$data="world";
$sub =['a','b','c','d'];
@endphp

{{"hello"}}
{{ $data }}


{!! "<h1>wow</h1>" !!}

<!-- {!! "<script>alert('welcome') </script>" !!} -->

@forelse($sub as $s)
{{ $s }}
@empty
{{ "empty" }}
@endforelse


@section('content')

{{ 'test page'}}
<h3>test</h3>
@endsection

<form method="post">
    @csrf
    title
    <input id="title" type="text" name="title" value="{{ old('title') }}">

  

    <br>

    <input type="text" name="srs"  value="{{ old('srs') }}">
`    @error('srs')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br>

    publish_at
    <input type="text" name="publish_at">
    @error('publish_at')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <br>
    <button type="submit">submit</button>

    <!-- -----------It will display all errors------------- -->
    <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif -->

</form>