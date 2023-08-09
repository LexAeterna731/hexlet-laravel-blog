@extends('layouts.app')

@section('content')
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
            <strong>{{ $message }}</strong>
    </div>
    @endif
    <h1>Список статей</h1>
    @foreach ($articles as $article)
        <h2>
            <a href="{{ route('articles.show', ['id' => $article->id]) }}">{{$article->name}}</a>
        </h2>
        <div>{{Str::limit($article->body, 200)}}</div>
    @endforeach
@endsection