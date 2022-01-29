<template>
    <div class="warp">

         
 <div class="market_page">
        <NavTop :itemTotal="itemTotal" />
        
     
               <slot name="headerhome" />       
                

                        <slot/>

          </div>     
     


     <Footer />
    </div>
</template>


<script>

import NavTop from '@/Components/Front/Shop/Navtop.vue'

import Footer from '@/Components/Front/Shop/Footer.vue'
export default {
    props:{
        itemTotal:Object
    },
    components:{
        NavTop,Footer
    }
    
}
</script>
