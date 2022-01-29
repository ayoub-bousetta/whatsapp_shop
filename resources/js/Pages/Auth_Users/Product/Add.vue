<template>







  <form @submit.prevent="submit">



<Formheader  @GetOnlineStat="onGetOnlineStat" textheader="Define your product" 

:Shopinfo="{

 
  online:false,


}"

  />
<div class="inside_box split">

<div class="pull-left-inside inputs_box">
  <InputErrors :messages="errors"  />
    <ul v-if="flash.success" class="success">
       <li><p> {{flash.success }}</p></li>
      </ul>

          
    <div class="inputs">
            <Label  for="name">
           
            Name</Label>
            <Input id="name" v-model="form.name" placeholder='Product name' />
           
            </div>


        <div class="inputs"><Label for="Description">
        
        Description </Label>



          <editor-wyswyg v-model="form.description"    />

       </div>


          <div class="inputs"><Label for="summary">
        
        Summary </Label>



          <editor-wyswyg v-model="form.summary"    />

       </div>




     


  <div class="inputs">

         <Label>
        Cover  </Label>
           
<dashboard :uppy="cover"  :props="{id: 'cover',theme: 'light',  width: '100%',
  height: 200,
  note: null,
formData:true,
hideCancelButton: true,
hideUploadButton: true,
showRemoveButtonAfterComplete: true,
doneButtonHandler: null,
  thumbnailWidth: 100,proudlyDisplayPoweredByUppy: false,
  showRemoveButtonAfterComplete: true,}" />



      </div>


<div class="multiple_inputs">
  <Details :detailsInfo="form"  />

</div>
      

       <div class="inputs">   <Label for="price">
        Price </Label>
                    
            <Input id="price" v-model="form.unit_price" 
            placeholder='Unit price' />
</div>

       


       


   <div class="inputs">
 <Label  for="Type" v-if="types">  </Label>

  

        <SelectInput id="Type"  v-model="form.type_id" label="Type">
            
            <option v-for="titem in types" :value="titem.id"
             :key='titem.id'>{{titem.name}} </option>
          </SelectInput>
  
</div>


         <div class="inputs"><Label for="sku">
        Sku </Label>
                    
            <Input id="Sku" v-model="form.sku" 
            placeholder='Sku' />


       
</div> 


<div class="multiple_inputs">
<Variants :variantsdata="form" />
</div>
  



</div>

   <FormSeo  :shop="Shop" 
     :shopinfo="{
  id:null,
  description : null,


}"
   
     @SeoDescription="onSeoDescription" @getSection="onGetSection" :sections="sections" />
         
            

    </div>

     </form>
</template>
  


<script>
/* eslint-disable no-undef */

  import Input from '@/Components/Input'
  import Label from '@/Components/Label'
  import Button from '@/Components/Button'
    import SelectInput from '@/Components/SelectInput'
    import InputErrors from '@/Components/InputErrors'

      import Variants from '@/Components/Products/sections/Variants'
            import Details from '@/Components/Products/sections/Details'

import { reactive,computed,ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'



  import popperInput from '@/Components/Elementspage/popper'
//Maps


import '@uppy/core/dist/style.css'
import '@uppy/dashboard/dist/style.css'
import Uppy from '@uppy/core'
import { Dashboard } from '@uppy/vue'

import XHRUpload from '@uppy/xhr-upload'

import  EditorWyswyg  from '@/Components/EditorWyswyg'
import Formheader from '@/Components/Elementspage/headerForm.vue'
import FormSeo from '@/Components/Elementspage/SEeoInputs.vue'
import Layout from '@/Layouts/Dashboard'
export default {


  props: {
    errors: Object,
     flash: Object,
    types : Object,
    Shop:Object,
    sections:Object,
 

  
    
  },
   layout: Layout,

  components:{
          Input,Formheader,FormSeo,
          Label,Button,InputErrors,SelectInput,Dashboard,EditorWyswyg,Details,Variants
  },


  

  setup (props) {
    const form = reactive({
      name:null,
        description:null,
        summary:null,
        type_id:null,
        unit_price:null,
       section_id:null,
       online:0,
       seo_description:null,
        sku:null,
           variants:[],
           details:[],
       
      
       

           

      
    })


//      Inertia.post(route('ClearImageSession'))

     axios.post(route('ClearImageSession'))




    const uppy = computed(() => {
   return   new Uppy({
          debug: true,
          autoProceed: true,
          restrictions: {
            maxFileSize: 1000000,
            maxNumberOfFiles: 1,
            minNumberOfFiles: 1,
            allowedFileTypes: ['image/*'],
            
          }
        }).use(XHRUpload, {
            endpoint: route('AddImage'),
            formData: true,
            fieldName: 'files[]',
             headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
          }).on('file-removed', (file, reason) => 
                Inertia.delete(route('DaeleteImageCovers',{ file:file.data.name, type: 'thumbnail' }))
          )
    });


    
    const cover = computed(() => {
       return   new Uppy({
          debug: true,
          autoProceed: true,
              onBeforeFileAdded: (currentFile, files) => currentFile,

          restrictions: {
            maxFileSize: 1000000,
            maxNumberOfFiles: 5,
            minNumberOfFiles: 1,
            allowedFileTypes: ['image/*'],
            
          }
        }).use(XHRUpload, {
            endpoint: route('AddImage'),
            formData: true,
            fieldName: 'cover[]',
             headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                        }
          }).on('file-removed', (file, reason) => 
                Inertia.delete(route('DaeleteImageCovers',{ file:file.data.name, type: 'covers' }))
          )
    });


 


   


   const submit=()=> {
      Inertia.post(route('create_product',
      {idShop:props.Shop.id,slugShop:props.Shop.slug}), form)
    };


     const onGetOnlineStat=(onlineva)=> {
       console.log(onlineva)
      form.online = onlineva
    }
    

  //section id
      const onGetSection=(category_id)=> {

      form.section_id = category_id
    }


       
    
    const onSeoDescription=(seo_description)=> {


           console.log(seo_description)
      form.seo_description = seo_description
    }
    

    return { form, submit,uppy,cover,onGetOnlineStat,onGetSection,onSeoDescription }
  },





  

  


    



}
</script>