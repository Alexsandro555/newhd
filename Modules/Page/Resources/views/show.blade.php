@extends('layouts.master')

@section('title', $page->title)

@section('sidebar')
  <h1><span>Области применения</span></h1>
  <div class="information">
    <ul class="article__tab-action">
      @foreach($otherArticles as $otherArticle)
        <li>
          <a href="{{$otherArticle->url_key.'.html'}}">
            @if(count($otherArticle->files)>0)
              @foreach($otherArticle->files[0]->config as $key=>$conf)
                @foreach($conf as $key=>$item)
                  @if($key == "extrasmall")
                    <img src="/storage/{{$item['filename']}}" class="fleft"/>
                  @endif
                @endforeach
              @endforeach
            @endif
            {{$otherArticle->short_title?$otherArticle->short_title:$otherArticle->title}}
          </a>
        </li>
      @endforeach
    </ul>
  </div>
@endsection

@section('content')
  <div class="path">
    <a href="/">Главная</a>&nbsp;&nbsp;<img src="{{asset('images/arrow.png')}}"/>&nbsp;&nbsp;{{$page->title}}
  </div>
  <h1><span>{{$page->title}}</span></h1><br>
  <div class="hydronix-content">
    {!! $page->content !!}
  </div>
@endsection

