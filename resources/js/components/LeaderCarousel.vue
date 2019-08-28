<template>
  <div>
    <carousel name="carousel2" style="width: 1200px; height: 270px"  :paginationColor="'#FFFFFF'" :autoplay="true" :loop="true" :pagination-enabled=true :navigation-enabled=false :per-page=1  :per-page-custom="[[480, 1], [768, 1]]">
      <slide v-for="slide in slides" :key="slide.id" class='center_message' id='centr_msg'>
        <div @if="slide.files.length>0">
          <img :src="'/storage/'+slide.files[0].config.files.main.filename" style='float:right'/><br/>
        </div>
        <span class='title'>
          <a :href="slide.url_key+'.html'" style='font-size:inherit'>{{slide.title}}</a>
          <img src='images/header_message_bg.png' style="position:absolute;bottom:-15px;right:0px"/>
        </span><br/>
        <span class="message">{{slide.description}}</span>
        <img src="/images/bg_center_message.png" style="position: absolute; z-index: -1; left: 0px; top: 220px;">
      </slide>
    </carousel>
  </div>
</template>
<script>
  import { Carousel, Slide } from 'vue-carousel'
  import axios from 'axios'

  export default {
    data() {
      return {
        url: 'slides',
        slides: []
      }
    },
    components: {
      Carousel,
      Slide
    },
    created() {
      axios.get(this.url)
        .then(response => response.data)
        .then(response => {
          this.slides = response
        })
        .catch(error => console.log(error))
    }
  }
</script>
