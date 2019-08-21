export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/article_types"
    obj.module="article_types"
    obj.primary_key="id"
    obj.model="Modules\\Product\\Entities\\ArticleType"
    return obj
  },
}