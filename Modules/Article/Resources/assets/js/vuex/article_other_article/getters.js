export default {
  config: (state, getters, rootState, rootGetters) => {
    let obj=new Object()
    obj.items='items'
    obj.load='/api/article-other-article'
    obj.module='article_other_article'
    obj.primary_key='id'
    obj.model='Modules\\Article\\Models\\ArticleOtherArticle'
    obj.upLinks=state.relations
    // obj.upLinks=[{column:'type_product_id',module:'type_products'},{column:'line_product_id',module:'line_products'}]
    // obj.loadByKey={id:1}
    // obj.loadAll=true
    return obj
  }
}
