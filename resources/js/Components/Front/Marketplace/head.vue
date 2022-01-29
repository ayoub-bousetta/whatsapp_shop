<template>
      <header>


      <SwiperSlide v-if="shopsobject && shopsobject.length >0" :medias="shopsobject" />

           <div class="header_text" >


                     <h1  v-if="title != '' && !shopsobject"> {{title}}</h1>    
               
            </div>
        </header>
</template>

<script>
import SwiperSlide from '@/Components/swiperSlide'
export default {
  
props:{
  title:'',
  shopsobject:Object
},

components:{
  SwiperSlide
}


}
</script>

<style>
header{
  height: auto !important;
  padding-top: 60px ;
  padding-bottom: 80px;

}
</style>