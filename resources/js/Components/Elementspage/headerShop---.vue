<template>
    <div class="header_single">



  <carousel :items-to-show="1" v-if="CoverMedias !=''">
    <slide v-for="slide in CoverMedias" :key="slide.id">
  
           <div class="carousel__item">
           <img  :src="'/storage/media/shops/'+slide.mediable_id+'/'+slide.url" :alt="slide.name" >
           </div>  
    </slide>

    <template #addons>
     <navigation />
    </template>
  </carousel>
 <div  v-else class="emptypng" >
  <img src="/storage/media/header_default.png" alt="">
 </div>
 



        <div  class="thumbnail">

        <img v-if="thumbnailMedias && thumbnailMedias !=''"  :src="'/storage/media/shops/'+thumbnailMedias[0].mediable_id+'/'+thumbnailMedias[0].url" :alt="thumbnailMedias[0].name" >
         <img v-else  src="/storage/media/default.png"  >

        
        </div>

    </div>
</template>

<script>

import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import { computed } from 'vue';
import 'vue3-carousel/dist/carousel.css';



export default {

props:{
    medias:Object,

    
    
    
  
},
   components: {
    Carousel,
    Slide,
    Pagination,
    Navigation
  },



 
  setup(props) {


      if(props.medias != ''){


          const thumbnailMedias = computed(() => props.medias.filter(image => image.mediazonetype.slug == 'thumbnail'))
const CoverMedias = computed(() => props.medias.filter(image => image.mediazonetype.slug == 'cover'))

    return {
        thumbnailMedias,CoverMedias
    }

      }
      

  }




}
</script>

