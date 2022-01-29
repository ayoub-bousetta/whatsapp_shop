<template>
    <div class="filter_products">

        <div class="warp_search">
            <!-- <div class="inputs">
            <input data-bn-type="input" type="search" placeholder="Search items"
                 v-model="form.search" @input="filterInput">
            <div class="input-suffix">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" cursor="pointer" class="css-9z01gk"><path d="M3 10.982c0 3.845 3.137 6.982 6.982 6.982 1.518 0 3.036-.506 4.149-1.416L18.583 21 20 19.583l-4.452-4.452c.81-1.113 1.416-2.631 1.416-4.149 0-1.922-.81-3.643-2.023-4.958C13.726 4.81 11.905 4 9.982 4 6.137 4 3 7.137 3 10.982zM13.423 7.44a4.819 4.819 0 011.416 3.441c0 1.315-.506 2.53-1.416 3.44a4.819 4.819 0 01-3.44 1.417 4.819 4.819 0 01-3.441-1.417c-1.012-.81-1.518-2.023-1.518-3.339 0-1.315.506-2.53 1.416-3.44.911-1.012 2.227-1.518 3.542-1.518 1.316 0 2.53.506 3.44 1.416z" fill="currentColor"></path></svg>
            </div>
             </div> -->


              <div class="warp_select" @click='openlistbox()' :class="{active:Isactive}">
         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" role="icon" class="css-17rfy1m">
         <path d="M16 9v1.2L12 15l-4-4.8V9h8z" fill="currentColor"></path></svg>
        
            <div class="result">
            <div >{{selectedname}}</div>
            </div>

            <div class="listbox">
            <ul role="listbox"  >

            <li  @click="iChoiceThis(null,'Categories')">
                <div data-bn-type="text" >All</div>
                </li>
                <li v-for="(category, index) in categories" :key="index" @click="iChoiceThis(category.id,category.name)">
                <div data-bn-type="text" >{{category.name}}</div>
                </li>
           
            </ul>
            </div>
            
         </div>
         </div>


        
        
    </div>
</template>


<script>import { reactive, ref } from "@vue/reactivity"
 import { debounce } from 'lodash';
export default {

    props:{
        shopid:null
    },
    
    emits:['iChoiceThis','filterInput'],

    setup(props,context) {
        const form =reactive({

            search :null
        })



   const filterInput =  debounce(()=> {
       
       context.emit('filterInput',form.search);
   }, 800)

        let categories = ref();
        let Isactive = ref(false);

let selectedname = ref('Categories');
        const openlistbox = ()=> Isactive.value = !Isactive.value

         const iChoiceThis = (id,name)=> {
             
            selectedname.value=name;

            if(id == null){
                context.emit('iChoiceThis');
            }   else{
                context.emit('iChoiceThis',id);
            }
            


         }


       



     axios.get(route('_shop_ajax_sections',{id:props.shopid}))
             .then(res=>{
                        categories.value=res.data   
             })




        return {Isactive,openlistbox,
            form,categories,selectedname,iChoiceThis,filterInput
        }
    }
}
</script>