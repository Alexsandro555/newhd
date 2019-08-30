
<v-card>
  <v-card-title>
    Заголовок карточки
  </v-card-title>
  <v-card-text>
    <callback-form>
      <template slot-scope="{form, messages, getRules}">
        <v-text-field
          name="fio"
          label="Как вас зовут? (Ф.И.О.)"
          v-model="form.fio"
          :counter="60"
          :rules="getRules({required: true, max: 60})"
          :error-messages="messages.fio"
          required>
        </v-text-field>
        <v-text-field
          name="company"
          label="Название Вашей компании"
          v-model="form.company"
          :counter="60"
          :rules="getRules({max: 60})"
          :error-messages="messages.company">
        </v-text-field>
        <v-text-field
          name="tel"
          label="Ваш контактный телефон"
          v-model="form.tel"
          :counter="60"
          :rules="getRules({max: 60})"
          :error-messages="messages.tel">
        </v-text-field>
        <v-text-field
          name="email"
          label="Ваш электронный адрес (E-mail)"
          v-model="form.email"
          :counter="60"
          :rules="getRules({email: true})"
          :error-messages="messages.email">
        </v-text-field>
      </template>
    </callback-form>



  </v-card-text>
</v-card>

