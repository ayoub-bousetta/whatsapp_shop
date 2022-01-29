<template>
  
        
     


<form @submit.prevent="submit" class="update_profile ">

  
 <div class=" inputs_box">
 <div class="other_inputs">
                    <div class="inputs">
                     <div class="input">
              <label for="fname">First Name</label>
            <BreezeInput id="fname" type="text"  v-model="form.profiles.fname" required autofocus autocomplete="fname" />
        </div>

         <div class="input">
              <label for="name">Last Name</label>
            <BreezeInput id="name" type="text"  v-model="form.profiles.name" required autofocus autocomplete="name" />
        </div>
                    
                    </div>
       
   <div class="inputs">

    <div class="input">
              <label for="email">Email</label>
            <BreezeInput id="email" type="email"  v-model="form.email" required autocomplete="email" />
        </div>

         <div class="input">
              <label for="phone">Phone</label>
          
   <vue-tel-input  v-model="form.profiles.phone" mode="international"></vue-tel-input>

        </div>
   
   </div>

      <div class="btn">
            <BreezeButton   :disabled="form.processing" @click="submitDataProfile()">
              <span>Update your profile</span>

                        <i class="material-icons-outlined">
                            arrow_right_alt
                        </i>
            </BreezeButton>
            </div>
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
    props: {
 
        profile: Object,

    },

    components:{
        Link,Head,BreezeButton,BreezeInput,BreezeLabel,VueTelInput,InputErrors
    },

 
    setup(props) {



      const form= reactive({
                
                email: props.profile.email,
                profiles:{
                    phone: props.profile.profile.phone,
                    name:props.profile.profile.name,
                    fname:props.profile.profile.fname,

                }
            })



        const submitDataProfile=()=>{

         

           Inertia.patch(route('edit_profile'),form)

        }
     


            return {form,submitDataProfile}


      
        
    }







}
</script>
