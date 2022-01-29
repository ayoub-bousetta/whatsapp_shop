<template>
  

  <div>

  <div class="title with_action">
   <h2>
    Countries 
  
  </h2>


    <Link :href="route('create_country')">
   Add Country
  </Link>
  
  </div> 


    <div v-if="flash.success" class="alert {{flash.success }}">
        {{flash.success }}
      </div>
 

    <table>
   <tr>
    <th>Name</th>
    <th>Slug</th>
    <th></th>
  </tr>
        <tr v-for="country in countries.data" :key="country.id">
        <td>{{country.name}}</td>
        <td>{{country.slug}}</td>
        <td>
           <Link :href="route('edit_country', { id: country.id })">
   Edit
  </Link>
         <span class="alink" @click="Deletecountry(country.id)" >
   Delete
  </span>
        </td>
        </tr>
    </table>


<br>
       <Link :href="link.url" v-if="countries.total >0 && countries.length>= countries.per_page " 
       class="text-indigo-700 border-gray-500 p-5" 
       v-for="link in countries.links" v-bind:key="link.label">
        <span v-bind:class="{'active' : link.active}">{{ link.label }}</span>
       </Link>

     </div>
</template>

<script>

import { Inertia } from '@inertiajs/inertia';
import { Link,Head } from '@inertiajs/inertia-vue3'

export default {
    props: {
        countries:Object,
        flash: Object,

    },

    components:{
        Link,Head
    },


    setup() {




        const Deletecountry = (id)=>{
               
                if (confirm('Are you sure you want to delete this?')) {
                                 Inertia.delete(route('delete_country',id))

                }
                    
        }

        return {Deletecountry};
        
    }







}
</script>
