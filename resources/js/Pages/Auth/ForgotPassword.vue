<template>
<Layout>
    <Head title="Forgot Password" />

  

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <BreezeValidationErrors class="mb-4" />
 <div class="warp-form onlyform">
  
    <form @submit.prevent="submit">
     <p>
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    </p>
        <div class="input">
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="btn">
            <BreezeButton   :disabled="form.processing">
              <span>                Email Password Reset Link
</span>

                        <i class="material-icons-outlined">
                            arrow_right_alt
                        </i>
            </BreezeButton>
            </div>

       
    </form>
    </div>
    </Layout>
</template>


<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/Front/Login'

export default {
 

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,Layout
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>
