<template>
    <div>
 


    
<Formheader typepage="index" routename='product'   :Shopinfo="Shop"   />


    


    <div class="products" v-if="Shop.products  !='' ">


            <div class="title_head">

            <h3>All my products</h3>

            
            </div>

    <HeaderShop :summaryShop="productsData"  /> 
  
     <Products :products="Shop.products" 
     :ShopId="Shop.id" :ShopSlug="Shop.slug"  />
        

    
    </div>


    </div>
</template>


<script>
import { Link,Head } from '@inertiajs/inertia-vue3'
 import Products from '@/Components/Products/sections/products'
import Layout from '@/Layouts/Dashboard'
import HeaderShop from '@/Components/Elementspage/headerShop'

import Formheader from '@/Components/Elementspage/headerForm.vue'
import { ref } from 'vue'

export default {
    


props: {
        Shop:Object
},

components:{
    Link,
    Products,
    HeaderShop,Formheader
},

   layout: Layout,

 setup (props) {

console.log(props.Shop)

     const productsData = ref({
         totalRev:props.Shop.totalRev != null ? props.Shop.totalRev  : 0 ,
          totalOrders:props.Shop.countorders,
           totalProduct:props.Shop.totalProduct,
           symbole :props.Shop.currency.symbole
          
     });


     return {productsData}








 },




}
</script>