<template>


         <div v-show="loading" class="lds-loading"><div></div><div></div><div></div></div>

    <div v-if="dataVariants && dataVariants.length >0" class="details">

       <h3><span>Details</span></h3>
       

        <ul>
            <li v-for="(item, index) in dataVariants" :key="index">
                <div class="box">
                    <span>{{item.attribute}} : </span>
                                        <span>{{item.value}}</span>

                </div>
            
            </li>
        </ul>
    </div>
</template>


<script>import { ref } from "@vue/reactivity";
import axios from "axios"

export default {
    props:{
        productId:'',
        shopId:''
    },


    setup(props) {


        let dataVariants =ref([]);
        let loading =ref(false);

        axios.get(route('_getDetails_products',{shopid:props.shopId,product_id:props.productId})).then(res=>{
             loading.value = true;
            dataVariants.value = res.data



           

        }).then(dat=>{
            loading.value = false;


        })

          
        return {dataVariants,loading}
        
    }


}
</script>