<template>
  <v-container>
    <v-layout wrap row>
      <v-flex v-if="form">
        <v-toolbar tabs>
          <v-tabs slot="extension" left v-model="tabs" slider-color="white" color="transparent">
            <v-tab href="#main" class="subheading">Основные параметры</v-tab>
            <v-tab href="#attributes" class="subheading">Тех. характеристики</v-tab>
            <v-tab v-if="form.sku" href="#sku" class="subheading">Торговые предложения</v-tab>
          </v-tabs>
        </v-toolbar>
        <v-tabs-items v-model="tabs">
          <v-tab-item key="main" :value="'main'">
            <v-card>
              <v-card-title>
                <h1>Редактирование продукта</h1>
                &nbsp;&nbsp;&nbsp;<a v-if="form" :href="'/catalog/detail/'+form.url_key" target="_blank" style="text-decoration: none">к товару</a>
              </v-card-title>
              <v-card-text>
                <v-container>
                  <v-layout row wrap>
                    <v-flex>
                      <v-form ref="form" v-if="form" lazy-validation v-model="valid">
                        <v-text-field
                          name="title"
                          label="Наименование продукта"
                          v-model="form.title"
                          :counter="255"
                          :rules="getRules({required: true, max: 255})"
                          :error-messages="messages.title"
                          required></v-text-field>
                        <v-text-field
                          name="price"
                          label="Цена"
                          v-model="form.price"
                          :counter="13"
                          :rules="getRules({max: 13})"
                          prefix="₽"
                          :error-messages="messages.price"></v-text-field>
                        <v-text-field
                          name="qty"
                          label="Колличество"
                          v-model="form.qty"
                          :error-messages="messages.qty"></v-text-field>
                        <v-checkbox
                          label="Актив."
                          v-model="form.active"
                          :error-messages="messages.active"></v-checkbox>
                        <v-checkbox
                          label="Товар с торговыми предложениями"
                          v-model="form.sku"
                          :error-messages="messages.active"></v-checkbox>
                        <v-text-field
                          name="sort"
                          label="Сорт."
                          v-model="form.sort"
                          :error-messages="messages.sort"></v-text-field>
                        <v-checkbox
                          label="Скидка."
                          v-model="form.onsale"
                          :error-messages="messages.onsale"></v-checkbox>
                        <v-checkbox
                          label="Сперцпредложение"
                          v-model="form.special"
                          :error-messages="messages.special"></v-checkbox>
                        <v-checkbox
                          label="Необходимо заказывать"
                          v-model="form.need_order"
                          :error-messages="messages.need_order"></v-checkbox>
                        <v-text-field
                          name="vendor"
                          label="Артикул"
                          v-model="form.vendor"
                          :counter="50"
                          :rules="getRules({max: 50})"
                          :error-messages="messages.vendor"></v-text-field>
                        <v-text-field
                          name="IEC"
                          label="IEC"
                          v-model="form.IEC"
                          :counter="50"
                          :rules="getRules({max: 50})"
                          :error-messages="messages.IEC"></v-text-field>
                        <!--<v-select
                          name="product_category_id"
                          :items="productCategories"
                          label="Категория продукта"
                          item-text="title"
                          @change="changeProductCategories"
                          no-data-text="Нет данных"
                          item-value="id"
                          :rules="getRules({required: true})"
                          required
                          :error-messages="messages.product_category_id"
                          v-model="form.product_category_id"></v-select>-->
                        <v-autocomplete
                          v-model="form.product_category_id"
                          :items="productCategories"
                          :search-input.sync="searchProductCategory"
                          color="white"
                          hide-no-data
                          item-text="title"
                          item-value="id"
                          label="Категория продукта"
                          placeholder="Введите название категории продукта для поиска">
                          <template slot="selection" slot-scope="data">
                            {{ data.item.title }}
                          </template>
                        </v-autocomplete>
                        <v-autocomplete
                          v-model="form.type_product_id"
                          :items="getTypeProducts"
                          :search-input.sync="searchTypeProduct"
                          color="white"
                          hide-no-data
                          item-text="title"
                          item-value="id"
                          label="Типы продукта"
                          placeholder="Введите название типа продукта для поиска">
                          <template slot="selection" slot-scope="data">
                            {{ data.item.title }}
                          </template>
                        </v-autocomplete>
                        <v-autocomplete
                          v-model="form.line_product_id"
                          :items="getLineProducts"
                          :search-input.sync="searchLineProduct"
                          color="white"
                          hide-no-data
                          item-text="title"
                          item-value="id"
                          label="Линейки продукции"
                          placeholder="Введите название линейки продукции для поиска">
                          <template slot="selection" slot-scope="data">
                            {{ data.item.title }}
                          </template>
                        </v-autocomplete>
                        <!--<v-select
                          name="type_product_id"
                          :items="getTypeProducts"
                          label="Типы продукта"
                          item-text="title"
                          no-data-text="Нет данных"
                          @change="changeTypeProducts"
                          item-value="id"
                          v-model="form.type_product_id"></v-select>-->
                        <!--<v-select
                          name="line_product_id"
                          :items="getLineProducts"
                          label="Линейки продукции"
                          item-text="title"
                          no-data-text="Нет данных"
                          item-value="id"
                          v-model="form.line_product_id"></v-select>-->
                        <wysiwyg
                          :element-id="id"
                          name="description"
                          url="image-wysiwyg-upload"
                          url-file="upload-file"
                          type-file-upload="file"
                          no-data-text="Нет данных"
                          type-file="image-wysiwyg"
                          :model="getModel"
                          v-model="form.description">
                        </wysiwyg>
                        <v-spacer></v-spacer>
                        <file-box url="/files/upload" :fileable-id="Number(form.id)" :type-files="typeFiles" :model="getModel"></file-box>
                        <v-flex text-xs-left>
                          <v-btn text-xs-left large :class="{primary: valid, 'red lighten-3': !valid}"
                                 :disabled="isSending" @click.prevent="onSubmit">Сохранить продукт
                          </v-btn>
                        </v-flex>
                      </v-form>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>
            </v-card>
          </v-tab-item>
          <v-tab-item key="attributes" v-if="form" :value="'attributes'">
            <product-attributes :attributes="getAttributes" :id="Number(id)"></product-attributes>
          </v-tab-item>
          <v-tab-item key="sku" :value="'sku'">
            <v-flex v-if="form" xs12>
              <v-card>
                <v-card-text>
                  <list-sku :id="Number(id)" :attributes="getAttributes"/>
                </v-card-text>
              </v-card>
            </v-flex>
          </v-tab-item>
        </v-tabs-items>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
  import {mapActions, mapState, mapMutations, mapGetters} from 'vuex'
  import { GETTERS } from '@product/constants'
  import { ACTIONS, GLOBAL } from '@/constants'
  import Wysiwyg from '@/vue/Wysiwyg.vue'
  import productAttributes from '@product/vue/Attribute/Attributes'
  import { ValidationConvert } from '@/vue/Validations'
  import fileBox from '@file/components/file-box/FileBox'
  import ListSku from '@product/vue/Sku/ListSku'

  export default {
    props: {
      id: {
        type: String,
        required: true
      },
    },
    data: function () {
      return {
        tabs: null,
        valid: false,
        isSending: false,
        validationConvert: new ValidationConvert(),
        searchTypeProduct: '',
        searchProductCategory: '',
        searchLineProduct: ''
        //attributes: []
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
      form() {
        return this.getItem(Number(this.id))
      },
      // список типов продуктов для выбранной категории
      getTypeProducts() {
        return this.typeProducts.filter(item => item.product_category_id == this.form.product_category_id)
      },
      // список линеек продуктов для выбранного типа продукта
      getLineProducts() {
        return this.lineProducts.filter(item => item.type_product_id == this.form.type_product_id)
      },
      getProductCategory() {
        return this.productCategories.find(item => item.id == this.form.product_category_id)
      },
      getTypeProduct() {
        return this.typeProducts.find(item => item.id == this.form.type_product_id)
      },
      getLineProduct() {
        return this.lineProducts.find(item => item.id == this.form.line_product_id)
      },
      getAttributablesProductCategory() {
        return this.attributables.filter(item => item.attributable_id == this.form.product_category_id && item.attributable_type == this.getProdCategoriesModel)
      },
      getAttributablesTypeProduct() {
        return this.attributables.filter(item => item.attributable_id == this.form.type_product_id && item.attributable_type == this.getTypeProductModel)
      },
      getAttributablesLineProduct() {
        return this.attributables.filter(item => item.attributable_id == this.form.line_product_id && item.attributable_type == this.getLineProductModel)
      },
      getAttributebles() {
        return this.getAttributablesProductCategory.concat(this.getAttributablesTypeProduct).concat(this.getAttributablesLineProduct)
      },
      getAttributes() {
        return _.sortBy(this.getAttributebles.map(item => {
          return Object.assign(item, this.transformByKey(item, 'attribute_id'))
        }),[function(o) {return o.sort}])
      },
      ...mapState('products', ['items', 'typeFiles']),
      ...mapGetters('products', {getItem: GLOBAL.GET_ITEM, getModel: 'getModel'}),
      ...mapGetters('product_categories', {getProdCategoriesModel: 'getModel'}),
      ...mapGetters('type_products', {getTypeProductModel: 'getModel'}),
      ...mapGetters('line_products', {getLineProductModel: 'getModel'}),
      ...mapGetters('attributables', {transformByKey: 'transformByKey'}),
      ...mapState('attributes', {attributes: 'items'}),
      ...mapState('initializer', ['messages']),
      ...mapState('product_categories', {productCategories: 'items'}),
      ...mapState('type_products', {typeProducts: 'items'}),
      ...mapState('line_products', {lineProducts: 'items'}),
      ...mapState('attributables', {attributables: 'items'})
    },
    components: {
      fileBox,
      Wysiwyg,
      productAttributes,
      ListSku
    },
    methods: {
      ...mapActions('products', {save: GLOBAL.SAVE_DATA}),
      ...mapMutations('initializer', {resetError: 'RESET_ERROR'}),
      changeProductCategories() {
        this.form.type_product_id = null
        this.form.line_product_id = null
      },
      changeTypeProducts() {
        this.form.line_product_id = null
      },
      init(id) {
        this.resetError();
        if (!this.getItem(Number(id))) {
          this.$router.push({name: 'list-product'})
        }
      },
      onSubmit() {
        if (this.$refs.form.validate()) {
          this.isSending = true
          this.save(_.pick(this.form, [
            'id', 'title', 'price', 'description','qty', 'active', 'sort', 'onsale', 'special', 'need_order', 'product_category_id', 'type_product_id', 'line_product_id', 'vendor', 'IEC', 'sku'
          ])).then(response => {
            this.isSending = false
            //this.$router.push('list-product')
          })
        }
      },
      getRules(validations) {
        return validations ? this.validationConvert.ruleValidations(validations) : []
      }
    }
  }
</script>