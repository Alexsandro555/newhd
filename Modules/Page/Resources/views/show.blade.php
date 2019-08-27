@extends('layouts.master')

@section('title', $page->title)

@section('sidebar')

@endsection

@section('content')
  <div class="path">
    <a href="/">Главная</a>&nbsp;&nbsp;<img src="{{asset('images/arrow.png')}}"/>&nbsp;&nbsp;{{$page->title}}
  </div>
  <h1><span>{{$page->title}}</span></h1><br>
  <div style="display: inline-block">
    {!! $page->content !!}
    <p>
      проверка<br/>
      другая строка
    </p>
  </div>
@endsection

