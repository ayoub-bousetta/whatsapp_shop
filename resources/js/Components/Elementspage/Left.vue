<template>
   
         

                <nav>
                    <ul>
                    <li>
                       
                            <Link  :href="route('index_profile')">
                                   <i class="material-icons-outlined">
face
</i><span>Profile</span>
                            </Link>


                       

                      </li>




                        <li>
                       
                            <Link  :href="route('index_shop')">
                                    <i class="material-icons-outlined">
                                    store
                                </i><span>Stores</span>
                            </Link>


                       

                      </li>

                       <li>
                       
                            <Link  :href="route('index_notifications')">
                                 <i class="material-icons-outlined">
notifications
</i><span class="js-cont-warp">Notifications <span id="js-count">

 {{ $page.props.auth.usernotif }}
</span></span>
                            </Link>


                       

                      </li>
                
                  

                      <li v-if="shopinfourl" > 
                      
                       <Link   :href="route('index_section',{idShop:shopinfourl.shopid,slugShop:shopinfourl.slugShop})">
                                    <i class="material-icons-outlined">
                                    category
                                </i><span>Categories</span>
                            </Link></li>
                   


                      <li > 
                      
                       <Link   :href="route('logout')" method="post">
                                    <i class="material-icons-outlined">
                                    logout
                                </i><span>Disconnect</span>
                            </Link></li>
                    </ul>
                        
                </nav>




</template>


<script>
 import { Link } from '@inertiajs/inertia-vue3'
import axios from 'axios'



 export default {

     props:{
         shopinfourl:''
     },

  
    components:{
        Link
    },

    setup(props) {

        
    }
}
</script>