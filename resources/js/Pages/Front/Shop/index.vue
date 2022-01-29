<template>
    <layout >
        <template v-slot:headershop>
            <headShop :medias="Shop.medias" />

            
            
        </template>




<DivDescription  :shopinfo="descriptionInfo"  />


<filterFormvue :shopid='Shop.id' @iChoiceThis="iChoiceThis"  />


<Sections v-if="sections " :sections="sections.data"

 

 :symbole="{code:Shop.currency.symbole,name:Shop.currency.name,slug:Shop.slug}"

 /> 

         <div v-show="loading" class="lds-loading"><div></div><div></div><div></div></div>

        
    </layout>
</template>

<script>

import headShop from '@/Components/Front/Shop/head'
import DivDescription from '@/Components/Front/Shop/description'
import Sections from '@/Components/Front/Shop/Sections'
import Layout from '@/Layouts/Front/Shop'
import { computed, reactive, ref } from '@vue/reactivity'
import axios from 'axios'
import filterFormvue from '@/Components/Front/Shop/filterForm.vue'
 import { debounce } from 'lodash';
import { Inertia } from '@inertiajs/inertia'
export default {


    props:{
        Shop:'',
        Sections : ''


    },
    
    components: {
        headShop,Layout ,DivDescription,
        Sections,filterFormvue
    },


    setup(props) {

        let sections= ref(props.Sections)
      
            

          const iChoiceThis = (id)=>{

              let params= reactive({})

              if(id){

                  params =  reactive({id:props.Shop.id,slug:props.Shop.slug,section_id:id})


              }else{
                 params =  reactive({id:props.Shop.id,slug:props.Shop.slug}) 
              }


            axios.get(route('_shop_index',params)).then(res=>{



                  sections.value=res.data
                 
                   
            })




        }

        let descriptionInfo= reactive({
            'id':props.Shop.id,
            'slug':props.Shop.slug,
            'name':props.Shop.name,
            'phone':props.Shop.phone,
            'address':props.Shop.adresse +', '+ props.Shop.city.name+', '+props.Shop.city.country.name,
            'description':props.Shop.description,
            'rsicon':{
                'fb':props.Shop.facebook,
                'ig':props.Shop.instagram,
            }


        })

   let loading =ref(false);

        
         window.addEventListener('scroll',debounce((e)=>{


            let pixelfrombottom =  document.documentElement.offsetHeight - document.documentElement.scrollTop - window.innerHeight

                if(pixelfrombottom < 200 && sections.value.next_page_url != null){
                     loading.value=true;
                    axios.get(sections.value.next_page_url).then(res=>{


                        sections.value={
                            ...res.data,
                            data:[...sections.value.data,...res.data.data]
                        }

                         loading.value=false;

                        
                    })


                }

        },100))

        return {sections,loading,descriptionInfo,iChoiceThis}
    }
}
</script>
