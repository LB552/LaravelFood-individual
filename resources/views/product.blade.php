@extends('layouts.app')

@section('content')
<p><a href="{{ route('index', ['category_id' => $product->category->id]) }}">{{ $product->category->name }}</a> > {{ $product->name }}</p>
<h1>{{ $product->name }}</h1>
<img src="{{ asset($product->image) }}" width="200">
<p>${{ number_format($product->price, 2) }}</p>
<p>{{ $product->description }}</p>
@endsection