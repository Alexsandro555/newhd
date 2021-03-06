<template>
  <v-container>
    <v-layout wrap row>
      <v-progress-circular v-if="loader" indeterminate :size="100" color="primary"></v-progress-circular>
      <v-flex v-if="!loader">
        <v-card>
          <v-card-title>
            <h1>Редактирование линейки продукции</h1>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-layout row wrap>
                <v-flex>
                  <v-form ref="form" lazy-validation v-model="valid">
                    <template v-for="(field, num) in fields">
                      <form-builder :field="field" v-if="num!=='description'" :num="num" :relations="relations" :items="form" @update="updateField"></form-builder>
                    </template>
                    <wysiwyg
                      :element-id="id"
                      name="description"
                      url="image-wysiwyg-upload"
                      url-file="upload-file"
                      type-file-upload="file"
                      type-file="image-wysiwyg"
                      model="getModel"
                      v-model="form.description">
                    </wysiwyg>
                    <file-box url="/files/upload" :fileable-id="Number(form.id)" :options="dropzoneOptions" :type-files="typeFiles"
                              :model="getModel"></file-box>
                    <v-flex text-xs-left>
                      <v-btn large :class="{primary: valid, 'red lighten-3': !valid}" :disabled="isSending"
                             @click.prevent="onSubmit">Сохранить
                      </v-btn>
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
  import {ACTIONS, GLOBAL} from '@/constants'
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
        isSending: false,
        dropzoneOptions: {
          maxFiles: 10
        }
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
      ...mapState('line_products', ['items', 'fields', 'relations','typeFiles']),
      ...mapGetters('line_products', {getItem: GLOBAL.GET_ITEM, getModel: 'getModel'}),
      form() {
        return _.pick(this.getItem(Number(this.id)), ['id', 'title', 'sort', 'active', 'description', 'type_product_id', 'price_amount'])
      }
    },
    components: {
      formBuilder,
      fileBox
    },
    methods: {
      ...mapActions('line_products', {
        save: GLOBAL.SAVE_DATA
      }),
      ...mapMutations('initializer', {resetError: 'RESET_ERROR'}),
      updateField(objField) {
        Object.assign(this.form, objField)
      },
      init(id) {
        this.resetError();
        if (this.items.length == 0) {
          this.$router.push({name: 'product-lines-list'})
        }
      },
      onSubmit() {
        if (this.$refs.form.validate()) {
          this.isSending = true
          this.save(this.form).then(response => {
            this.isSending = false
            this.$router.push({name: 'product-lines-list'})
          })
        }
      },
    }
  }
</script>