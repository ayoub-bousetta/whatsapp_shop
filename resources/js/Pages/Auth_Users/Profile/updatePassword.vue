<template>
  

  

<form @submit.prevent="submit" class="update_password ">

 <div class=" inputs_box">
     <div class="inputs">
      <div class="input">
              <label for="password">New Password</label>
            <BreezeInput id="password" type="password"  v-model="form.password" required autocomplete="new-password" />
        </div>

       <div class="input">
        <label for="password_confirmation">Confirm Password</label>
            <BreezeInput id="password_confirmation" type="password"  v-model="form.password_confirmation" required autocomplete="new-password" />
        </div>
 </div>
           <div class="btn">
            <BreezeButton    @click="submitData()">
              <span>Update your password</span>

                        <i class="material-icons-outlined">
                            arrow_right_alt
                        </i>
            </BreezeButton>
            </div>

    
</div>
         </form>
</template>


<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'

    import InputErrors from '@/Components/InputErrors'
import { Link,Head } from '@inertiajs/inertia-vue3'
import { reactive } from 'vue'
  import { VueTelInput } from 'vue-tel-input';
  import 'vue-tel-input/dist/vue-tel-input.css';
import { Inertia } from '@inertiajs/inertia'

export default {
    
    components:{
        Link,Head,BreezeButton,BreezeInput,BreezeLabel,VueTelInput,InputErrors
    },

 
    setup() {



      const form= reactive({
                
                password: '',
                password_confirmation: '',
                terms: false,
             
            })



        const submitData=()=>{


            console.log('dfg')

            let params ={password:form.password,password_confirmation:form.password_confirmation}


           Inertia.patch(route('edit_password'),params)

        }
     


            return {form,submitData}


      
        
    }







}
</script>
