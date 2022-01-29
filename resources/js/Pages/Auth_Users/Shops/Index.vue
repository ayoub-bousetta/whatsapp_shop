<template>
  

  <div>

  


  <Formheader typepage="index"   />




        <ul v-if="flash.success" class="success">
       <li><p> {{flash.success }}</p></li>
      </ul>
 




 <div class="tables">
 
   <table>
   <thead>
    <tr>
    <th>Shop Name</th>
     <th>Status</th>

    <th>Products</th>
    <th></th>
  </tr>
   </thead>

   <tbody>
   
     <tr v-for="shop in shops.data" :key="shop.id">

    
        <td>

        <Link :href="route('one_shop', { shopid: shop.id,slugShop:shop.slug })">
      
          <div class="conatiner">

          <div class="img">
      
          <img v-if="shop.medias != '' && shop.medias[0].mediazonetype.slug =='thumbnail' " 
          :src="'/storage/media/shops/'+shop.id+'/'+shop.medias[0].url"  >

          <img v-else :src="'/storage/media/default.png'"  :alt="shop.name">
          
          </div>
          <div class="info">

          <p>{{shop.name}}</p>
          <span v-html="shop.description.substring(0,100)" ></span>
          </div>
          
          
          </div>
        
            </Link>
        </td>
         <td>
         
         <span class="status  fade" :class="{'complete':shop.online == 1,'waiting':shop.online == 0}">
      
      </span>
         
         
         
         </td>




        <td> {{shop.products_count}}</td>
        
        <td class="links">
           <Link class="alink" :href="route('edit_shop', { id: shop.id })">
   <i class="material-icons-outlined">
brush
</i>
  </Link>


  
         <span class="alink" @click="Deleteshops(shop.id)" >
   <i class="material-icons-outlined">
delete
</i>
  </span>

        </td>
        </tr>
   </tbody>
  
      
    </table>

 
 </div>

  

       <Link :href="link.url"
        v-if="shops.total && shops.total >0 && shops.length>= shops.per_page " 
        class="text-indigo-700 border-gray-500 p-5" v-for="link in shops.links" v-bind:key="link.label">
                    <span v-bind:class="{'text-red-700' : link.active}">{{ link.label }}</span>
       </Link>
















     </div>
</template>

<script>

import { Inertia } from '@inertiajs/inertia';
import { Link,Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Layouts/Dashboard'
import Formheader from '@/Components/Elementspage/headerForm.vue'

export default {
    props: {
        shops:Object,
        flash: Object,

    },

    components:{
        Link,Head,Formheader
    },

   layout: Layout,
    setup() {


        const Deleteshops = (id)=>{
               
                if (confirm('Are you sure you want to delete this ?')) {
                                 Inertia.delete(route('delete_shop',id))

                }
                    
        }

        return {Deleteshops};
        
    }







}
</script>
