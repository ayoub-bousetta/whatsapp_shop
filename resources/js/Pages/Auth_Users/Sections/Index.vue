<template>
  

  <div>


<Formheader 
routename="category"
typepage='index'
:Shopinfo="Shopinfo"
@GetPopuptoShow="GetPopuptoShow"
 textheader="Products Categories"   />

  <InputErrors :messages="errors"  />
  
     <ul v-if="flash.success" class="success">
       <li><p> {{flash.success }}</p></li>
      </ul>

 <div class="tables">


<div class="inputs_box" v-if="isActive">
<div class="inputs">
 <AddSection :isActive="isActive"
 
 :sectioninfo="sectiondata"

 
  :Shopinfo="Shopinfo" 
  @isActiveit="onActive"   />
 </div>
</div>
 
   

    <table>
     <thead>
   <tr>
    <th>Name</th>
    <th>Products</th>
    <th></th>
  
  </tr>
    </thead>
    <tbody>
        <tr v-for="role in sections.data" :key="role.id">
        <td>{{role.name}}</td>
         <td> {{role.products_count}}</td>
        <td class="links">
           <span class="alink" @click="getData(role.id)">
    <i class="material-icons-outlined">
brush
</i>
  </span>
         <span class="alink" @click="Deleteuser(role.id)" >
   <i class="material-icons-outlined">
delete
</i>
  </span>
        </td>
        </tr>
        </tbody>
    </table>


      
</div>

<br>
       <Link :href="link.url" v-if="sections.total >10 " 
       v-for="link in sections.links" v-bind:key="link.label">
                    <span v-bind:class="{'active' : link.active}">{{ link.label }}</span>
       </Link>

     </div>
</template>

<script>
import { ref,reactive,watchEffect } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import { Link,Head } from '@inertiajs/inertia-vue3'
import Layout from '@/Layouts/Dashboard'
import Formheader from '@/Components/Elementspage/headerForm.vue'
import AddSection from '@/Components/Products/sections/AddSection'
   import InputErrors from '@/Components/InputErrors'
import axios from 'axios';

export default {
    props: {
        sections:Object,
        flash: Object,
        errors: Object,
        Shopinfo:Object

    },

    layout: Layout,
    emits:['isActiveit'],

    components:{
        Link,Head,Formheader,AddSection,InputErrors
    },


    setup(props) {




        const Deleteuser = (id)=>{
               
                if (confirm('Are you sure you want to delete this contact?')) {
                                 Inertia.delete(route('delete_category',id))

                }
                    
        }

let isActive=ref(false)
        const GetPopuptoShow =(val)=>{

          isActive.value =val
           sectiondata.value= {}
        }

        const onActive =(valueActive)=>{

    isActive.value =valueActive
  }



let sectiondata=ref()

 const getData=async (id)=>{


     try {
       const resp = await axios.get(route('edit_section',{idShop:props.Shopinfo.id,slugShop:props.Shopinfo.slug,sectionid:id}))

        if(resp.data.section !=""){
        sectiondata.value= resp.data.section
        
        isActive.value =true

         
     }
    } catch (err) {
        
        console.error(err);
    }


  


  



  }





        return {Deleteuser,GetPopuptoShow,isActive,onActive,getData,sectiondata};
        
    }







}
</script>
