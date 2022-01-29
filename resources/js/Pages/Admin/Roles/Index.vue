<template>
  

  <div>

  <div class="title with_action">
   <h2>
    Roles 
  
  </h2>


    <Link :href="route('create_role')">
   Add Role
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
        <tr v-for="role in roles.data" :key="role.id">
        <td>{{role.name}}</td>
        <td>{{role.slug}}</td>
        <td>
           <Link :href="route('edit_role', { id: role.id })">
   Edit
  </Link>
         <span class="alink" @click="Deleteuser(role.id)" >
   Delete
  </span>
        </td>
        </tr>
    </table>


       <Link :href="link.url"
        v-if="roles.total >0 && roles.length>= roles.per_page " 
        class="text-indigo-700 border-gray-500 p-5" v-for="link in roles.links" v-bind:key="link.label">
                    <span v-bind:class="{'text-red-700' : link.active}">{{ link.label }}</span>
       </Link>

     </div>
</template>

<script>

import { Inertia } from '@inertiajs/inertia';
import { Link,Head } from '@inertiajs/inertia-vue3'

export default {
    props: {
        roles:Object,
        flash: Object,

    },

    components:{
        Link,Head
    },


    setup() {


        const Deleteuser = (id)=>{
               
                if (confirm('Are you sure you want to delete this contact?')) {
                                 Inertia.delete(route('delete_role',id))

                }
                    
        }

        return {Deleteuser};
        
    }







}
</script>
