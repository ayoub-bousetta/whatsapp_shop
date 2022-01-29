<template>




    <div class="slider">

     <div class="thumbnail">



    <img v-if="mediableid != '' && mediableUrl != '' " 
     :src="'/storage/media/shops/'+shopid+'/products/'+mediableid+'/'+mediableUrl"  >

    <img v-if="mediableid == '' && mediableUrl == '' " 
     :src="'/storage/media/shops/'+shopid+'/products/'+media[0].mediable_id+'/'+media[0].url"  >

      <div v-show="loading" class="lds-loading"><div></div><div></div><div></div></div>


    
    </div>

       <Carousel :itemsToShow="3">
    <Slide v-for="slide in media" :key="slide" :class="{selecteed:slide.url==selecteed}">
 
      <div class="carousel__item" >
           <img @click="geturlimag(slide.mediable_id,slide.url)" 
           :src="'/storage/media/shops/'+shopid+'/products/'+slide.mediable_id+'/'+slide.url" :alt="slide.name" >

      </div>
    </Slide>

    

  </Carousel>

   
    
    
  
    </div>



 
</template>


<script>

import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import { ref } from '@vue/reactivity'
import 'vue3-carousel/dist/carousel.css';


export default {


props:{
    media:"",
    shopid:""
},

     components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },

   setup(props) {
       let mediableUrl =ref('')
let selecteed =ref(props.media[0].url)
       let mediableid =ref('')
 let loading =ref(false);
       const geturlimag =(id,url)=> {
           
              loading.value=true;
 mediableid.value=id
           mediableUrl.value=url
             loading.value=false;
             selecteed.value=url

       }

     


            return {
                geturlimag,mediableUrl,mediableid,loading,selecteed
            }


   }
}
</script>

<style>


img{
    max-width: 250px;
}
img.default{
 max-width: 100%;
}
</style>