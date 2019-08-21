import {mapState} from 'vuex'

export default {
  data() {
    return {
      searchTypeProduct: '',
      searchProductCategory: '',
      searchLineProduct: '',
      product_category_id: null,
      type_product_id: null,
      line_product_id: null
    }
  },
  computed: {
    getTypeProducts() {
      return this.typeProducts.filter(item => item.product_category_id == this.product_category_id)
    },
    // список линеек продуктов для выбранного типа продукта
    getLineProducts() {
      return this.lineProducts.filter(item => item.type_product_id == this.type_product_id)
    },
    getProductCategory() {
      return this.productCategories.find(item => item.id == this.product_category_id)
    },
    ...mapState('product_categories', {productCategories: 'items'}),
    ...mapState('type_products', {typeProducts: 'items'}),
    ...mapState('line_products', {lineProducts: 'items'}),
  },
  beforeRouteEnter(to, from, next) {
    next(vm => {
      vm.loadHeading()
    })
  },
  methods: {
    loadHeading() {
      let actionPromise = [];
      ['product_categories', 'type_products', 'line_products'].forEach(action => {
        actionPromise[action]=this.$store.dispatch(action+'/GLOBAL_LOAD_ALL')
      })
      Promise.all(actionPromise)
    },
  }
}