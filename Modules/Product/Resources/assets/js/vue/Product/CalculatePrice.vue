<template>
  <div>
    <p>
      <span class="detail__price">
          <span ref="price" class="detail__price--big">{{!this.product.sku?this.product.price:(getPrice?getPrice.price:product.price)}}</span>
          ₽{{product.price_amount?'/'.product.price_amount:""}}
      </span><br>
      <v-chip v-if="product.vendor" color="yellow">арт. {{product.vendor}}</v-chip>
    </p>
    <div class="figure-button__wrapper">
      <a class="figure-button hidden-md-and-up"  href="/cart">
        Заказать
        <img src="/images/btn-sale-image.png" align="center"/>
      </a>
      <a class="figure-button hidden-sm-and-down"  @click="addCart(product.id)" href="#">
        Заказать
        <img src="/images/btn-sale-image.png" align="center"/>
      </a>
    </div>
    <v-flex xs10 v-if="product.sku && getAttributes.length > 0">
      <v-select v-for="attribute in getAttributes"
        :key="attribute.id"
        height="35px"
        color="black"
        dark
        :name="attribute.id+'_id'"
        :label="attribute.title"
        :items="attribute.attribute_list_value"
        item-text="title"
        item-value="id"
        no-data-text="Нет данных"
        v-model="attributesValue[attribute.id]">
      </v-select>
    </v-flex>
  </div>
</template>
<script>
  import { mapActions, mapMutations } from 'vuex'
  import {ACTIONS, MUTATIONS} from '@cart/constants'

  export default {
    props: {
      product: {
        type: Object,
        required: true
      }
    },
    computed: {
      getProductCategoryAttributes() {
        return (this.product.product_category && this.product.product_category.attributes) || []
      },
      getTypeProductAttributes() {
        return (this.product.type_product && this.product.type_product.attributes) || []
      },
      getLineProductAttributes() {
        return (this.product.line_product && this.product.line_product.attributes) || []
      },
      getAttributes() {
        return this.getProductCategoryAttributes.concat(this.getTypeProductAttributes).concat(this.getLineProductAttributes)
      },
      getPrice() {
        return this.product.prices.find(price => {
          let filtered =  _.omit(price, ['price'])
          return _.isEqual(_.values(filtered), _.values(this.attributesValue))
        })
      }
    },
    data() {
      return {
        attributesValue: {},
        prices: []
      }
    },
    created() {
      this.getAttributes.forEach(attribute => {
        if(attribute.attribute_list_value.length > 0) {
          let obj = {};
          obj[attribute.id] = attribute.attribute_list_value[0].id
          this.attributesValue = Object.assign({}, this.attributesValue, obj)
        }
      })
    },
    methods: {
      addCart(id) {
        const count = 1
        this.addCartItem({id, count, price:this.$refs.price.innerHTML })
        this.showCartModal()
      },
      ...mapActions('cart',{addCartItem: ACTIONS.ADD_CART}),
      ...mapMutations('cart', {showCartModal: MUTATIONS.SHOW_MODAL})
    }
  }
</script>