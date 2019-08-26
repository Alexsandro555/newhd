@extends('layouts.master')

@section('title', "HYDRONIX.RU. Микроволновые датчики влажности (влагомеры) для бетона, сыпучих материалов, комбикормов, угольной пыли. Датчик/измеритель контроля влажности")

@section('slider')
  <leader-carousel></leader-carousel>
@endsection

@section('sidebar')
  <h1><span>Информация</span></h1>
  <br />
  <div class="information">
    <img src='{{asset('images/clip.png')}}' style="position:absolute;top:-6px;right:4px" />
    <ul>
      <li>
        <a href="/datchik_v_betonosmesitele.html" >Использование микроволновых датчиков</a>
      </li>
      <li>
        <a href="/izmerenie_v_smesitelyah.html" >Измерение влажности в интенсивных смесителях</a>
      </li>
      <li>
        <a href="/seminar2014.html" >Обучающий семинар</a>
      </li>
      <li>
        <a href="/microwave.html" class="last" >Применение микроволновых влагомеров</a>
      </li>
    </ul>
    <a href="#"  class="articles"> Все статьи</a>
  </div>
  <br />
  <h1><span>Ответы на Ваши вопросы:</span></h1>
  <br />
  <div class="information">
    <div class='question'>
      <span>Вопрос:</span> Как производится процесс встраивания в автоматику?
    </div>
    <div class='answer'><span>Ответ:</span> Встраивание в автоматику полностью ложится на плечи заказчика. Мы не производим монтажных или проектных работ. Датчик имеет цифровой и аналоговый выходы, которые могут быть заведены в Вашу автоматику напрямую (например через ЦАП/АЦП) или переданы на индикатор для ручного контроля замеса оператором.
    </div>
    <table cellpadding="0" cellspacing="0" with="100%" align="center">
      <tbody valign="middle">
      <tr>
        <td>
          <a href="/faq.php"  class="articles"> Все вопросы</a>
        </td>
        <td width=160>
          <span class="ask"><a href='#'>Спросить</a></span>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
@endsection

@section('content')
  @foreach($articleTypes as $articleType)
    <div class="cont">
      <h1><span>{{$articleType->title}}</span></h1>
      <div class="new-sting"></div>
      <div class="articles-category">
        @foreach($articleType->articles as $article)
          <div class="articles-category__item">
            <div class="articles-category__image">
              @foreach($article->files as $file)
                @foreach($file->config as $key=>$conf)
                  @foreach($conf as $key=>$item)
                    @if($key === "main")
                      <img src="/storage/{{$item['filename']}}"/>
                    @endif
                  @endforeach
                @endforeach
                @break
              @endforeach
            </div>
            <div class="articles-category__link">
              <a href='{{$article->url_key}}.html'><strong>{{$article->minititle}}</strong><div class="new-string"></div>{{$article->short_title?$article->short_title:$article->title}}</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @endforeach
  <br />
  <h1><span>О Компании</span></h1><br />
  <p style='text-align:justify'>Компания Hydronix LTD (Великобритания) специализируется на исследовании, разработки и производстве систем микроволнового измерения влажности. Мы разработали механизм, который стал основным в измерении влажности в бетонной индустрии. Наши датчики уже установлены в около 50000 системах по всему миру. Начиная с 1982 года Hydronix продолжает оставаться мировым лидером в этом секторе рынка.</p>
@endsection