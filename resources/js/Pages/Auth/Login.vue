<template>
 

<Layout>

    <div class="warp-form onlyform">

    
     <BreezeValidationErrors class="mb-4" />

 
    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">
    
     <div class="make_sure">
                    <span class="visiting_link_text">Please make sure you are visiting</span>
                    <h6 class="visiting_link"><span style="vertical-align: text-bottom;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-10 0 51 44" width="30" height="26"><g fill-rule="evenodd" clip-rule="evenodd"><path d="M25.4 13.5c-1.2 0-2.3.5-3.1 1.4-.8.9-1.1 1.9-.9 3.1h8c.2-1.2-.2-2.2-1-3.1-.6-.9-1.8-1.4-3-1.4zm7 19.5H18.6c-1.3 0-2.1-1.6-2.1-2.9v-9.5c0-.6.3-1.3.7-1.7.4-.4 1.1-.7 1.7-.7 0-.2-.1-.4-.1-.6 0-3.6 2.9-6.5 6.6-6.5 3.6 0 6.6 2.9 6.6 6.5 0 .2 0 .4-.1.6h.1c1.3 0 2.4 1.1 2.4 2.4V30c0 1.3-1.1 2.4-2.4 2.4l.4.6z" fill="#26999e"></path><path d="M23.5 23c0 .7.4 1.4 1 1.7V30h2v-5.3c.6-.4 1-1 1-1.7 0-1.1-.9-2-2-2s-2 .9-2 2z" fill="#002b29"></path></g></svg><span id="this_link">
                    <span class="text-https"></span>{{ $page.props.Appurl }}</span></span></h6>
                    </div>
        <div class="input">
           <label for="email">Email</label>
            <BreezeInput id="email" type="email"  v-model="form.email" required autofocus autocomplete="username" />
        </div>

          <div class="input">
           <label for="password">Password</label>
            <BreezeInput id="password" type="password"  v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="inline_input">
        <div class="pull-left">
            <label>
                <BreezeCheckbox class="form-control" name="remember" v-model:checked="form.remember" />
<span class="tip_span">Remember me</span>
            </label>
            </div>
  


            <div class="pull-right">
                      <Link class="repsw" v-if="canResetPassword" :href="route('password.request')" >
                Forgot your password?
            </Link>
                           </div>
        </div>

        
            


            <div class="btn">
            <BreezeButton   :disabled="form.processing">
              <span>Sign In</span>

                        <i class="material-icons-outlined">
                            arrow_right_alt
                        </i>
            </BreezeButton>
            </div>

            <div class="link-to"><span>Not a member yet？</span>
                    <Link :href="route('register')">Sign Up for Free</Link></div>

            
    </form>
    </div>

   
</Layout>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/Front/Login'

export default {
  

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,Layout
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
