<template>




<div class="variant">
  
    <span class="addbtn" @click="addVariant">
    
   <span class="material-icons-outlined">
bookmark_add
</span>

        
    
    Add Variants</span>


    <ul class="variantbox">

    <li v-for="(inputsVar, k) in variant" :key="k">
       <div class="inputs flex_inputs line">
      <input type="text" class="form-control" v-model="inputsVar.name" />
            <span class="warp_action">
              <i
                class="fas fa-minus-circle"
                @click="removeVariantInput(k,inputsVar.id,inputsVar.product_id)"
                v-show="k || ( !k && variant.length > 0)"
              ><span class="material-icons-outlined">
remove_circle_outline
</span>
</i>
              <i
                class="fas fa-plus-circle"
                @click="addVariantInput(k)"
                v-show="k == variant.length-1"
              >
<span class="material-icons-outlined">
add_circle_outline
</span></i>
            </span>
       
</div>
            <Options  :variationoption='inputsVar' :edit="editme"  />

    </li>

    
    </ul>
  
  </div>
</template>
  


<script>
/* eslint-disable no-undef */


import { reactive,ref } from 'vue'
import Options from '@/Components/Products/sections/options'
//Maps



export default {


  props: {
    variantsdata: Object,
    editme:false,
    errors:Object,
  
    
  },


  components:{
          Options
  },


  

  setup (props) {
 
 let variant;

if(props.editme && props.variantsdata){

   variant=reactive(props.variantsdata);
   variant= props.variantsdata
}else{

   variant=reactive([]);
    variant=props.variantsdata.variants
}



  


    


    const addVariant=()=> {
     

      variant.push({
              name: '',
            })


    };

const addVariantInput=(index)=> {
      
          variant.push({
              name: '',
            })
      };




       const removeVariantInput=(z,index,product_id)=> {


        


          

         if(index && product_id){
            if (confirm('Are you sure you want to delete this ?')) {
              axios.post(route('delete_variants',{product_id:product_id,
              varid:index})).then(res=>{

                  if(res.data.success){
                      variant.splice(z, 1)
                      props.errors = {'message':res.data.success}
                  }else{

                      props.errors = {'message':res.data.errors}
                    
                  }

                    
                
              }).catch((error) => {
              props.errors = {'message':error.message}
              });
            }
           

         }else{

             variant.splice(z, 1)
         }

         
        
        
      };



 

   
    

    return { addVariant,variant,removeVariantInput, addVariantInput}
  },





  

  


    



}
</script>