<template>






  <form @submit.prevent="submit">
<Formheader  @GetOnlineStat="onGetOnlineStat" :textheader="products.name" 

:Shopinfo="{

 
  online:products.online,


}"

  />
<div class="inside_box split">

<div class="pull-left-inside inputs_box">
  <InputErrors :messages="errors"  />


             <div class="inputs">
            <Label  for="name">
           
            Name</Label>
            <Input id="name" v-model="form.name" placeholder='Shop name' />
           
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
        Cover
           </Label>
<dashboard :uppy="cover"  :props="{id: 'cover',theme: 'light', width: '100%',
  height: 200,
  note: null,
formData:true,
hideCancelButton: true,
hideUploadButton: true,
showRemoveButtonAfterComplete: true,
doneButtonHandler: null,
  thumbnailWidth: 100,proudlyDisplayPoweredByUppy: false,
  showRemoveButtonAfterComplete: true,}" />


  <span>
  
  </span>

        

        


        <div class="img">

        <ul><li v-for="image in CoverMedias" :key="image.id"  >


      
           <span @click="Delete(image.id)"><i class="material-icons-outlined">
delete
</i></span>
       

        <img  :src="'/storage/media/shops/'+shop.shopid+'/products/'+products.id+'/'+image.url" alt="">
        
        </li></ul>

               
        </div>

        
</div>



<div class="multiple_inputs">
  <DetailsCpm :detailsInfo="form.details"  :edit="true" />

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


     
         <VariantsCpn :variantsdata="form.variants" :editme="true" />
        </div>


            
             

   </div>


 <FormSeo  :shop="shop" 
     :shopinfo="{
  id:shop.shopid,
  description : products.seo_description,
  section_id:products.section_id,
  productID:products.id,

}"
   
     @SeoDescription="onSeoDescription" 
     @getSection="onGetSection" 
     :sections="sections"
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
import { reactive,computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'
  import DetailsCpm from '@/Components/Products/sections/Details'
//Maps
 import VariantsCpn from '@/Components/Products/sections/Variants'

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
      flash:Object,
    types : Object,
    shop:Object,
    statues:Object,
    products:Object,
    sections:Object,
  
    
  },
  layout: Layout,
  components:{
          Input,Formheader,FormSeo,
          Label,Button,InputErrors,SelectInput,Dashboard,EditorWyswyg,VariantsCpn,DetailsCpm
  },






  

  setup (props) {




   const form = reactive(props.products)







     axios.post(route('ClearImageSession'))


 const UppyInit =($n=1)=>new Uppy({
          debug: true,
          autoProceed: true,
          restrictions: {
            maxFileSize: 1000000,
            maxNumberOfFiles: $n,
            minNumberOfFiles: 1,
            allowedFileTypes: ['image/*'],
            
          }
        });

    const uppy = computed(() => {
   return   UppyInit().use(XHRUpload, {
            endpoint: route('AddImage'),
            formData: true,
            fieldName: 'files[]',
             headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
          }).on('file-removed', (file, reason) => 
                Inertia.delete(route('DaeleteImageCovers',{ file:file.data.name, type: 'thumbnail' }))
          )
    });


    
    const cover = computed(() => {
       return  UppyInit(5).use(XHRUpload, {
            endpoint: route('AddImage'),
            formData: true,
            fieldName: 'cover[]',
             headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                        }
          }).on('file-removed', (file, reason) => 
                Inertia.delete(route('DaeleteImageCovers',{ file:file.data.name, type: 'covers' }))
          )
    });




const thumbnailMedias = computed(() => props.products.medias.filter(image => image.mediazonetype.slug == 'thumbnail'))
 const CoverMedias = computed(() => props.products.medias.filter(image => image.mediazonetype.slug == 'cover'))



let params = {idShop:props.shop.id, slugShop:props.shop.slug,product:form.id }

   const submit=()=> {

   Inertia.patch(route('edit_product',params), form)

      //axios.patch(route('edit_product',params), form)
    
    };


   
       const Delete=(id)=> {
         
     if (confirm('Are you sure you want to delete this ?')) {

      Inertia.delete(route('delete_img_by_id',{id:id,model:'Product',shopid:props.products.id}))
       }
         
    }


    
     const onGetOnlineStat=(onlineva)=> {
      
      form.online = onlineva
    }
    

  //section id
      const onGetSection=(category_id)=> {

      form.section_id = category_id
    }


       
    
    const onSeoDescription=(seo_description)=> {

      form.seo_description = seo_description
    }
    

    return { form , submit,uppy,cover,Delete,thumbnailMedias,CoverMedias ,onGetOnlineStat,onGetSection,onSeoDescription }
  },





  

  


    



}
</script>