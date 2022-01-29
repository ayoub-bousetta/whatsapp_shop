<template>

    <Head title="Register" />

<Layout>
  <div class="warp-form onlyform">
    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
     <div class="make_sure">
                    <span class="visiting_link_text">Please make sure you are visiting</span>
                    <h6 class="visiting_link"><span style="vertical-align: text-bottom;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-10 0 51 44" width="30" height="26"><g fill-rule="evenodd" clip-rule="evenodd"><path d="M25.4 13.5c-1.2 0-2.3.5-3.1 1.4-.8.9-1.1 1.9-.9 3.1h8c.2-1.2-.2-2.2-1-3.1-.6-.9-1.8-1.4-3-1.4zm7 19.5H18.6c-1.3 0-2.1-1.6-2.1-2.9v-9.5c0-.6.3-1.3.7-1.7.4-.4 1.1-.7 1.7-.7 0-.2-.1-.4-.1-.6 0-3.6 2.9-6.5 6.6-6.5 3.6 0 6.6 2.9 6.6 6.5 0 .2 0 .4-.1.6h.1c1.3 0 2.4 1.1 2.4 2.4V30c0 1.3-1.1 2.4-2.4 2.4l.4.6z" fill="#26999e"></path><path d="M23.5 23c0 .7.4 1.4 1 1.7V30h2v-5.3c.6-.4 1-1 1-1.7 0-1.1-.9-2-2-2s-2 .9-2 2z" fill="#002b29"></path></g></svg><span id="this_link">
                    <span class="text-https"></span>{{ $page.props.Appurl }}</span></span></h6>
                    </div>

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



 <div class="inputs">

    <div class="input">
              <label for="adresse">Adresse</label>
            <BreezeInput id="adresse" type="text"  v-model="form.adresse.adresse" required  />
        </div>

         <div class="input">
              <label for="zipcode">Zip Code</label>
            <BreezeInput id="zipcode" type="text"  v-model="form.adresse.zip_code" required  />
        </div>

   
   </div>

  
 <div class="inputs">

    <div class="input">
           
       
                            <SelectInput id="city" v-model="form.adresse.city_id"  label="City">
                                <option :value="null" />
                                <option v-for="city in cities" :value="city.id"
                                :key='city.id'>{{city.name}} </option>
                            </SelectInput>
     
        </div>

     

   
   </div>


     <div class="plans">
    <div class="title">Who are you ?</div>
    <div class="container">
     <label v-for="(role, index) in roles" :key="role.id" class="plan"  :for="role.slug">
      <input type="radio" v-model="form.roles.id"  :value="role.id" :id="role.slug" />
      <div class="plan-content">
        <div class="plan-details">
          <span>{{role.name}}</span>
          <p>{{role.description}} </p>
        </div>
      </div>
    </label>

  
    </div>
   
  </div>
     

        <div class="input">
              <label for="password">Password</label>
            <BreezeInput id="password" type="password"  v-model="form.password" required autocomplete="new-password" />
        </div>

       <div class="input">
        <label for="password_confirmation">Confirm Password</label>
            <BreezeInput id="password_confirmation" type="password"  v-model="form.password_confirmation" required autocomplete="new-password" />
        </div>

          

         
             <div class="btn">
            <BreezeButton   :disabled="form.processing">
              <span>Create my account</span>

                        <i class="material-icons-outlined">
                            arrow_right_alt
                        </i>
            </BreezeButton>
            </div>
             <div class="link-to"><span> Already registered? </span>
                    <Link :href="route('login')">Sign ip </Link></div>
       
    </form>


</div>
    
</Layout>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
  import { VueTelInput } from 'vue-tel-input';
  import 'vue-tel-input/dist/vue-tel-input.css';
import { Head, Link } from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/Front/Login'
import SelectInput from '@/Components/SelectInput.vue';
export default {

    props:{
        roles:Object,
        cities:Object,
    },
    components: {
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
    Head,
    VueTelInput,
    Link,
    Layout,
    SelectInput
},

    data() {
        return {


            
            form: this.$inertia.form({
                
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
                roles:{
                    id:'',
                },
                adresse:{
                    adresse:'',
                     zip_code: '',
                    city_id:''
                },
                profiles:{
                    phone: '',
                    name: '',
                    fname:''

                }
            })
        }
    },

    

    methods: {
        submit() {



            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        },

    
    },

     
}
</script>


<style>
.vue-tel-input{
    border: 1px dashed #b7bdc6;
}
.vue-tel-input input{
    border: 0px dashed #b7bdc6!important;
    border-left: 1px dashed #b7bdc6!important;
}
.vti__dropdown-list.below {
  
    width: 221px;
    font-size: 12px;
}

.vue-tel-input:focus-within {
    -webkit-box-shadow: unset;
    box-shadow: unset;
    border-color: #b7bdc6;
}
</style>