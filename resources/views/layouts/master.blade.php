<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>HYDRONIX. @yield('title')</title>

  <!-- Fonts -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="body_border"></div>
  <center>
  <div class="main" id="app">
    <div class="header">
      <table cellpadding="0" cellspacing="0" with=100%>
        <tbody valign="middle">
        <tr>
          <td width=205>
            <img src='{{asset('images/hydronix_master_reseller.png')}}' />
          </td>
          <td width=300>
            <center>
              <span style='font-size:20pt'> +7 (495) 780-47-96</span>
            </center>
          </td>
          <td>
            Ответим на все ваши вопросы!<br />
            <a href='mailto:info@hydronix.ru'>info@hydronix.ru</a>
          </td>
          <td>
          </td>
        </tr>
        </tbody>
      </table>
      <table cellpadding="0" cellspacing="0" with=100%>
        <tbody valign="middle">
        <tr>
          <td width=26>
            <img src='{{asset('images/header_left.png')}}' />
          </td>
          <td style='background:url("images/header_but.png") repeat top left;width:100%;height:50px;margin:0px;padding:0px'>
            <a href='/' class='menu_title'>Главная</a>
            <a href='#' class='menu_title'>Новости</a>
            <a href='/faq.php' class='menu_title'>Вопрос-ответ</a>
            <a href='#' class='menu_title'>Статьи</a>
            <a href='#' class='menu_title'>География</a>
            <a href='/contacts.html' class='menu_title_none'>Контакты</a>
          </td>
          <td width=30><img src='{{asset('images/header_right.png')}}' /></td>
        </tr>
        </tbody>
      </table>

      @yield('slider')

      <br>
      <table cellpadding="0" cellspacing="0" with=100%>
        <tbody valign="top">
        <tr>
          <td width=318>
            @yield('sidebar')
          </td>
          <td>
            @yield('content')
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <callback></callback>
  </div>
</center>
<script src="{{asset('js/main.js')}}" type="application/javascript"></script>
@yield('view.scripts')
</body>
</html>
