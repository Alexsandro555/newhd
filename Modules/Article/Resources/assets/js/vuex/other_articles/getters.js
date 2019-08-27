export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/other-articles"
    obj.module="other_articles"
    obj.primary_key="id"
    obj.model="Modules\\Article\\Models\\OtherArticle",
    obj.upLinks=state.relations
    return obj
  }
}