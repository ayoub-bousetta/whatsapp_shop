<template>



<div class="section" v-bind:class="{ active: isActive }">

     <form @submit.prevent="submit">


      {{formData}}
       <i class="material-icons-outlined" @click="closeit">
close
</i>

            <div class="inputs"><Label  for="name">
           
            Name   </Label>
            <Input id="name" v-model="formData.name" placeholder='Title' />
         </div>
         
<div class="btn">
            <Button type="submit">Add Category</Button></div>

            
             </form>


   
    </div>
</template>
  


<script>
  import Input from '@/Components/Input'
  import Label from '@/Components/Label'
  import Button from '@/Components/Button'
    import InputError from '@/Components/InputError'
import { reactive,ref,watchEffect } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {


  props: {
    errors: Object,
 
    Shopinfo:'',
    sectioninfo:Object,
    isActive:false
    
  },

  components:{
          Input,
          Label,Button,InputError
  },

  
  setup (props,context) {
    let formData =ref();


  


if(props.sectioninfo ){

     formData.value =props.sectioninfo

}else{
    formData = ref({
      name: null,
    })
}
       

  


     
  
  watchEffect(() => {
       formData.value =props.sectioninfo
    })
  

    const submit=()=> {

     if(props.sectioninfo != ""){
      Inertia.patch(route('edit_section',{idShop:props.Shopinfo.id,slugShop:props.Shopinfo.slug,sectionid:props.sectioninfo.id}), formData)

     }else{
      Inertia.post(route('create_section',{idShop:props.Shopinfo.id,slugShop:props.Shopinfo.slug}), formData)

     }

    

    }


  
 const closeit=()=> {
     formData.name =""
   
      context.emit('isActiveit',false);
    }

  

    return { formData, submit,closeit }
  },





  

  


    



}
</script>