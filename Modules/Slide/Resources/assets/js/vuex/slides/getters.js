export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/slides"
    obj.module="slides"
    obj.primary_key="id"
    obj.model="Modules\\Slide\\Entities\\Slide"
    obj.upLinks=state.relations
    return obj
  },
}