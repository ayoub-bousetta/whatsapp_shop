<template>
   
     

                
<div v-if="showUrl!='non' ">
 <ul class="categories"  v-for="(section, index) in sections" :key="index">


                <li  >

              

                <div class="title" >
                 <p> {{section.name}} </p>
                 <Link  class="showfilter" :href="route('_category',{slug:section.slug})">Discover more
                    
                    <div class="show_more">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 24 24" ><path  d="M13.5 19l-1.4-1.4 5.1-5.1H3v-2h14.2l-5.1-5.1L13.5 4l7.5 7.5-7.5 7.5z" fill="#ffffff"></path></svg>
                    </div>
                   
                </Link>
                </div>


              

                <Shopbox v-if="section.shops"
                :shops="section.shops"
                  />


                    
                
                </li>
            

            </ul>
</div>



           

<div v-else>
 <ul class="categories" >


                <li >


              

                <Shopbox v-if="sections"
                :shops="sections"
                  />


                    
                
                </li>
            

            </ul>
</div>

    
</template>


<script>

import { Link,Head } from '@inertiajs/inertia-vue3'
import { ref } from "@vue/reactivity"
import Shopbox from '@/Components/Front/Marketplace/Shopbox'
export default {
    props:{
        sections:'',
        showUrl:''
    

    },
    components:{
        Link,Shopbox
    },

    setup(props) {

        let showit =ref(false)
        let shopId =ref('')
     
 
        
        return {showit,shopId}
    }

    
}
</script>