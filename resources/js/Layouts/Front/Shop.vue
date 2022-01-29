<template>
    <div class="warp">

    
        <div class="shop_page">
        <NavTop :itemTotal="itemTotal" />
     
               

                            <slot name="headershop" />

                    
                    
            
                <main >
                

                        <slot/>

                </main>
        </div>
           
    </div>
</template>


<script>

import NavTop from '@/Components/Front/Shop/Navtop.vue'
export default {
    props:{
        itemTotal:Object
    },
    components:{
        NavTop
    }
    
}
</script>
