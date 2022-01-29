<template>

<div>
 
            
            <form @submit.prevent="submit">

            <Label  for="name">
           
            Name
            <Input id="name" v-model="form.name" placeholder='Title' />
            </Label>
            <br>

            <Button type="submit">Edit Country</Button>

            
             </form>



</div>

   
</template>



<script >
  import Input from '@/Components/Input'
  import Label from '@/Components/Label'
  import Button from '@/Components/Button'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {


  props: {
    errors: Object,
    country:Object
    
  },




    components:{
          Input,
          Label,Button
      },

    
  setup (props) {
      const form = reactive(props.country)


      const submit=()=> {
        Inertia.patch(route('edit_country',props.country.id), form)
      }

      

      return { form, submit }
    },




  




}
</script>