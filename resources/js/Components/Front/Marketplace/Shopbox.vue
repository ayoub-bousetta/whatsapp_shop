<template>
    <div v-if="shops">


            <div class="product_boxes">



            <ul v-if="shops">
    
    
                    <li v-for="item in shops" :key="item.id">

                            <Link :href="route('_shop_index',{id:item.id,slug:item.slug})" class="product">

                           
                            <div class="thumb">
                             <Thumbnail :media="item.medias" :shopid="item.id" />
                            </div>

                            <div class="info">

                              <p v-if="item.name.length<15"> {{ item.name }}</p>
                                 <p v-else>{{ item.name.substring(0,30)+".." }}</p>
 
                                 <div class="desc" >
                                 {{ item.description.replace(/<[^>]*>?/gm, "").substring(0,120)+".." }}</div>
                                    <div class="adrrs">
                                    <p>{{item.adresse}}</p>
                                    <p>{{item.city.name}}, {{item.city.country.name}}</p>
                                    </div>
                            
                         
                            
                            </div>
                            


                            </Link> 
                    
                    
                    </li>
    </ul>  

       
        
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