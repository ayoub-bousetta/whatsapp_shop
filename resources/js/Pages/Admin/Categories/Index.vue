<template>
  

  <div>

  <div class="title with_action">
   <h2>
    Categories 
  
  </h2>


    <Link :href="route('create_category')">
   Add Category
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
        <tr v-for="role in categories.data" :key="role.id">
        <td>{{role.name}}</td>
        <td>{{role.slug}}</td>
        <td>
           <Link :href="route('edit_category', { id: role.id })">
   Edit
  </Link>
         <span class="alink" @click="Deleteuser(role.id)" >
   Delete
  </span>
        </td>
        </tr>
    </table>


<br>
       <Link :href="link.url" v-if="categories.total >0 && categories.length>= categories.per_page " 
       class="text-indigo-700 border-gray-500 p-5" 
       v-for="link in categories.links" v-bind:key="link.label">
                    <span v-bind:class="{'active' : link.active}">{{ link.label }}</span>
       </Link>

     </div>
</template>

<script>

import { Inertia } from '@inertiajs/inertia';
import { Link,Head } from '@inertiajs/inertia-vue3'

export default {
    props: {
        categories:Object,
        flash: Object,

    },

    components:{
        Link,Head
    },


    setup() {




        const Deleteuser = (id)=>{
               
                if (confirm('Are you sure you want to delete this contact?')) {
                                 Inertia.delete(route('delete_category',id))

                }
                    
        }

        return {Deleteuser};
        
    }







}
</script>
