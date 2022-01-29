<template>








<div>


  <InputErrors :messages="errors"  />
            <form @submit.prevent="submit">

            <Label  for="name">
           
            Name
            <Input id="name" v-model="form.name" placeholder='Title' />


    

            </Label>
<Label  for="Country">

   <SelectInput id="name" v-model="form.country_id" label="Country">
            <option :value="null" />
            <option v-for="country in countries" :value="country.id" :key='country.id'>{{country.name}}</option>
          </SelectInput>
          </Label>

            <Button type="submit">Add Role</Button>

            
             </form>




   
    </div>
</template>
  


<script>
  import Input from '@/Components/Input'
  import Label from '@/Components/Label'
  import Button from '@/Components/Button'
    import SelectInput from '@/Components/SelectInput'
    import InputErrors from '@/Components/InputErrors'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {


  props: {
    errors: Object,
    countries : Object
    
  },

  components:{
          Input,
          Label,Button,InputErrors,SelectInput
  },

  
  setup (props) {
    const form = reactive({
      name: null,
      country_id:null
    })

   const submit=()=> {
      Inertia.post(route('create_city'), form)
    }

    return { form, submit }
  },





  

  


    



}
</script>