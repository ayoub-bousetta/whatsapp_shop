<template>








<div>


  <InputErrors :messages="errors"  />
            <form @submit.prevent="submit">

            <Label  for="name">
           
            Name
            <Input id="name" v-model="form.name" placeholder='Title' />
            </Label>
         

            <Button type="submit">Add Role</Button>

            
             </form>




   
    </div>
</template>
  


<script>
  import Input from '@/Components/Input'
  import Label from '@/Components/Label'
  import Button from '@/Components/Button'
    import InputErrors from '@/Components/InputErrors'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {


  props: {
    errors: Object,
    
  },

  components:{
          Input,
          Label,Button,InputErrors
  },

  
  setup () {
    const form = reactive({
      name: null,
    })

   const submit=()=> {
      Inertia.post(route('create_country'), form)
    }

    return { form, submit }
  },





  

  


    



}
</script>