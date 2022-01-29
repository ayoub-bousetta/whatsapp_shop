<template>

<nav class="menu">
    <div class="left">
  <ul>
<li>
<Link :href="route('_index_home')">
<Logonew />
</Link>
</li>
</ul>

    <ul>
        <!--li><Link>Features</Link></li>
        <li><Link>Pricing</Link></li>
         <li><Link>Blog</Link></li-->
          <li> <Link :href="route('Marketplace')">Marketplace</Link></li>
          <li v-if="$page.props.auth.user">
           <Link :href="route('my_orders')">
                   My Orders
          </Link></li>

    
    </ul>  
    </div>


<div class="right">
   <ul>
   <li  v-if="$page.props.auth.user">
   <Link :href="route('index_profile')">{{$page.props.auth.user.profile.name}} {{$page.props.auth.user.profile.fname}}</Link></li>
    <li  v-if="!$page.props.auth.user"><Link :href="route('login')">Login</Link></li>
    <li  v-if="!$page.props.auth.user"><Link :href="route('register')">Register</Link></li>
    <li><Link class="cart-toggler" :href="route('my-cart')"><span class="cart-icon">
    <i class="material-icons-outlined">
shopping_bag
</i>
														<span class="cart-quantity">
															{{lengthshit}}	</span>
													</span>
										
			
        </Link></li>

    </ul>

    
   

  

</div>

   


</nav>




</template>


<script>
import  Logonew  from '@/Components/logo.vue'
import { Link,Head } from '@inertiajs/inertia-vue3'
import { watch,ref } from '@vue/runtime-core'
import Crypto from 'crypto-js';
import { usePage } from '@inertiajs/inertia-vue3'

export default {
    
 props:{
        itemTotal:{action:""},
        auth:Object
    },

    components:{
        Link,Logonew
    },
setup(props) {





       
        const store = window.localStorage.getItem('cartes');
        let existingEntries =ref([]);



        if(store != null){
             const bytes = Crypto.AES.decrypt(store, process.env.MIX_KeyToEncrypt);

             existingEntries.value = JSON.parse(bytes.toString(Crypto.enc.Utf8)) || [];



        }

       



         let lengthshit =ref(existingEntries.value.length);
         watch(
            () =>props.itemTotal,
            ( ) => {
                console.log('d')


                if(props.itemTotal.action == "add" ){
                    lengthshit.value= lengthshit.value +1
                }else if(props.itemTotal.action == "remove"){
                    if(lengthshit.value >0){
                        lengthshit.value= lengthshit.value -1
                    }else{
                        lengthshit.value= 0
                    }
                    
                }
            },
            { deep: true }
            )


        
          

      
        return {lengthshit}

}
    
}
</script>