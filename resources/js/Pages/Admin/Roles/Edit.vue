<template>

<div>
 
            
            <form @submit.prevent="submit">

            <Label  for="name">
           
            Name
            <Input id="name" v-model="form.name" placeholder='Title' />
            </Label>
            <br>

            <Button type="submit">Add Role</Button>

            
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
    role:Object
    
  },




    components:{
          Input,
          Label,Button
      },

    
  setup (props) {
      const form = reactive(props.role)


      const submit=()=> {
        Inertia.patch(route('edit_role',props.role.id), form)
      }

      

      return { form, submit }
    },




  




}
</script>