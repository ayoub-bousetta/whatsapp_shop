<template>
    <div v-if="shops">


            <div class="product_boxes">


    
    
                 
                            <Link :href="route('_shop_index',{id:shops.id,slug:shops.slug})" class="product">

                           
                            <div class="thumb">
                             <Thumbnail :media="shops.medias" :shopid="shops.id" />
                            </div>

                            <div class="info">

                              <p v-if="shops.name.length<15"> {{ shops.name }}</p>
                                 <p v-else>{{ shops.name.substring(0,30)+".." }}</p>
 
                                 <div class="desc" >
                                 {{ shops.description.replace(/<[^>]*>?/gm, "").substring(0,120)+".." }}</div>
                                    <div class="adrrs">
                                    <p>{{shops.adresse}}</p>
                                    </div>
                            
                         
                            
                            </div>
                            


                            </Link> 
                    
             

       
        
        </div>


    </div>
</template>
<script>
import { Link,Head } from '@inertiajs/inertia-vue3'
import Thumbnail from '@/Components/Front/Marketplace/thumbnail'
import {computed} from "vue"

export default {
    

    props:{
        shops:Object,
    },
  components:{
        Link,Thumbnail
    },

  

    setup(props) {




   
        
    }
}
</script>