<template>
    <Layout >
        <template  v-slot:headermarket>
            <headMarketplace :title="Catname"  />

</template>

       
    
    
    <Sections v-if="Shops.total >0 " :sections="Shops.data" showUrl="non" />
    
   <div class="box_alert info" v-else>
             <p>Yep! Empty like my life </p>    
              <Link :href="route('Marketplace')">
                    <span>Visit the Marketplace</span>
       </Link>
   
        </div>

      <pagination  :links="Shops.links" />


    

            
        

        </Layout>
</template>

<script>

import Layout from '@/Layouts/Front/marketplace'
import Sections from '@/Components/Front/Marketplace/Section'

import { Link,Head } from '@inertiajs/inertia-vue3'

import Pagination from '@/Components/Pagination'
import headMarketplace from '@/Components/Front/Marketplace/head'
export default {


     props:{
        Shops:'',
        Catname:''


    },
    
    components: {
       Layout ,headMarketplace,Sections,Pagination,Link
    },


    setup(props) {

      
    }

    
}
</script>