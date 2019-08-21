<form action="/order" method="post" name="zakaz_tovara">
  <table class="orderform" cellpadding="0" cellspacing="0">
    <tbody valign="top">
    <tr valign="middle">
      <th colspan="2">
        <h1><span>Форма запроса на оборудование</span></h1><br>
      </th>
    </tr>
    <tr valign="middle">
      <td class="aright">
        Как Вас зовут? (Ф.И.О): <span class="red">*</span>&nbsp;
      </td>
      <td>
        <input name="fio" size="60" value="" type="text">
      </td>
    </tr>
    <tr valign="middle">
      <td class="aright">
        Название Вашей компании: <span class="red">*</span>&nbsp;
      </td>
      <td>
        <input name="company" size="60" value="" type="text">
      </td>
    </tr>
    <tr valign="middle">
      <td class="aright">
        Ваш контактный телефон: <span class="red">*</span>&nbsp;
      </td>
      <td>
        <input name="tel" size="60" value="" type="text">
      </td>
    </tr>
    <tr valign="middle">
      <td class="aright">
        Ваш электронный адрес (E-mail):
      </td>
      <td>
        <input name="email" size="60" value="" type="text">
      </td>
    </tr>
    <tr valign="middle">
      <td>
        Запрос:
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <textarea name="description" style="width: 94%; height: 100px;"></textarea>
      </td>
    </tr>
    <tr>
      <td>
        <span class="red">* Поля обязательные для заполнения</span>
      </td>
      <td class="aright">
        <input type='submit' value='Заказать' />
      </td>
    </tr>
    </tbody>
  </table>
</form>