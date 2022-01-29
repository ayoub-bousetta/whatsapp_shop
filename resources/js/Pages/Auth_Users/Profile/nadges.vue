<template>
  

  <div >

  <Formheader typepage="noBtn" textheader="My Profile" 
  :currentbadg="profile.roles"   />
  <InputErrors v-if="errors" :messages="errors"  />



<div class="profile_inputs">
 <ul v-if="flash && flash.success" class="success">
       <li><p> {{flash.success }}</p></li>
      </ul>
 


<UpdateProfle  :profile='profile' />

<UpdatePassword  />

</div>

     </div>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import UpdateProfle from '@/Pages/Auth_Users/Profile/updateProfile'
import UpdatePassword from '@/Pages/Auth_Users/Profile/updatePassword'
    import InputErrors from '@/Components/InputErrors'
import { Link,Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Layouts/Dashboard'
  import { VueTelInput } from 'vue-tel-input';
  import 'vue-tel-input/dist/vue-tel-input.css';

import Formheader from '@/Components/Elementspage/headerForm.vue'
export default {
    props: {
     profile: Object,
        flash: Object,
        errors: Object,

    },

    components:{UpdateProfle,UpdatePassword,Formheader,
        Link,Head,BreezeButton,BreezeInput,BreezeLabel,VueTelInput,InputErrors
    },

   layout: Layout,
    setup(props) {




      
        
    }







}
</script>
