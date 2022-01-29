<template>




<div class="options">
  



    <ul class="optionbox">



    <li v-for="(inputsOpt, i) in inputsOption" :key="i">

    <div class="inputs flex_inputs line2">
    <input type="text" v-model="inputsOpt.name" />
      <input type="text" v-model="inputsOpt.additional_amount" />
            <span class="warp_action">
              <i
                class="fas fa-minus-circle"
        
                @click="removeOptionInput(i,inputsOpt.id,inputsOpt.variant_id)"

                v-show="i || ( !i && inputsOption.length > 0)"
              ><span class="material-icons-outlined">
remove_circle
</span></i>
              <i
                class="fas fa-plus-circle"
                @click="addOptionInput(i)"
                v-show="i == inputsOption.length-1"
              ><span class="material-icons-outlined">
add_circle
</span></i>
            </span>
    </div>
    
      
    </li>

    
    </ul>

        <div @click="addOption" class="add_options">
        <i class="material-icons-outlined">
tune
</i>
<span>Add Option</span></div>
  
  </div>
</template>
  


<script>
/* eslint-disable no-undef */

  import Input from '@/Components/Input'
  import Label from '@/Components/Label'
  import Button from '@/Components/Button'

import { reactive,ref } from 'vue'

//Maps



export default {


  props: {
    variationoption:Object,
    edit:false

  
    
  },




  

  setup (props) {

    let inputsOption;


if(props.edit && props.variationoption.options){
        inputsOption = reactive(props.variationoption.options)

}else{
      inputsOption = reactive([])

}
      

 props.variationoption.options=inputsOption


    const addOption=()=> {
     

      inputsOption.push({
              name: '',
              additional_amount:0
      
             
              }
            )


    };

const addOptionInput=(index)=> {
      
          inputsOption.push({
              name: '',
              additional_amount:0
      
              
            })
      };


    


      const removeOptionInput=(z,index,product_id)=> {


        

console.log(z)
console.log(product_id)
console.log(index)
          

         if(index && product_id){

           if (confirm('Are you sure you want to delete this ?')) {
                axios.post(route('delete_options',{product_id:product_id,
                optid:index})).then(res=>{

                    if(res.data.success){
                        inputsOption.splice(z, 1)
                        props.errors = {'message':res.data.success}
                    }else{

                        props.errors = {'message':res.data.errors}
                      
                    }

                      
                  
                }).catch((error) => {
                props.errors = {'message':error.message}
                });

            }
           

         }else{

             inputsOption.splice(z, 1)
         }

         
        
        
      };

 

   
    

    return { addOption,inputsOption,removeOptionInput, addOptionInput}
  },





  

  


    



}
</script>