<template>




<div class="Detail">





 <span class="addbtn" @click="addDetail">
    
<span class="material-icons-outlined">
library_books
</span>

        
    
    Add Details</span>


    <ul class="Detailbox">

    <li v-for="(Existingdetail, z) in Existingdetails" :key="z">

           <div class="inputs flex_inputs line2">
    
      <input type="text" class="form-control" v-model="Existingdetail.attribute" />
      <input type="text" class="form-control" v-model="Existingdetail.value" />
            <span class="warp_action">
              <i
                class="fas fa-minus-circle"
                @click="removeDetailInput(z,Existingdetail.id,Existingdetail.product_id)"
                v-show="z || ( !z && Existingdetails.length > 0)"
              ><span class="material-icons-outlined">
remove_circle_outline
</span></i>
              <i
                class="fas fa-plus-circle"
                @click="addDetailInput(z)"
                v-show="z == Existingdetails.length-1"
              ><span class="material-icons-outlined">
add_circle_outline
</span></i>
            </span>
       
</div>

    </li>

    
    </ul>
 
  </div>
</template>
  


<script>
/* eslint-disable no-undef */


import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';
import { reactive } from 'vue'
//Maps



export default {


  props: {
    detailsInfo:'',
    errors:Object,
  
    
    edit:false

  
    
  },



  

  setup (props) {
 
 let Existingdetails;



if(props.edit ){


       
   Existingdetails=reactive(props.detailsInfo);
  
  Existingdetails =props.detailsInfo

  

}else{

   Existingdetails=reactive([]);
Existingdetails=props.detailsInfo.details
  
}


    


   

   



    const addDetail=()=> {


      Existingdetails.push({
              attribute: '',
              value:''
            })


    };

const addDetailInput=(index)=> {
      
          Existingdetails.push({
               attribute: '',
              value:''
            })
      };


      const removeDetailInput=(z,index,product_id)=> {


        


          

         if(index && product_id){

             if (confirm('Are you sure you want to delete this ?')) {
                  axios.post(route('delete_details',{product_id:product_id,
                  detailid:index})).then(res=>{

                      if(res.data.success){
                          Existingdetails.splice(z, 1)
                          props.errors = {'message':res.data.success}
                      }else{

                          props.errors = {'message':res.data.errors}
                        
                      }

                        
                    
                  }).catch((error) => {
                  props.errors = {'message':error.message}
                  });

             }
           

         }else{

             Existingdetails.splice(z, 1)
         }

         
        
        
      };


 

   
    

    return { addDetail,Existingdetails,removeDetailInput, addDetailInput}
  },





  

  


    



}
</script>