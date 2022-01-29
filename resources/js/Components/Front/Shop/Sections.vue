<template>
   
     


                  

            <ul class="categories" v-for="(section, index) in sections" :key="index">



                <li  >

              

                <div class="title">
                 <p> {{section.name}} </p>
                 <span class="showfilter" @click="showForm()">Discover more
                    
                    <div class="show_more">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 24 24" ><path  d="M13.5 19l-1.4-1.4 5.1-5.1H3v-2h14.2l-5.1-5.1L13.5 4l7.5 7.5-7.5 7.5z" fill="#ffffff"></path></svg>
                    </div>
                   
                </span>
                </div>


               


                <Products 
                :shopId="section.shop_id"
                :sectionId="section.id"
                :symbole="symbole"
                  />

                    
                
                </li>
            

            </ul>



         
        
    
</template>


<script>

import { Link,Head } from '@inertiajs/inertia-vue3'
import Products from '@/Components/Front/Shop/products'
import { ref } from "@vue/reactivity"

export default {
    props:{
        sections:'',
        symbole:'',
        sectionId:''

    },
    components:{
        Link, Products
    },

    setup(props) {

        let showit =ref(false)
        let shopId =ref('')

        if(props.sections !=""){
            shopId.value =props.sections[0].shop_id
        }
        
 
        const showForm = ()=>{


            console.log('fdg')


            showit.value=true


        }
        return {showForm,showit,shopId}
    }

    
}
</script>