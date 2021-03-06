<template>
  <v-container>
    <v-layout wrap row>
      <v-flex xs12 class="text-xs-center">
        <v-card>
          <v-card-title>
            <h1>Области применения</h1>
            <v-spacer></v-spacer>
            <v-text-field v-model="search" append-icon="search" label="Поиск" single-line hide-details></v-text-field>
          </v-card-title>
          <v-card-text>
            <v-data-table :headers="headers"
                          :items="items"
                          :loading="loading"
                          :search="search"
                          :rows-per-page-items="[50, 100 , { 'text': '$vuetify.dataIterator.rowsPerPageAll', 'value': -1 } ]"
                          rows-per-page-text="Строк на странице:"
                          class="elevation-1">
              <template slot="items" slot-scope="props">
                <td>{{ props.item.id }}</td>
                <td class="text-xs-left">{{ props.item.title }}</td>
                <td class="text-xs-left">
                  <v-icon v-if="props.item.active" color="teal darken-3">done</v-icon>
                  <v-icon v-else color="pink">close</v-icon>
                </td>
                <td class="text-xs-left">{{ props.item.updated_at }}</td>
                <td class="justify-center layout px-0">
                  <v-btn @click="goToPage(props.item.url_key)" icon class="mx-0">
                    <v-icon>find_in_page</v-icon>
                  </v-btn>
                  <v-btn icon class="mx-0" @click="$router.push({name: 'edit-other-article', params: {id: props.item.id.toString()}})">
                    <v-icon color="teal">edit</v-icon>
                  </v-btn>
                  <v-btn :disabled="props.item.url_key === 'po-umolchaniyu'" icon class="mx-0" @click="deleteItem(props.item)">
                    <v-icon color="pink">delete</v-icon>
                  </v-btn>
                </td>
              </template>
              <template v-if="loading" slot="no-data">
                <br>
                <v-progress-circular indeterminate :size="100" color="primary"></v-progress-circular>
                <br>
                <br>
              </template>
              <template v-if="!loading" slot="no-data">
                <v-alert :value="true" color="error" icon="warning">
                  Извините, нет данных для отображения :(
                </v-alert>
              </template>
              <v-alert slot="no-results" :value="true" color="error" icon="warning">
                По ключевой фразе "{{ search }}" ничего не найдено.
              </v-alert>
            </v-data-table>
          </v-card-text>
          <v-card-actions>
            <v-btn @click="addArticle" color="primary" class="text-left mb-2">
              <v-icon>add</v-icon>
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import { ACTIONS } from "@product/constants"
  import {GLOBAL} from "@/constants";
  import {mapActions, mapState} from 'vuex'

  export default {
    props: {},
    data: function () {
      return {
        headers: [
          {
            text: '#',
            align: 'left',
            sortable: true,
            value: 'id'
          },
          {
            text: 'Наименование',
            value: 'title',
            sortable: true
          },
          {
            text: 'Активный',
            value: 'active',
            sortable: true
          },
          {
            text: 'Обновлено',
            value: 'updated_at',
            sortable: true
          },
          {
            text: 'Действия',
            value: 'title',
            sortable: false
          }
        ],
        search: ''
      }
    },
    computed: {
      ...mapState('other_articles', ['items', 'loading']),
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.initialization()
        vm.loadRelations().then(response => {
          vm.load().then(response => {
            vm.$store.commit('SET_VARIABLE',{module: 'other_articles', variable: 'loading', value: false}, {root: true})
          })
        })
      })
    },
    methods: {
      ...mapActions('other_articles', { add: GLOBAL.ADD, delete: GLOBAL.DELETE, load: GLOBAL.LOAD, loadAll: GLOBAL.LOAD_ALL, initialization: GLOBAL.INITIALIZATION, loadRelations: GLOBAL.LOAD_RELATIONS }),
      addArticle() {
        this.add({'title': 'По-умолчанию'}).then(response => {
          this.$router.push({name: 'edit-other-article', params: {id: response.id.toString()}})
        })
      },
      deleteItem(item) {
        if (confirm('Вы уверены что хотите удалить запись?')) {
          this.delete(item.id)
        }
      },
      goToPage(url_key) {
        window.open('/'+url_key+'.html', '_blank')
      }
    }
  }
</script>