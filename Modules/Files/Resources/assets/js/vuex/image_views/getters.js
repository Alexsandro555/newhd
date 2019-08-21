export default {
  config: (state) => {
    let obj = new Object()
    obj.items="items"
    obj.load="/api/image_views"
    obj.module="image_views"
    obj.primary_key="id"
    obj.model="Modules\\Files\\Entities\\ImageView"
    return obj
  },
  items: state => state.items
}