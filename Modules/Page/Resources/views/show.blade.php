@extends('layouts.master')

@section('title', $page->title)

@section('sidebar')
  <h1><span>Области применения</span></h1>
  <div class="information">
    <ul class="article__tab-action">
      @foreach($interfs as $interf)
        <li>
          <a href="{{$interf->url_key.'.html'}}">
            @if(count($interf->files)>0)
              @foreach($interf->files[0]->config as $key=>$conf)
                @foreach($conf as $key=>$item)
                  @if($key == "extrasmall")
                    <img src="/storage/{{$item['filename']}}" class="fleft"/>
                  @endif
                @endforeach
              @endforeach
            @endif
            {{$interf->short_title?$interf->short_title:$interf->title}}
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

