<template>






 <form @submit.prevent="submit">


<Formheader  @GetOnlineStat="onGetOnlineStat"

:Shopinfo="{

 
  online:Shop.online,


}"

 :textheader="'Edit : '+Shop.name"   />


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


      <div class="img">

       
        <ul><li v-for="image in CoverMedias" :key="image.id"  >

        
      <span @click="Deleteimage(image.id)"><i class="material-icons-outlined">
delete
</i></span>
       

        <img  :src="'/storage/media/Shops/'+Shop.id+'/'+image.url" alt="">
        
        </li></ul>

               
        </div>
        

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


    
<FormSeo  

:categories="categories"


:shopinfo="{
  id:Shop.id,
  description : Shop.seo_description,

  category_id:Shop.category_id,

}"
 @GetCategory="onGetCategory" 
  @SeoDescription="onSeoDescription" 
  :thumbnailMedias="thumbnailMedias"
  @DeleteImageId="Delete"
  
    />

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
import { reactive,computed,ref } from 'vue'
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
    Shop: Object,
    medias:Object,
     categories:Object
    
  },

 layout: Layout,
  components:{
          Input,FormSeo,popperInput,VueTelInput,
          Label,InputErrors,SelectInput,Dashboard,EditorWyswyg,Formheader
  },


  
  setup (props) {
    const form = reactive(props.Shop)

    form.country_id = props.Shop.city.country.id;

    


     

      



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






const thumbnailMedias = computed(() => props.Shop.medias.filter(image => image.mediazonetype.slug == 'thumbnail'))
const CoverMedias = computed(() => props.Shop.medias.filter(image => image.mediazonetype.slug == 'cover'))




  let cities = ref([])
 const CountriesCurrent = computed(() =>props.countries.filter(country => country.id ==form.country_id))


 


cities.value= CountriesCurrent.value[0].cities




  
    const findCity=()=> {
      axios.get(route('get_city_by_country',{id:form.country_id}))
      .then(res => cities.value = res.data.city )


      };


    const Delete=(id)=> {



     if (confirm('Are you sure you want to delete this ?')) {
        Inertia.delete(route('delete_img_by_id',{id:id,model:"Shop",shopid:props.Shop.id}))
           }
    }


  



   const submit=()=> {
      Inertia.patch(route('edit_shop',form.id), form)
    }



     const onGetOnlineStat=(onlineva)=> {
     
      form.online = onlineva
    }
    


      const onGetCategory=(category_id)=> {
        
      form.category_id = category_id
    }


       
    
    const onSeoDescription=(seo_description)=> {


        
      form.seo_description = seo_description
    }

    return { form, submit,uppy,cover,findCity,cities,onGetOnlineStat,onGetCategory,onSeoDescription ,thumbnailMedias,CoverMedias,Delete }
  },





  

  


    



}
</script>