<template>
  

  <div>

  <div class="title with_action">
   <h2>
    Cities 
  
  </h2>


    <Link :href="route('create_city')">
   Add City
  </Link>
  
  </div> 


    <div v-if="flash.success" class="alert {{flash.success }}">
        {{flash.success }}
      </div>
 

    <table>
   <tr>
    <th>Name</th>
    <th>Country</th>
    <th></th>
  </tr>
        <tr v-for="city in cities.data" :key="city.id">
        <td>{{city.name}}</td>
        <td>{{city.country.name}}</td>
        <td>
           <Link :href="route('edit_city', { id: city.id })">
   Edit
  </Link>
         <span class="alink" @click="Deletecity(city.id)" >
   Delete
  </span>
        </td>
        </tr>
    </table>


<br>
       <Link :href="link.url" v-if="cities.total >0 && cities.length>= cities.per_page " 
       class="text-indigo-700 border-gray-500 p-5" 
       v-for="link in cities.links" v-bind:key="link.label">
                    <span v-bind:class="{'active' : link.active}">{{ link.label }}</span>
       </Link>

     </div>
</template>

<script>

import { Inertia } from '@inertiajs/inertia';
import { Link,Head } from '@inertiajs/inertia-vue3'

export default {
    props: {
        cities:Object,
        flash: Object,

    },

    components:{
        Link,Head
    },


    setup() {




        const Deletecity = (id)=>{
               
                if (confirm('Are you sure you want to delete this?')) {
                                 Inertia.delete(route('delete_city',id))

                }
                    
        }

        return {Deletecity};
        
    }







}
</script>
