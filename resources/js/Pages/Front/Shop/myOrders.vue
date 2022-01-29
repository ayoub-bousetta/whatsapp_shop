<template>
    
    <layout class="my-cart" >

           

       <template v-slot:headershop>
           <headShop title="My Orders" />

            
            
        </template>


    <div class="contain">




    
   <div class="single_row" v-if=" orders && orders.length >0">



        <div v-if="!$page.props.auth.user">


        

        
        <p>You will need to create an account, 
        so the owner can track your order</p>
        
        </div>
          <div class="single_shop_row" v-if=" orders.length >0">

         <table>
                <thead>
                    <tr><th>Shop name</th>
                        <th>Name</th>
                        <th>Variants</th>
                        <th>Price</th>
                        <th>Qantity</th>
                        <th>Total</th>
                        <th>Order status</th>
                    </tr>
                </thead>
            
           <tbody>
           
           
            <tr v-for="item in orders" :key="item.id">




            <td class="cap">{{item.shop.name}}</td>
            <td>{{item.name}}</td>
            <td class="w-100">
            <ul v-if="item.data.length >0">
            <li  v-for="itemvar in JSON.parse(item.data).variants" :key="itemvar.id">
            
            {{itemvar.name}}
            </li>
            
            </ul>
            
            
            </td>
            <td>{{item.unit_price.toFixed(2)}}</td>
             <td>{{item.qty}}</td>
            <td>
                <div class="clalc">
                    {{item.subtotal.toFixed(2)}}

                    <span>{{item.unit_price}} x {{item.qty}} 
                    
                     {{JSON.parse(item.data).variants ?  " + " : ''}}    {{JSON.parse(item.data).variants ?  sumVarprices(JSON.parse(item.data).variants) : ''}}  {{JSON.parse(item.data).variants ?  " x "+item.qty : ''}}
                     

                    </span>
                    
                </div>
            
            </td>
            <td class="cap">{{item.status.name}}</td>
            
            
            </tr>
            </tbody>
           


           </table>

</div>



















   
<div class="box_alert info" v-else>
             <p>Yep! Empty like my life </p>    
              <Link :href="route('Marketplace')">
                    <span>Visit the Marketplace</span>
       </Link>
   
        </div>

    
 
   
   </div>


        <div class="box_alert info" v-else>
             <p>Yep! Empty like my life </p>    
              <Link :href="route('Marketplace')">
                    <span>Visit the Marketplace</span>
       </Link>
   
        </div>
    </div>


   
        
  
    </layout>
</template>

<script>
import Layout from '@/Layouts/Front/Shop'


import { Link,Head } from '@inertiajs/inertia-vue3'
import headShop from '@/Components/Front/Shop/head';

import { computed,watch, ref } from 'vue'
export default {

    props:{
        orders:Object,
    },

    components: {
        Layout,headShop,Link
        
    },

   

    setup(props) {
    

       const sumVarprices = (datavars) => computed(() => datavars.reduce((partial_sum, a) => partial_sum + a.price, 0))

       return   {sumVarprices}

    }
    
}
</script>