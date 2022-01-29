<template>
    <Layout >
        <template v-slot:headermarket>
            <headMarketplace :shopsobject="Slidersshops" />

</template>


            
    <main class="" >
    
    <Sections v-if="sections " :sections="sections.data" />
    
    </main>

            
            
        

        </Layout>
</template>

<script>

import Layout from '@/Layouts/Front/marketplace'
import Sections from '@/Components/Front/Marketplace/Section'
 import { debounce } from 'lodash';
 import axios from 'axios'

import { computed, reactive, ref } from '@vue/reactivity'
import headMarketplace from '@/Components/Front/Marketplace/head'
export default {


     props:{
        Shops:'',
        Slidersshops:Object


    },
    
    components: {
       Layout ,headMarketplace,Sections
    },


    setup(props) {

        let sections= ref(props.Shops)
             window.addEventListener('scroll',debounce((e)=>{


            let pixelfrombottom =  document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight

                if(pixelfrombottom < 200 && sections.value.next_page_url != null){
                     
                    axios.get(sections.value.next_page_url).then(res=>{

                      


                        sections.value={
                            ...res.data,
                            data:[...sections.value.data,...res.data.data]
                        }


                        
                    })


                }

        },100))

        return {sections}
    }

    
}
</script>