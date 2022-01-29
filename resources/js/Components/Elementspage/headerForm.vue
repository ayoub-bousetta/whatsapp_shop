<template>


 <div  v-if="typepage=='index' && typepage!='noBtn' " class="header_nav" :class="{ fixed: isActive }">

 <ul class="flexed">
                        <li v-if="Shopinfo">

                        <p v-if="Shopinfo.name" class="title">{{Shopinfo.name}}</p>
                        <p v-else class="title">{{textheader}}</p>
                        
                        
                             <Link v-if="Shopinfo.name" class="alink" :href="route('edit_shop', { id: Shopinfo.id })">
   <i class="material-icons-outlined">
brush
</i>
  </Link>
                        </li>

                        <li v-else><p class="title">My Shops</p></li>

                       

                    </ul>
 <ul>
                        
                        <li v-if="Shopinfo && routename=='product' ">
                 

  
    <Link  :href="route('create_product',{idShop:Shopinfo.id,slugShop:Shopinfo.slug})">Add Product</Link>

                        </li>

                        <li v-else-if="Shopinfo && routename=='category' ">
                        
    <span class="link"  @click="showPop">Add Category</span>
                        </li>

                           <li v-else>
                 

  
    <Link  :href="route('create_shop')">Add Shop</Link>

                        </li>
                    </ul>

</div>


          <div v-else class="header_nav" :class="{ fixed: isActive }">
                    <ul>
                        <li><p class="title">{{textheader}}</p></li>

                       

                    </ul>
                    <ul v-if="typepage!='noBtn' ">
                        <li>
                            <div class="switch">
                                <input id="one" class="input" type="checkbox"
                                :checked=" initData.onlineornot"
                                  @change="online($event)"  />
                                <label for="one" class="slider"></label>
                                <label for="one" class="label">{{Draft}}</label>
                              </div>


                        </li>

                    </ul>
                    <ul  v-if="typepage!='noBtn' ">
                        
                        <li>
                            <Button type="submit">Save changes</Button>
                        </li>
                    </ul>

                     <ul  v-if="currentbadg " class="badg">
                        
                        <li>
                           <p>Currently a : <Link :href="route('all_my_badg')">{{currentbadg[0].name}}</Link></p> 
                        </li>
                    </ul>

                </div>
</template>


<script>
 import Button from '@/Components/Button'
 import { reactive,ref,onUnmounted,onMounted } from 'vue'
 import { Link } from '@inertiajs/inertia-vue3'

export default {


    props:{
        typepage:"",
        Shopinfo:Object,
        textheader:'',
        routename:'',
        typepage :'',
        currentbadg:''
    },
    components:{
        Button,Link
    },
emits: ["GetOnlineStat","GetPopuptoShow"],

    setup(props,context) {


        let initData =reactive({
                onlineornot:0,
                daraftornot :'Draft'


        });

        

        if(props.Shopinfo && props.Shopinfo.online && props.Shopinfo.online==1){
            initData.onlineornot =1;
            initData.daraftornot=  "Published"
        }



        let isItOnline=ref(initData.onlineornot );
        let Draft=ref(initData.daraftornot);

       

       









       
       const online=($e)=>{
 isItOnline.value = !isItOnline.value;
     

        
         if(isItOnline.value){
                        Draft.value=  "Published"
                    }else{
                   
                         Draft.value=  "Draft"
                    }

           context.emit("GetOnlineStat", isItOnline.value);


       }





        let isActive=ref(false);
    
            

        onMounted(() => {
                        window.addEventListener('scroll', handleScroll);

       })

        onUnmounted(() => {
                        window.removeEventListener('scroll', handleScroll);

       })


        const handleScroll =()=>{


            if(window.pageYOffset>=100){
                isActive.value = true
            }else{
                isActive.value =false
            }

         
            }

      const showPop =()=>{

            
            context.emit("GetPopuptoShow", true);
        }

       return {online,isItOnline,Draft,handleScroll,isActive,initData,showPop}
    }
}
</script>