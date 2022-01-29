<template>
   
     



         <div  class="thumbnail">


        <img v-if="media && media !=''"  :src="'/storage/media/shops/'+shopid+'/'+media[0].url" :alt="media[0].name" >
         <img v-else  src="/storage/media/default.png"  class="default">

        
        </div>

    
</template>


<script>

export default {
    props:{
        media:Object,
        shopid:''
    }


   
}
</script>