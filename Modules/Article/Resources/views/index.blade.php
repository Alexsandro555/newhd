@extends('layouts.master')

@section('title', 'статьи')

@section('menu')
    <div class="menu-wrapper wrapper">
        <div class="abs-position">
            <left-menu></left-menu>
        </div>
    </div>
@endsection

@section('content')
    <div class="articles">
        <div class="wrapper top20">
            <v-layout row wrap>
                <v-flex xs12 class="text-xs-center margin-top-100">
                    @foreach($articles as $article)
                        <div class="article--card__wrapper">
                            <v-card class="article--card">
                                <v-container>
                                    <v-layout row wrap>
                                        <v-flex xs8 text-xs-left>
                                            <div class="articles__content">
                                                <a href="/article/{{$article->url_key}}"><h2>{{$article->title}}</h2></a><br>
                                                <p>
                                                    {{str_limit(strip_tags($article->content), $limit = 402, $end="...")}}
                                                </p>
                                            </div>
                                            <a class="article--button" href="/article/{{$article->url_key}}">Подробнее</a>
                                        </v-flex>
                                        <v-flex>
                                            @if($article->files->count()>0)
                                                @foreach($article->files as $fileRecord)
                                                    @foreach($fileRecord->config as $files)
                                                        @foreach($files as $key => $file)
                                                            @if($key == 'medium')
                                                                <img src="/storage/{{$file['filename']}}"/>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    @break
                                                @endforeach
                                            @else
                                                <img src="{{asset('images/no-image-medium.png')}}"/>
                                            @endif
                                        </v-flex>
                                    </v-layout>
                                </v-container>
                            </v-card>
                        </div>
                        <br>
                    @endforeach
                </v-flex>
            </v-layout>
        </div>
    </div>
@endsection

