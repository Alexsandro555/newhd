<template>
  <v-container>
    <v-layout align-center justify-center full-height wrap row>
      <v-flex>
        <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
        <v-card v-else>
          <v-card-title>
            <h1>Привязка статей</h1>
          </v-card-title>
          <v-card-text>
            <v-form ref="form" lazy-validation v-model="valid">
              <v-autocomplete
                name="article_ids"
                :items="articles"
                color="white"
                hide-no-data
                item-text="title"
                item-value="id"
                :menu-props="{maxHeight: '400'}"
                label="Статьи"
                multiple
                persistent-hint
                chips
                no-data-text="Нет данных"
                v-model="form.article_ids"
                placeholder="Введите название статьи для поиска">
                <template slot="selection" slot-scope="data">
                  <v-chip
                    close
                    @input="data.parent.selectItem(data.item)"
                    :selected="data.selected"
                    class="chip--select-multi"
                    :key="JSON.stringify(data.item)">
                    {{ data.item.title }}
                  </v-chip>
                </template>
              </v-autocomplete>
              <v-autocomplete
                name="other_article_ids"
                :items="otherArticles"
                color="white"
                hide-no-data
                item-text="title"
                item-value="id"
                :menu-props="{maxHeight: '400'}"
                label="Области применения"
                multiple
                persistent-hint
                chips
                no-data-text="Нет данных"
                v-model="form.other_article_ids"
                placeholder="Введите название области применения для поиска">
                <template slot="selection" slot-scope="data">
                  <v-chip
                    close
                    @input="data.parent.selectItem(data.item)"
                    :selected="data.selected"
                    class="chip--select-multi"
                    :key="JSON.stringify(data.item)">
                    {{ data.item.title }}
                  </v-chip>
                </template>
              </v-autocomplete>
              <v-btn large color="primary" :disabled="isSending" @click.prevent="onSave">Сохранить</v-btn>
            </v-form>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import {mapActions, mapState} from 'vuex'
  import { GLOBAL } from '@/constants'
  import axios from 'axios'

  export default {
    props: {},
    data() {
      return {
        form: {
          article_ids: [],
          other_article_ids: []
        },
        loader: true,
        valid: false,
        isSending: false
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        let articles = vm.loadArticles()
        let otherArticles = vm.loadOtherArticle()
        let articleOtherArticles = vm.loadArticleOtherArticle()
        Promise.all([articles, otherArticles, articleOtherArticles]).then(result => {
          vm.loader = false
          vm.articleOtherArticle.map(item => item.article_id).forEach(item => vm.form.article_ids.find(element => element == item)?'':vm.form.article_ids.push(item))
          vm.articleOtherArticle.map(item => item.other_article_id).forEach(item => vm.form.other_article_ids.find(element => element == item)?'':vm.form.other_article_ids.push(item))
        })
      })
    },
    computed: {
      ...mapState('articles', {articles: 'items'}),
      ...mapState('other_articles', {otherArticles: 'items'}),
      ...mapState('article_other_article', {articleOtherArticle: 'items'}),
    },
    methods: {
      ...mapActions('articles', {loadArticles: GLOBAL.LOAD_ALL}),
      ...mapActions('other_articles', {loadOtherArticle: GLOBAL.LOAD_ALL}),
      ...mapActions('article_other_article', {loadArticleOtherArticle: GLOBAL.LOAD_ALL}),
      onSave() {
        this.isSending = true
        axios.post('/api/articles/binding', this.form)
          .then(response => response.data)
          .then(response => {
            this.isSending = false
            response.forEach(item => {
              this.$store.commit('UPDATE_ARRAY_BY_KEY', {module: 'article_other_article', variable: 'items',key: 'id', value: item}, { root: true })
            })
        }).catch(error => {
          this.isSending = false
          console.error(error)
        })
      },
      changeBindingArticles() {}
    }
  }
</script>