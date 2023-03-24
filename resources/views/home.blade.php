@extends('layouts.app')

@section('title')
    Pagina principal
@endsection

@section('content')
    <x-list-post-card :posts="$posts" />
@endsection
