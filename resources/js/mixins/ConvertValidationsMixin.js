import { ValidationConvert } from '@/vue/Validations'

export default {
  data() {
    return {
      validationConvert: new ValidationConvert(),
    }
  },
  methods: {
    getRules(validations) {
      return this.validationConvert.ruleValidations(validations)
    }
  }
}