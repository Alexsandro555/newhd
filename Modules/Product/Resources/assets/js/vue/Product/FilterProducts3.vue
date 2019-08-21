<template>
  <div>
    Работает! Привет!
  </div>
</template>
<script>
  import {normalize, schema} from 'normalizr'

  export default {
    props: {
      original: {
        type: Array,
        default: []
      }
    },
    data() {
      return {}
    },
    mounted() {
      const attributeValue = new schema.Entity('attributeValue')

      const attribute = new schema.Entity('attribute', {
        pivot: attributeValue
      })

      const product = new schema.Entity('product', {
        attributes: [attribute]
      })

      this.original.forEach(item => {
        let normalizedData = normalize(item, product)
        console.log(normalizedData)
      })
    },
    methods: {}
  }
</script>