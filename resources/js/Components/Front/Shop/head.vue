<template>
    <header :style="cssPropsBackground">
            <div class="header" >

            <div v-if="medias">

            <div class="logo">
            <img v-show="thumbnailMedias && thumbnailMedias.length >0" 
            
                  :src="'/storage/media/shops/'+thumbnailMedias[0].mediable_id+'/'+thumbnailMedias[0].url" 

             alt="">
            <img else src="/storage/media/default.png">
            </div>
        


            </div>
                <div v-if="title != '' ">

                     <h1> {{title}}</h1>    
                </div>

            </div>
        </header>
</template>

<script>


import { computed,ref } from "@vue/reactivity"


export default {
    props:{
        medias:Object,
        title:''
    },

   


    setup(props) {
        

let cssPropsBackground = ref({backgroundImage:""})
        
if(props.medias){

    const thumbnailMedias = computed(() => 
props.medias.filter(image => image.mediazonetype.slug == 'thumbnail'))
const CoverMedias = computed(() => 


props.medias.filter(image => image.mediazonetype.slug == 'cover'




))





if(CoverMedias && CoverMedias.value != ""){
cssPropsBackground.value = 
    {
     backgroundImage: `url(/storage/media/shops/${CoverMedias.value[0].mediable_id}/${CoverMedias.value[0].url})` 

     }     
}




return {
    thumbnailMedias,CoverMedias,cssPropsBackground
}

}else{
    return {
   cssPropsBackground
}
}




    }


}
</script>


<style>

header{


    
}

</style>