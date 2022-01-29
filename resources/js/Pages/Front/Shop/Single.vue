<template>
    <layout :itemTotal="cartItems">
        <template v-slot:headershop>
            <headShop :medias="Shop.medias" />

            
            
        </template>




    <main class="singnle_product" >


    <div class="pull_singnle">
    

            <div class="pull-left">

              <div class="thumb" v-show="CoverMedias == '' ">
                      <Thumbnail  :media="products.medias" :shopid="products.shop_id" />
                             
               </div>

                 <div class="slide" v-if="CoverMedias != '' ">
                             <Sliders 
                              :media="CoverMedias"
                               :shopid="products.shop_id" />
                             
               </div>
            
            </div>


            <div class="pull-right">

                <span class="categories"><Link>{{products.section.name}}</Link> </span>

                <div class="info_product">

                <div class="head_single">

                <div class="title">
                  <h1>{{products.name}}</h1>
                </div>
                <div class="likes">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="css-1iv78ft"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.793 5.707a3.95 3.95 0 00-5.585 0L12 7.914 9.793 5.707a3.95 3.95 0 00-5.585 5.586L12 19.086l7.792-7.793a3.95 3.95 0 000-5.586zm-7-1.414a5.95 5.95 0 018.415 8.414L12 21.914l-9.208-9.207a5.95 5.95 0 018.415-8.414l.793.793.792-.793z" fill="currentColor"></path></svg>
                    <span>69</span>
                </div>
                
                
                
                </div>


                      

                        <div class="summry" v-html="products.description"></div>
                        
                        <Detaillist :productId="products.id" :shopId="products.shop_id" />
                        <Variants @AddremoveAmount="AddremoveAmount" :productId="products.id"
                         :shopId="products.shop_id"
                         :showvalInit="showvalInit" />
                        

                        
                        <div class="cart">


                        <div class="info_price">

                           <span class="price"> {{prix_unit.toFixed(2)}} <small>{{Shop.currency.symbole}}</small></span>




                          <div class="input_qty">



                            <span @click='removeQty'><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 640 640" class="input-spinner__icon input-spinner__icon--minus"><path d="M512 320c0 17.696-1.536 32-19.232 32h-345.536c-17.664 0-19.232-14.304-19.232-32s1.568-32 19.232-32h345.568c17.664 0 19.2 14.304 19.2 32z"></path></svg></span>
                            <input v-model='qty' type="text">
                            <span @click='addQty'><svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 768 768" class="input-spinner__icon input-spinner__icon--plus"><path d="M607.5 415.5h-192v192h-63v-192h-192v-63h192v-192h63v192h192v63z"></path></svg></span>
                            
                        </div>
                        
                        
                        
                        </div>

                        <div v-if="holderVal.length > 0" class="info_recap">

                      
                        <ul>

                        
                        <li v-for="(item, index) in holderVal" :key="index">
                            <span>{{ item.name }}</span>
                            <span>{{ item.price.toFixed(2) }} x <small>{{ qty }}</small></span>
                            <span>{{ (item.price * qty).toFixed(2) }} </span>
                        </li>

                        <li >
                            <span>Initial price</span>
                            <span>{{ products.unit_price.toFixed(2) }} x <small>{{ qty }}</small></span>
                            <span>{{ (products.unit_price * qty).toFixed(2) }} </span>
                        </li>
                        
                        </ul>



                        
                        
                        </div>


                        


                         <div class="addtocard">
                            <button class="btn" @click='AddTosession'>Add to card</button>
                        
                        </div>


                       


                       
                        
                        
                        </div>
                       
                
                </div>


            
            
            </div>




    </div>





    </main>














        
    </layout>
</template>

<script>

import headShop from '@/Components/Front/Shop/head'

import Detaillist from '@/Components/Front/Shop/Datails'
import Layout from '@/Layouts/Front/Shop'
import { computed, ref } from '@vue/reactivity'

import Variants from '@/Components/Front/Shop/Variants'

import Sliders from '@/Components/Front/Shop/Sliders'
import Thumbnail from '@/Components/Front/Shop/Thumbnail'

import { Link,Head } from '@inertiajs/inertia-vue3'

import Crypto from 'crypto-js';
import { v4 as uuidv4 } from 'uuid';


export default {


    props:{
        Shop:'',
        products : '',


    },
    
    components: {
        headShop,Layout ,Thumbnail,Sliders,Variants,Detaillist,
        Link
    },


      setup(props) {
        
let showvalInit =ref({toClean:false})
        let qty =ref(1)
        let prix_unit =ref(props.products.unit_price)
        let realprice = ref(props.products.unit_price)
let holderVal= ref([]);

let HoldSum= ref(0);

 let cartItems= ref({action:''})

        const addQty = ()=> {

          
            if(qty.value >=1 ){
                 qty.value++
                 prix_unit.value = (realprice.value + HoldSum.value  ) * qty.value
            }
        }
        const removeQty = ()=> {


            if(qty.value >1 ){
                 qty.value--
                  prix_unit.value =(realprice.value + HoldSum.value  ) * qty.value
            }
        }



 const CoverMedias = computed(() => props.products.medias.filter(image => image.mediazonetype.slug == 'cover'))



const AddremoveAmount=(amount,action,name)=>{

    if(action =="add"){

         // prix_unit.value =  prix_unit.value  + (amount * qty.value )
           holderVal.value.push({
               'name':name,
               'price':amount
           } ) 


           


           HoldSum.value=_.sumBy(holderVal.value, function(o) { return o.price; })
          
      

    }else{

          holderVal.value = _.remove(holderVal.value, function(n) { return n.name!=name});
          HoldSum.value=_.sumBy(holderVal.value, function(o) { return o.price; })

                 

    }


    console.log(HoldSum.value)


        prix_unit.value = (realprice.value +  HoldSum.value) * qty.value
     


}


    const AddTosession = ()=>{

        
        cartItems.value.action =""
        showvalInit.value.toClean=false
         let shopInofId =props.products.name;
         let dataTocart = [];



        dataTocart=
         {
               'id' : props.products.id,
               'id_item':uuidv4(),
         
            'name':props.products.name,
            'price':props.products.unit_price,
            'Variants':holderVal.value,
            'qty': qty.value,
                'finalprice': prix_unit.value,
                'shop_id' : props.Shop.id,
                'shop_name' : props.Shop.name,
            'shop_currency' :  props.Shop.currency.symbole,
                


            }
          


        
        
          
        

        holderVal.value=[]
        qty.value=1
        showvalInit.value.toClean=true
        prix_unit.value=props.products.unit_price


        

         const store = window.localStorage.getItem('cartes');
          let existingEntries =[];

          

         if(store != null){
             
        const bytes = Crypto.AES.decrypt(store, process.env.MIX_KeyToEncrypt);
            existingEntries  = JSON.parse(bytes.toString(Crypto.enc.Utf8)) || [];

         }
         

        

         existingEntries.push(dataTocart);




        cartItems.value.action ="add"



       



        

        const envryptedObject =  Crypto.AES.encrypt(JSON.stringify(existingEntries),process.env.MIX_KeyToEncrypt);
       
         window.localStorage.setItem('cartes',  envryptedObject.toString())

     

        
      

    }


   
  
  


  


        return {
            addQty,removeQty,qty,CoverMedias,AddremoveAmount,prix_unit,holderVal,qty,AddTosession,
            showvalInit,cartItems
        }





    }

}
</script>
