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
      @foreach($relatedArticles as $relatedArticle)
        <li>
          <a href="{{$relatedArticle->url_key.'.html'}}">
            @if(count($relatedArticle->files)>0)
              @foreach($relatedArticle->files[0]->config as $key=>$conf)
                @foreach($conf as $key=>$item)
                  @if($key == "extrasmall")
                    <img src="/storage/{{$item['filename']}}" class="fleft"/>
                  @endif
                @endforeach
              @endforeach
            @endif
            {{$relatedArticle->short_title}}
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
