<template>
  <div class="detail__image--wrapper">
      <!--<div v-if="stock" class="detail__image-label">
        Акция!
      </div>-->
      <div class="detail__image">
        <v-container v-if="loading" fill-height>
          <v-layout row wrap align-center>
            <v-flex class="text-xs-center">
              <v-progress-circular  indeterminate  style="vertical-align: middle" :size="100" color="primary"></v-progress-circular>
            </v-flex>
          </v-layout>
        </v-container>
        <template v-else>
          <div class="image-wrapper">
            <img v-if="curImage" @click.stop="dialog = true" :src="curImage"/>
            <img v-else src="/images/no-image.png"/>
            <v-dialog
              v-model="dialog"
              :max-width="figure?1200:350"
              >
              <v-card>
                <v-card-text class="text-xs-center">
                  <img :src="getImage"/>
                </v-card-text>
              </v-card>
            </v-dialog>
          </div>
          <div v-if="items.length>0" class="thumbnails-slider">
            <carousel :items="3" :nav="false" :dots="false" :margin="5">
              <div  v-for="item of items" :key="item.id">
                <v-container fill-height>
                  <v-layout row wrap align-center>
                    <v-flex class="text-xs-center">
                      <img @click="selectSlide(item.id)"  :src="'/storage/'+item.file"/>
                    </v-flex>
                  </v-layout>
                </v-container>
              </div>
              <template slot="prev"><img class="nav-arrow-left" src="/images/slider-left-arrow.png"/></template>
              <template slot="next">
                <img  align="center" class="nav-arrow-right" src="/images/slider-right-arrow.png"/></template>
            </carousel>
          </div>
        </template>
      </div>
  </div>
</template>
<script>
  import axios from 'axios'
  import carousel from 'vue-owl-carousel'

  export default {
    props: {
      url: String,
      stock: {
        Type: Boolean,
        default: false
      },
      product: {
        Type: Object,
        required: true
      }
    },
    data: function () {
      return {
        elements: [],
        items: [],
        curImage: '',
        loading: true,
        dialog: false,
        figure: false,
        imageId: null
      }
    },
    mounted() {
      axios.get(this.url).then(response => {
        this.elements = response.data.filter(item => item.image_view_id == this.product.image_view_id || _.isNull(item.image_view_id))
        this.elements.forEach(element => {
            this.items.push({'id': element.id, 'file': element.config.files.small.filename})
        });
        // TODO:: утсранить дублирование
        this.curImage = this.items.length > 0 ? '/storage/' + this.elements[0].config.files.main.filename : null
        if(this.elements[0].figure.length > 0 ) {
          this.figure = true
        }
        this.imageId = this.elements[0].id
        this.loading = false
      }).catch(error => {
        this.loading = false
      });
    },
    components: {
      carousel
    },
    computed: {
      getImage() {
        if(this.figure) {
          return '/files/figure/'+this.imageId+'/big/'+this.product.id
        }
        return this.curImage
      }
    },
    methods: {
      selectSlide: function (id, event) {
        this.elements.forEach(element => {
          if (element.id === id) {
            /*if(element.figure.length > 0) {
              let config = {
                url: '/files/figure/'+element.id+'/'+'main'+'/'+this.id,
                method: 'GET',
                responseType: 'blob'
              }
              axios(config).then(response => {
                let reader = new FileReader();
                reader.readAsDataURL(response.data);
                reader.onload = () => {
                  this.curImage = reader.result;
                }
              }).catch(error => {
                console.log(error)
              })
            }*/
            // TODO:: устранить дублирование
            this.curImage = '/storage/' + element.config.files.main.filename;
            if(element.figure.length > 0) {
              this.figure = true
            }
            else {
              this.figure = false
            }
            this.imageId = element.id
          }
        });
      },
    }
  }
</script>

