<template>
      <div class="pull-right-inside inputs_box">

   

                 
                        <div class="inputs">
                            <label for="">Seo description
                            
                            <popperInput texttoshow='dfgdfg dgdfg fdgdfg dfgdfg <br>dgdfg fdgdfg dfgdfg dgdfg fdgdfg dfgdfg dgdfg fdgdfg' />
                         
                            
                            
                            </label>
                            <textarea name="" id="" cols="30" rows="10" @change="getSeoDescription">{{shopinfo.description}}</textarea>
                        </div>

                     


                        <div class="inputs" v-if="categories">    

                            <SelectInput id="categories" v-model="shopinfo.category_id" @change="getCategory($event)" label="Category">
                                <option :value="null" />
                                <option v-for="category in categories" :value="category.id"
                                :key='category.id'>{{category.name}} </option>
                            </SelectInput>
                        </div>



                        <div class="inputs" v-if="sections">    

                            <SelectInput id="sections" v-model="shopinfo.section_id" @change="getSection($event)" label="Category">
                                <option :value="null" />
                                <option v-for="section in sections" :value="section.id"
                                :key='section.id'>{{section.name}} </option>
                            </SelectInput>

                            <span class="alink_input" @click="showPop()">Add Category</span>

                            <AddSection :Shopinfo="shop" :isActive="isActive"  @isActiveit="onActive" />
                        </div>

 <div class="inputs"><Label>
        Thumbnail   
        
                                    <popperInput texttoshow='This image appears as logo for your store, Your image should be square, 
                                    at least 600x600px, and JPG, PNG but not GIF format.' />

        
          </Label>
           
<dashboard  v-show="!thumbnailMedias || thumbnailMedias.length <=0"  :uppy="uppy"  :props="{id: 'thumbnail',theme: 'light',  width: '100%',
  height: 200,
 
   note: null,
formData:true,
hideCancelButton: true,
hideUploadButton: true,
showRemoveButtonAfterComplete: true,
doneButtonHandler: null,
  thumbnailWidth: 100,
  proudlyDisplayPoweredByUppy: false,
  showRemoveButtonAfterComplete: true,
  
  
}" />


 
      <div class="img" v-show="thumbnailMedias && thumbnailMedias.length >0">

        <ul><li v-for="image in thumbnailMedias" :key="image.id"  >


       
 <span @click="Deleteimage(image.id)"><i class="material-icons-outlined">
delete
</i></span>


        <img v-if="!shopinfo.productID" :src="'/storage/media/shops/'+shopinfo.id+'/'+image.url" alt="">
    <img v-else-if="shopinfo.productID" :src="'/storage/media/shops/'+shopinfo.id+'/products/'+shopinfo.productID+'/'+image.url" alt="">
        </li></ul>

               
        </div>


        </div> 

                        

                    </div>
</template>



<script>
import Uppy from '@uppy/core'
import { Dashboard } from '@uppy/vue'
import { computed,ref } from 'vue'
 import Label from '@/Components/Label'
import XHRUpload from '@uppy/xhr-upload'
  import popperInput from '@/Components/Elementspage/popper'
import AddSection from '@/Components/Products/sections/AddSection'
    import SelectInput from '@/Components/SelectInput'
export default {


    props:{
        categories:Object,
        sections:Object,
        category_id:"",
        section_id:"",
        shopinfo:'',
        
        shop:Object,
        thumbnailMedias:null
        
    },

   

      components:{
          Dashboard,Label,SelectInput,popperInput,AddSection
  },


emits: ["GetCategory",'SeoDescription','getSection','Closeit','DeleteImageId'],
    setup(props,context) {


console.log(props.sections)


  const getCategory=(e)=>{


           context.emit("GetCategory", e.target.value);

       }
  
      const getSeoDescription=(t)=>{


           context.emit("SeoDescription", t.target.value);

       }

  const getSection=(t)=>{


           context.emit("getSection", t.target.value);

       }

       
 const Deleteimage=(imageid)=>{


           context.emit("DeleteImageId", imageid);

       }

          const uppy = computed(() => {


   return   new Uppy({
          debug: true,
          autoProceed: true,
 
  

          restrictions: {
            maxFileSize: 1000000,
            maxNumberOfFiles: 1,
            minNumberOfFiles: 1,
            allowedFileTypes: ['image/*'],
            
            
          },
    
        
        }).use(XHRUpload, {
            endpoint: route('AddImage'),
        
            formData: true,
            fieldName: 'files[]',
             headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
          }).on('file-removed', (file, reason) => 
                Inertia.delete(route('DaeleteImageCovers',{ file:file.data.name, type: 'thumbnail' }))
          )
    });

  let isActive=ref(false)

 const onActive =(valueActive)=>{

    isActive.value =valueActive
  }
 
  const showPop =()=>{

    isActive.value =true
  }
    return {uppy,getCategory,getSeoDescription,showPop,isActive,onActive,getSection,Deleteimage }

    
}
    
}
</script>

