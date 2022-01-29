<template>
   
     


        <div class="product_boxes">



            <ul v-if="productsShop">
    
    
                    <li v-for="item in productsShop.data" :key="item.id">

                            <Link :href="route('_single_product_shop',{id:item.shop_id,slug:symbole.slug,product_id:item.id,product_slug:item.slug})" class="product">


                           
                            <div class="thumb">
                             <Thumbnail :media="item.medias" :shopid="item.shop_id" />
                            </div>

                            <div class="info">

                              <p v-if="item.name.length<8"> {{ item.name }}</p>
                                 <p v-else>{{ item.name.substring(0,30)+".." }}</p>
                            
                            <div class="price">
                                <span> {{
                                    item.unit_price.toFixed(2)
                                    
                                    }} </span>
                           <i :data-init='symbole.name'> {{symbole.code}} </i> 
                           </div>
                            
                            
                            </div>
                            


                            </Link> 
                    
                    
                    </li>
    </ul>  

       
        
        </div>
         <div v-show="productsShop && productsShop.next_page_url" 
        class="showmore" ><span @click="Shomoreproductclick()">Show more 
        
        <div v-show="loading" class="lds-loading"><div></div><div></div><div></div></div>
        <svg v-show="loading == false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="css-1lf9ial"><path d="M13.5 19l-1.4-1.4 5.1-5.1H3v-2h14.2l-5.1-5.1L13.5 4l7.5 7.5-7.5 7.5z" fill="currentColor"></path></svg></span></div>

    
</template>


<script>
import Thumbnail from '@/Components/Front/Shop/Thumbnail'
import { Link,Head } from '@inertiajs/inertia-vue3'
import {  ref } from '@vue/reactivity'
import {  watch } from '@vue/runtime-core'

export default {
    props:{
       
        sectionId:'',
        shopId:'',
        symbole:'',
        onesection:false
      

    },
    components:{
        Thumbnail,Link
    },


    setup(props) {

let productsShop = ref()

        let loading =ref(false);



           

  axios.get(route('_shop_ajax_product',{section_id:props.sectionId,id:props.shopId}))
             .then(res=>{
                        productsShop.value=res.data     
                        
             })

 


watch(() => props.sectionId, (idsection) => {
 
      axios.get(route('_shop_ajax_product',{section_id:idsection,id:props.shopId}))
             .then(res=>{
                        productsShop.value=res.data     
                        
             })
     
    });


const Shomoreproductclick = ()=>{




                if(productsShop.value.next_page_url != null){

                    loading.value=true;

                     axios.get(productsShop.value.next_page_url).then(res=>{


                        productsShop.value={
                            ...res.data,
                            data:[...productsShop.value.data,...res.data.data]
                        }

                         loading.value=false;

                        
                    })


                }

        }
        

        return {Shomoreproductclick,productsShop,loading}
        
    }
}
</script>