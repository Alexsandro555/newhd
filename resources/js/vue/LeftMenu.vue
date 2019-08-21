<template>
  <div class="menu-left hidden-sm-and-down">
    <v-list class="list-menu-left">
      <v-list-tile class="menu-left__header">
        <v-list-tile-content>
          <v-list-tile-title @click="clickToggle" class="text-md-center">Каталог продукции</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
      <template v-if="toggle" v-for="productCategory in menu">
        <v-menu offset-x open-on-hover class="menu-left-h">
          <v-list-group :value="false" class="menu-left__group" slot="activator">
            <v-list-tile slot="activator">
              <v-list-tile-content>
                <v-list-tile-title>
                  {{ productCategory.title }}
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile v-for="typeProduct in productCategory.type_products" :key="typeProduct.id">
              <v-list-tile-content>
                <v-list-tile-title @click="goToPage('/catalog/'+productCategory.url_key+'/'+typeProduct.url_key)" class="menu-left-item-el"
                                   slot="activator">
                  <img src="/images/footer-list-mark.png"/>
                  {{ typeProduct.title }}
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list-group>
          <div v-if="productCategory.type_products.length > 0 && checkLineProducts(productCategory.type_products)" class="sub-menu" style="width: 600px">
            <div style="display: inline-block" row wrap v-for="typeProduct in productCategory.type_products" :key="typeProduct.id">
              <v-layout column wrap v-if="typeProduct.line_products.length > 0">
                <span class="sub-menu__header">{{typeProduct.title}}</span>
                <v-list>
                  <v-list-tile class="sub-menu__list-tile" v-for="lineProduct in typeProduct.line_products" :key="lineProduct.id">
                    <a :href="'/catalog/'+productCategory.url_key+'/'+typeProduct.url_key+'/'+lineProduct.url_key">{{lineProduct.title}}</a>
                  </v-list-tile>
                </v-list>
              </v-layout>
            </div>
          </div>
        </v-menu>
      </template>
    </v-list>
    <div class="price-wrapper">
      <div class="price">
        <v-layout row wrap text-xs-center>
          <v-flex xs5 class="price__img">
            <img src="/images/img-price.png"/>
          </v-flex>
          <v-flex xs6 class="price__download">
            Скачать<br>
            <span class="price__download--next">прайс</span>
          </v-flex>
        </v-layout>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    name: 'LeftMenu',
    props: {
      propToggle: {
        type: Boolean,
        default: true
      }
    },
    data: function () {
      return {
        menu: [],
        toggle: false
      }
    },
    mounted: function () {
      this.getMenu()
      this.toggle = this.propToggle
    },
    methods: {
      getMenu() {
        axios.get('/menu-left')
          .then(response => response.data)
          .then(response => {
            this.menu = response
          })
      },
      goToPage(url) {
        window.location.href = url
      },
      clickToggle() {
        this.toggle = !this.toggle
      },
      limit(text, length) {
        return text.length > length?text.substr(0, length)+"...":text
      },
      checkLineProducts(typeProducts) {
        let enable = false
        typeProducts.forEach(typeProduct => {
          if(typeProduct.line_products.length > 0) enable = true
        })
        return enable
      }
    }
  }
</script>
<style>
  .transition {
    -webkit-transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
  }
</style>