
<template>


    <swiper  :initialSlide="2"  :loop="true"   :navigation="true" :effect="'cards'"
     :grabCursor="true" class="mySwiper">
  <swiper-slide v-for="(item, index) in medias" :key="index">



             <Link class="boxswiper" 
             :href="route('_shop_index',{id:item.id,slug:item.slug})" 
             >

   
       <thumbnailVue :media="item.medias" :shopid="item.id" />



                            <div class="info">

                              <p class="title" v-if="item.name.length<15"> {{ item.name }}</p>
                                 <p class="title" v-else>{{ item.name.substring(0,30)+".." }}</p>
 
                                 <div class="desc" >
                                 {{ item.description.replace(/<[^>]*>?/gm, "") }}</div>
                                    <div class="adrrs">
                                    <p>{{item.adresse}}, {{item.city.name}}, {{item.city.country.name}}</p>
                                    </div>
                             <div class="phone">
                                    <p>{{item.phone}}</p>
                                    </div>
                         
                         <resIconVue :rsicon="{fb:item.facebook,ig:item.instagram}" />   
                            </div>
                       
             
  </Link>
  
  
  
  </swiper-slide>
  </swiper>
    
</template>
<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';
import thumbnailVue from './Front/Marketplace/thumbnail.vue';
import { Link,Head } from '@inertiajs/inertia-vue3';
import resIconVue from './Front/Shop/resIcon.vue';
// Import Swiper styles
import 'swiper/css';
import { ref } from 'vue';
import "swiper/css/effect-cards"

import "swiper/css/pagination"
import "swiper/css/navigation"


// import Swiper core and required modules
import SwiperCore, {
  EffectCards,Navigation
} from 'swiper';

// install Swiper modules
SwiperCore.use([EffectCards,Navigation]);


export default {
  components: {
    Swiper,
    SwiperSlide,thumbnailVue,Link,resIconVue
  },
 
 props:{
     medias:Object
 },

 setup(props) {

     let shopinfo = ref({fb:props.facebook,ig:props.instagram})

     return {
         shopinfo
     }
     
 }
  
}
</script>

<style>


.swiper {
  width: 850px;
  height: 400px;
}

.swiper-slide {
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 18px;
  font-size: 22px;
  font-weight: bold;
  color: #fff;
}
.swiper-cards .swiper-slide {
border-radius: 18px;

}
.swiper-button-prev {
    left: -21%;

    border: 1px dashed #b7bdc6;
    border-radius: 50%;
        background: #fff;
    width: 40px;
    height: 40px;
    background: #fff;
    
}

.swiper-button-prev::after{
    font-size: var(--fs-18);
    color: #127e83;
}

.swiper-button-next {
    right: -21%;
      border: 1px dashed #b7bdc6;
    border-radius: 50%;
        background: #fff;
    width: 40px;
    height: 40px;
    background: #fff;
}
.swiper-button-next::after{
    font-size: var(--fs-18);
    color: #127e83;
}
</style>