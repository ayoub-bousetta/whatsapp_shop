<template>
      <div class="warp">

         <div class="pulls">

            <div class="pull-left">
        

              <leftside :shopinfourl="shopinfo" />
            </div>
                    
          <div class="pull-right">





          <slot />
          
          
          </div>
         
         
         
         </div>







      
    </div>
</template>

<script>


import  leftside  from '@//Components/Elementspage/Left';
import { headrightside } from '@//Components/Elementspage/Left';
import { Link } from '@inertiajs/inertia-vue3';
import { computed } from '@vue/reactivity';
import { usePage } from '@inertiajs/inertia-vue3'
export default {

props:{
  Shop:Object
},

    components: {
  
        Link,leftside
    },



setup(props) {
       const shopinfo = computed(() => {


         if(props.Shop &&   props.Shop.id){

           return{
             shopid:props.Shop.id,slugShop:props.Shop.slug
           }
           
         }else if(props.Shop &&   props.Shop.shopid){

            return{
             shopid:props.Shop.shopid,slugShop:props.Shop.slugShop
           }
           
         }else{

               return false;
         }

       }
       
  
       
       )


    let userId = computed(() => usePage().props.value.auth.user.id)



    userId=userId.value


    window.Echo.private(`shop.${userId}`)
    .listen('.order.craeted', function (e) {

     document.getElementById('js-count').innerHTML = parseInt( document.getElementById('js-count').innerHTML) + 1;


    }) 
    window.Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        
        switch (notification.type){

          case 'order.craeted':
               document.getElementById('js-count').innerHTML = parseInt( document.getElementById('js-count').innerHTML) + 1;

      break;

        }

    });



       return {shopinfo};

}

   
}
</script>
