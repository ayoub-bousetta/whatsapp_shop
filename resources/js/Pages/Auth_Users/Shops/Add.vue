<template>







 <form @submit.prevent="submit">


<Formheader  

:Shopinfo="{

 
  online:0,


}"
@GetOnlineStat="onGetOnlineStat"

 textheader="Create your online store"   />


<div class="inside_box split">




 <div class="pull-left-inside inputs_box">
 
 

  <InputErrors :messages="errors"  />
           


             <div class="inputs">
                            <Label for="name">Shop name</Label>
                             <Input id="name" v-model="form.name" placeholder='Shop name' />
                        </div>

       
           
           
          


        <div class="inputs"> <Label for="Description">Description</Label>
        
        



          <editor-wyswyg v-model="form.description"    />

       </div>




      



 <div class="inputs">
         <Label>
        Cover
        
        
          <popperInput texttoshow='Images should be horizontal, at least 1280x720px, but not GIF format.' />

        
        
        
        </Label>
           
<dashboard :uppy="cover"  :props="{id: 'cover',theme: 'light',  width: '100%',
  height: 200,
  note: null,
formData:true,
hideCancelButton: true,
hideUploadButton: true,
showRemoveButtonAfterComplete: true,
doneButtonHandler: null,
  thumbnailWidth: 100,
  proudlyDisplayPoweredByUppy: false,
  showRemoveButtonAfterComplete: true,}" />



        

        </div>

         <div class="inputs"><Label for="adresse">
        Address    </Label>
                    
            <Input id="adresse" v-model="form.adresse" placeholder='Address' />


    </div>


       
 <div class="inputs"> <Label for="phone">

        Phone</Label>
                    
            <Input id="phone" v-model="form.phone" placeholder='Phone' />
</div>
         

        
<div class="inputs"> 
 <Label for="Whatsapp">

        Whatsapp number</Label>
                    
          
   <vue-tel-input id="Whatsapp"  v-model="form.whatsapp_number" mode="international"></vue-tel-input>


        </div>



    
                    
           
           
            <div class="inputs">   

        <SelectInput id="currencies" v-model="form.currency_id" label="Currency">
            <option :value="null" />
            <option v-for="currency in currencies" :value="currency.id"
             :key='currency.id'>{{currency.name}} {{currency.code}}</option>
          </SelectInput>
   </div>



<div class="inputs">   



        <SelectInput id="countries" @change="findCity()" v-model="form.country_id" label="Countries">
            <option :value="null" />
            <option v-for="country in countries" :value="country.id"
             :key='country.id'>{{country.name}}</option>
          </SelectInput>
    </div>



   <div class="inputs"  v-if="cities && cities.length >0">

  

        <SelectInput id="City"  v-model="form.city_id" label="City">
            
            <option v-for="city in cities" :value="city.id"
             :key='city.id'>{{city.name}} </option>
          </SelectInput>
 
 </div>




<div class="inputs">   
 <Label for="instagram">

        Instagram page  </Label> 
                    
            <Input id="instagram" v-model="form.instagram" placeholder='instagram url' />

           </div>

   

        <div class="inputs">    <Label for="facebook">Facebook page

      </Label>
                    
            <Input id="facebook" v-model="form.facebook" placeholder='facebook url' />

         
  </div>
        

      

          

            
           

    </div>


<FormSeo  :categories="categories" 

 @GetCategory="onGetCategory" 
  @SeoDescription="onSeoDescription" 
  
  :shopinfo="{
  id:null,
  description : null,


}"
  
   />

</div>
      </form>
</template>
  


<script>
/* eslint-disable no-undef */

  import Input from '@/Components/Input'
  import Label from '@/Components/Label'
 
    import SelectInput from '@/Components/SelectInput'
    import InputErrors from '@/Components/InputErrors'
import { reactive,computed,onUnmounted,ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'
  import popperInput from '@/Components/Elementspage/popper'
import { VueTelInput } from 'vue-tel-input';
  import 'vue-tel-input/dist/vue-tel-input.css';
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
    currencies : Object,
    countries : Object,
    categories:Object
  
    
  },

  components:{
          Input,FormSeo,popperInput,VueTelInput ,
          Label,InputErrors,SelectInput,Dashboard,EditorWyswyg,Formheader
  },

    layout: Layout,
  

  setup (props) {
    const form = reactive({
      name: null,
    description: null,
            adresse: null,
            lat: null,
            lng: null,
            phone: null,
            whatsapp_number: null,
            currency_id: null,
            category_id:null,
              city_id: null,
            thumbnail:null,
            instagram:null,
            facebook:null,
            online : 0,
            seo_description:null

         
          

      
    })


//      Inertia.post(route('ClearImageSession'))

     axios.post(route('ClearImageSession'))




  

    
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


 let cities = ref([])
   
  const findCity=()=> {
    axios.get(route('get_city_by_country',{id:form.country_id}))
    .then(res => cities.value = res.data.city )


    };


  


   const submit=()=> {
      Inertia.post(route('create_shop'), form)
    };


  const onGetOnlineStat=(onlineva)=> {
     
      form.online = onlineva
    }
    


      const onGetCategory=(category_id)=> {
        
      form.category_id = category_id
    }


       
    
    const onSeoDescription=(seo_description)=> {


        
      form.seo_description = seo_description
    }
    return { form, submit,cover,findCity,cities,onGetOnlineStat,onGetCategory,onSeoDescription }
  },









  

  


    



}
</script>