<template>
    <div>
    
    
<Formheader typepage="index"   />


<ul>
<li v-for="(order, index) in orders" :key="order.id">

{{}}

</li>

</ul>


    
        
    </div>
</template>


<script>
import { Link,Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Layouts/Dashboard'
import HeaderShop from '@/Components/Elementspage/headerShop'

import Formheader from '@/Components/Elementspage/headerForm.vue'
import { ref } from 'vue'
export default {


    props:{
        Orders:Object,
    },


    components:{
            Link,
      
            HeaderShop,Formheader
        },

   layout: Layout,

    
}
</script>