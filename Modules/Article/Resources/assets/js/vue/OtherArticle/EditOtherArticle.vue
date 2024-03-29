<template>
  <v-container>
    <v-layout wrap row>
      <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
      <v-flex v-if="!loader">
        <v-card>
          <v-card-title>
            <h1>Редактирование статьи</h1>
            &nbsp;&nbsp;<a v-if="form" :href="'/'+form.url_key+'.html'" target="_blank" style="text-decoration: none">к товару</a>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-layout row wrap>
                <v-flex>
                  <v-form ref="form" lazy-validation v-model="valid">
                    <template v-for="(field, num) in plackFields">
                      <form-builder :field="field" v-if="num!=='content'" :num="num" :relations="relations" :items="form" @update="updateField"></form-builder>
                    </template>
                    <v-flex xs12>
                      <wysiwyg
                        :element-id="id"
                        name="content"
                        url="image-wysiwyg-upload"
                        url-file="upload-file"
                        type-file-upload="file"
                        type-file="image-wysiwyg"
                        model="getModel"
                        v-model="form.content">
                      </wysiwyg>
                    </v-flex>
                    <file-box url="/files/upload" :fileable-id="Number(id)" :type-files="typeFiles" :model="getModel"></file-box>
                    <v-flex text-xs-left>
                      <v-btn large :class="{primary: valid, 'red lighten-3': !valid}" :disabled="isSending" @click.prevent="onSubmit">Сохранить</v-btn>
                    </v-flex>
                  </v-form>
                </v-flex>
              </v-layout>
            </v-container>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import {mapActions, mapState, mapGetters, mapMutations} from 'vuex'
  import {GLOBAL} from '@/constants'
  import formBuilder from '@/vue/FormBuilder'
  import Wysiwyg from '@/vue/Wysiwyg.vue'
  import fileBox from '@file/components/file-box/FileBox'

  export default {
    props: {
      id: {
        type: String,
        required: true
      },
    },
    data: function () {
      return {
        valid: false,
        loader: true,
        isSending: false
      }
    },
    beforeRouteEnter(to, from, next) {
      next(vm => {
        vm.init(to.params.id)
        vm.loader = false
      })
    },
    beforeRouteUpdate(to, from, next) {
      this.init(to.params.id)
      this.loader = false
      next()
    },
    computed: {
      ...mapState('other_articles', ['items', 'fields', 'relations', 'typeFiles']),
      ...mapGetters('other_articles', {getItem: GLOBAL.GET_ITEM, getModel: 'getModel'}),
      plackFields()
      {
        return _.pick(this.fields, ['id', 'title', 'minititle', 'short_title', 'url_key', 'content','article_type', 'active', 'orderform', 'mainpage', 'leftmenu'])
      },
      form() {
        return _.pick(this.getItem(Number(this.id)), ['id', 'title', 'minititle', 'short_title', 'url_key', 'content','article_type_id', 'active', 'orderform', 'mainpage', 'leftmenu'])
      }
    },
    components: {
      formBuilder,
      fileBox
    },
    methods: {
      ...mapActions('other_articles', {
        save: GLOBAL.SAVE_DATA
      }),
      ...mapMutations('initializer', {resetError: 'RESET_ERROR'}),
      updateField(objField) {
        Object.assign(this.form, objField)
      },
      init(id) {
        this.resetError();
        if (this.items.length == 0) {
          this.$router.push({name: 'other-articles'})
        }
      },
      onSubmit() {
        if (this.$refs.form.validate()) {
          this.isSending = true
          this.save(this.form).then(response => {
            this.isSending = false
            this.$router.push({name: 'other-articles'})
          })
        }
      }
    }
  }
</script>