<template>
  <v-flex xs12>
    <v-form ref="form" lazy-validation v-model="valid">
      <slot :form="form" :messages="messages" :getRules="getRules"></slot>
      <v-btn large color="success" :class="{'red': !valid}" :disabled="isSending" @click.prevent="onSubmit">Сохранить</v-btn>
    </v-form>
  </v-flex>
</template>
<script>
  import axios from 'axios'
  import { mapState } from 'vuex'
  import ConvertValidationsMixin from '@/mixins/ConvertValidationsMixin'

  export default {
    data() {
      return {
        valid: true,
        isSending: false,
        form: {},
      }
    },
    mixins: [ConvertValidationsMixin],
    computed: {
      ...mapState('initializer', ['messages']),
    },
    methods: {
      onSubmit() {
        this.isSending = true
        axios.post('callback',this.form)
          .then(response => response.data)
          .then(response => {
            this.isSending = false
          })
          .catch(error => {
            this.isSending = false
            console.error(error)
          })
      }
    }
  }
</script>