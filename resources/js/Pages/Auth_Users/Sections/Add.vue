<template>







 <form @submit.prevent="submit">


<Formheader  

:Shopinfo="{

 
  online:false,


}"


 textheader="Create your online store"   />


<div class="inside_box split">




 <div class="pull-left-inside inputs_box">

  


            <div class="inputs"><Label  for="name">
           
            Name   </Label>
            <Input id="name" v-model="form.name" placeholder='Title' />
         </div>
         
<div class="btn">
            <Button type="submit">Add Category</Button></div>

            
           

  
    </div>
   
    </div>

    </form>  
</template>
  


<script>
  import Input from '@/Components/Input'
  import Label from '@/Components/Label'
  import Button from '@/Components/Button'
    import InputError from '@/Components/InputError'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import Layout from '@/Layouts/Dashboard'
import Formheader from '@/Components/Elementspage/headerForm.vue'
export default {


  props: {
    errors: Object,
   
    Shopinfo:'',
    isActive:false
    
  },
 layout: Layout,
  components:{
          Input,
          Label,Button,InputError
  },

  
  setup (props,context) {
    const form = reactive({
      name: null,
    })

   const submit=()=> {
      Inertia.post(route('create_section',{idShop:props.shop.shopid,slugShop:props.shop.slugShop}), form)

      if(props.flash){

          console.log('dfsdf')


      }

    }

 const closeit=()=> {
     form.name =""
   
      context.emit('isActiveit',false);
    }

  

    return { form, submit,closeit }
  },





  

  


    



}
</script>