<template>



<div class="section" v-bind:class="{ active: isActive }">

     <form @submit.prevent="submit">


       <i class="material-icons-outlined" @click="closeit">
close
</i>

            <div class="inputs"><Label  for="name">
           
            Name   </Label>
            <Input v-if="sectioninfo &&  update.value==true " 
            id="name" v-model="formData.value.name" placeholder='Tiddtle' />
            
             <Input v-else id="name" v-model="formData.name" placeholder='Title' />

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
import { reactive,isRef,ref,watchEffect } from 'vue'
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


    let update =ref(false);




if(props.sectioninfo && !_.isEmpty(props.sectioninfo) && typeof props.sectioninfo.id !== 'undefined'){


     formData.value =props.sectioninfo
     update.value=true

}else{


     formData =reactive({name:null});
}
       

  
  
  watchEffect(() => {

  

    
             formData.value =props.sectioninfo

      
            



  
      
    
       
    })
  

    const submit=()=> {

     if(!_.isEmpty(props.sectioninfo) && typeof props.sectioninfo.id !== 'undefined'){
      Inertia.patch(route('edit_section',{idShop:props.Shopinfo.id,slugShop:props.Shopinfo.slug,sectionid:formData.value.id}), formData.value)

     }else{

       let datainfo =ref();

       if(_.isEmpty(formData.value)){

              datainfo.value={
                name : formData.name
              }
       }else{

         datainfo.value=formData.value
         
       }



    
        
 Inertia.post(route('create_section',{idShop:props.Shopinfo.id,slugShop:props.Shopinfo.slug}),  datainfo.value)

     }

    

    }


  
 const closeit=()=> {
 
       if(props.sectioninfo != ""){

         formData.value = ""
       }else{
          formData =reactive({name:null});
       }
   
      context.emit('isActiveit',false);
    }

  

    return { formData, submit,closeit ,update}
  },





  

  


    



}
</script>