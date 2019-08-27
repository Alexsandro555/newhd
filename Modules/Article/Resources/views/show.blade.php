@extends('layouts.master')

@section('title', $article->title)

@section('sidebar')
  <div class="information">
    <ul class="article__tab-action">
      <li>
        <a @click="selectTab('main')" :class="[selectedAction=='main'?'article__tab-active':'']" href="#">Описание</a>
      </li>
      <li>
        <a @click="selectTab('characteristics')" :class="[selectedAction=='characteristics'?'article__tab-active':'']" href="#">Технические характеристики</a>
      </li>
      <li>
        <a @click="selectTab('video')" :class="[selectedAction=='video'?'article__tab-active':'']" href="#">Видео</a>
      </li>
      <li>
        <a @click="selectTab('photo')" :class="[selectedAction=='photo'?'article__tab-active':'']" href="#">Фото</a>
      </li>
      <li>
        <a @click="selectTab('download')" :class="[selectedAction=='download'?'article__tab-active':'']" href="#">Документация</a>
      </li>
    </ul>
  </div>

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
    <a href="/">Главная</a>&nbsp;&nbsp;<img src="{{asset('images/arrow.png')}}"/>&nbsp;&nbsp;Статья
  </div>
  <h1>
        <span>
            {{$article->title}}
        </span>
  </h1><br>
  <div class="hydronix-content">
    {!! $article->content !!}
  </div>
  <br>
  @if($article->orderform)
    @include('article::orderform')
  @endif
@stop
