<template>
   <div class="tables">
 
 
<table>
      <thead>
            <tr>
            <th>Name</th>
            <th>Status</th>

            <th>Category</th>
            <th></th>
        </tr>
   </thead>

   <tbody>
    <tr v-for="product in products" :key="product.id">
        <td>{{product.name}}</td>
        <td>  <span class="status  fade" :class="{'complete':product.online == 1,'waiting':product.online == 0}">
      
      </span></td>
         <td>{{product.section ? product.section.name : "-"}}</td>
           <td class="links">

    <Link class="alink" :href="route('edit_product',
    {idShop:ShopId,slugShop:ShopSlug, product:product })"> <i class="material-icons-outlined">
brush
</i></Link>


         <span class="alink" @click="deleteProduct(product)"> <i class="material-icons-outlined">
delete
</i></span>
           
         </td>
    </tr>
   </tbody>
   


    
    
    </table>



    </div>
</template>


<script>
import { Link,Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia';
export default {



        props:{
            products:Object,
            ShopId:0,
            ShopSlug:""
        },

       
    components:{
        Link
    },


    setup(props) {

           const deleteProduct = (id)=>{
               
                if (confirm('Are you sure you want to delete this ?')) {
           Inertia.delete(route('delete_product',
           {idShop:props.ShopId,slugShop:props.ShopSlug,product:id }))

                }

    
             }

             

                
               return {deleteProduct}    

     
        
    }


}
</script>