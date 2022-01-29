<template>

<div>
 
            
            <form @submit.prevent="submit">

            <Label  for="name">
           
            Name
            <Input id="name" v-model="form.name" placeholder='Title' />
            </Label>
            
<Label  for="Country">

   <SelectInput id="name" v-model="form.country_id" label="Country">
            <option :value="null" />
           
            <option   
             v-for="country in countries" :value="country.id" :key='country.id' 
          
             >{{country.name}}</option>
          </SelectInput>



          
          </Label>

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
    import SelectInput from '@/Components/SelectInput'

export default {


  props: {
    errors: Object,
    city:Object,
        countries : Object,
        
    
  },




    components:{
          Input,
          Label,Button,SelectInput
      },

    
  setup (props) {
      const form = reactive(props.city)
      const countries=props.countries






      const submit=()=> {
        Inertia.patch(route('edit_city',props.city.id), form)
      }

      

      return { form, submit,countries }
    },




  




}
</script>