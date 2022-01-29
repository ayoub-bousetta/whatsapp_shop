<template>
    
    <layout class="my-cart" >

           

       <template v-slot:headershop>
           <headShop title="My Cart" />

            
            
        </template>


    <div class="contain">


 <ul v-if="message" class="success">
       <li><p> {{message }}</p></li>
      </ul>


    
   <div class="single_row" v-if=" AllMyCartElements">



        <div v-if="!$page.props.auth.user">


        

        
        <p class="noconencted">You will need to create an account, 
        so the owner can track your order</p>
        
        </div>





















   
    <ul v-if="AllMyCartElements !=[]">
        <li v-for="(cart, index) in AllMyCartElements" :key="index">
        
            <div class="single_shop_row">
            
            
           <span class="title_shop"><b>Shop</b> : {{index.split(',')[0]}}</span>


            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Variants</th>
                        <th>Price</th>
                        <th>Qantity</th>
                        <th></th>
                    </tr>
                </thead>
            
           <tbody>
           
           
            <tr v-for="item in cart" :key="item.id">


            <td>{{item.name}}</td>
            <td class="w-100">
            <ul v-if="item.Variants.length >0">
            <li  v-for="itemvar in item.Variants" :key="itemvar.id">
            
            {{itemvar.name}}
            </li>
            
            </ul>
            
            
            
            </td>
            <td>{{item.price.toFixed(2)}}</td>
             <td>{{item.qty}}</td>
            <td>
                <div class="clalc">
                    {{item.finalprice.toFixed(2)}}
                    <span>{{item.price}} x {{item.qty}} 
                    
                     {{item.Variants.length >0 ?  " + " : ''}}    {{item.Variants.length >0 ?  sumVarprices(item.Variants) : ''}}  {{item.Variants.length >0 ?  " x "+item.qty : ''}}
                     

                    </span>
                </div>
            
            </td>


            <td>  <span @click="delete_from_object(item.id_item)">
                   <i class="material-icons-outlined">
delete_forever
</i>
       </span></td>
            
            
            </tr>
            </tbody>
            <tfoot>
                <tr><td colspan="5">

                   
                
                
                </td>
                <td >
                <span>Total : {{sumTotal.toFixed(2)}} <small>{{currency}}</small></span>
                
                </td>
                </tr>
            </tfoot>


           </table>


           <div class="sendbtn" >
           
           <span class="btn" @click="sendData( index,cart)" v-if="$page.props.auth.user">
       
                <i class="material-icons-outlined">
        whatsapp
        </i>
                <span>Send via whatsApp</span>
           </span>

           <span v-else class="noconencted">Please loggin to complete your order</span>
           </div>

           </div>
        
        </li>
    </ul>

    
   <div class="box_alert info" v-else>
            
       <p>Yep! Still empty  </p>    
        
        </div>
   
   </div>


        <div class="box_alert info" v-else>
          <p>Yep! Still empty  </p>      
              <Link :href="route('Marketplace')">
                    <span>Visit the Marketplace</span>
       </Link>
   
        </div>
    </div>


   
        
  
    </layout>
</template>

<script>
import Layout from '@/Layouts/Front/Shop'
import Crypto from 'crypto-js';
import { Inertia } from '@inertiajs/inertia';
import { computed,watch, ref } from 'vue'
import axios from 'axios';

import { Link,Head } from '@inertiajs/inertia-vue3'
    import InputError from '@/Components/InputError'
import headShop from '@/Components/Front/Shop/head';

export default {

    components: {
        Layout,headShop,InputError,Link
        
    },

   

    setup(props) {


        let message = ref('');



        







     


         let store = window.localStorage.getItem('cartes');

         let existingEntries =ref([])
      


        const groupBy = keys => array =>
        array.reduce((objectsByKeyValue, obj) => {
            const value = keys.map(key => obj[key]).join(',');
            objectsByKeyValue[value] = (objectsByKeyValue[value] || []).concat(obj);
            return objectsByKeyValue;
        }, {});



                   if(store != null){
             
            const bytes = Crypto.AES.decrypt(store, process.env.MIX_KeyToEncrypt);
             existingEntries.value= JSON.parse(bytes.toString(Crypto.enc.Utf8)) || [];
         }



           


            
            
         
          

            const AllMyCartElements = computed(() =>{

                  if( existingEntries.value.length >0){


                const   groupByShopName = groupBy(['shop_name','shop_id']);

                        return groupByShopName( existingEntries.value)

                       }else{
                         return   "";
                       }



           


            }
            
            
            )


          
         



       const sumVarprices = (Variants) => computed(() => Variants.reduce((partial_sum, a) => partial_sum + a.price, 0)  
       
       )


           const sumTotal = computed(() => existingEntries.value.reduce((partial_sum, a) => partial_sum + a.finalprice, 0)  
       
       )

  const currency = (typeof existingEntries.value[0] !== 'undefined') ? existingEntries.value[0].shop_currency :"";



   //send data

        const sendData =(id,items)=> {




            axios.post(route('send_via_watsp'), {'id':id.split(',')[1],'cnt':items})
            .then(res =>{

            
existingEntries.value=existingEntries.value.filter(x => !items.find(y => (y.id_item == x.id_item )));

                 if(existingEntries.value.length >0){

        const envryptedObject =  Crypto.AES.encrypt(JSON.stringify(existingEntries.value),process.env.MIX_KeyToEncrypt);

    window.localStorage.setItem('cartes',  envryptedObject.toString())
                 }else{
                      window.localStorage.removeItem('cartes');    
                 }
           

           

                message.value="Order submited successfully"

              return window.open(res.data, "_blank");
                } )
            };



const delete_from_object=(id)=>{



existingEntries.value=existingEntries.value.filter(x => x.id_item != id )

                 if(existingEntries.value.length >0){

        const envryptedObject =  Crypto.AES.encrypt(JSON.stringify(existingEntries.value),process.env.MIX_KeyToEncrypt);

    window.localStorage.setItem('cartes',  envryptedObject.toString())
                 }else{
                      window.localStorage.removeItem('cartes');    
                 }
         


}
       
            return {delete_from_object,AllMyCartElements,sumVarprices,sumTotal,currency,sendData,message}

        
    

    }
    
}
</script>