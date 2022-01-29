<template>


         <div v-show="loading" class="lds-loading"><div></div><div></div><div></div></div>

    <div v-if="dataVariants && dataVariants.length >0" class="Variants">

    <h2><span>Variants</span></h2>
       

        <ul>
            <li v-for="(item, index) in dataVariants" :key="index">
                <div class="box">
                    <span>{{item.name}} </span>
                   
                        <ul v-if="item.options && item.options.length >0">
                            <li v-for="(option, ydex) in item.options" :key="ydex">
                                  
                                        <div class="list-attribute">
                                            <span> {{option.name}}</span>

                                            <span> {{option.additional_amount.toFixed(2)}}</span>

                                            <button  v-if="!showremove.includes(option.id) "  
                                            @click="AddremoveAmount(option.additional_amount,option.id,'add',option.name)">Add</button>
                                             <button class="remove" v-if="showremove.includes(option.id)" 
                                              @click="AddremoveAmount(option.additional_amount,option.id,'remove',option.name)">
                                              <i class="material-icons-outlined">
close
</i></button>

                                        </div>
                                   
                            </li>
                        </ul>

                </div>
            
            </li>
        </ul>

    </div>
</template>


<script>import { ref } from "@vue/reactivity";
import {  watch } from "@vue/runtime-core";
import axios from "axios"

export default {
    props:{
        productId:'',
        shopId:'',
        showvalInit:''
    },

emits:['AddremoveAmount'],
    setup(props,context) {


     


        let dataVariants =ref([]);
        let loading =ref(false);
        let showremove =ref([]);
          
        axios.get(route('_getVariants_products',{shopid:props.shopId,product_id:props.productId})).then(res=>{
             loading.value = true;
            dataVariants.value = res.data



           

        }).then(dat=>{
            loading.value = false;


        })

        const AddremoveAmount =(amount,optionId,action,name)=>{
            

            if(action=="add"){
                showremove.value.push(optionId);
               
            }else{

                    

                     _.remove(showremove.value, function(n) { return n==optionId});
                    



            }

             context.emit('AddremoveAmount',amount,action,name)
                

        }


watch(props.showvalInit, () => {


        if(props.showvalInit.toClean){
        showremove.value=[]

        }


})


          
        return {dataVariants,loading,AddremoveAmount,showremove}
        
    }


}
</script>