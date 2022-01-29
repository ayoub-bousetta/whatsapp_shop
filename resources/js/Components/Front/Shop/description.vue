<template>
        <div class="description" >

        <div class="title_head">

        <div class="titleinfo">

           <h1>{{shopinfo.name}}</h1>

             <div class="desc" v-html="shopinfo.description"></div>
             <div class="adrrs">
             <p>{{shopinfo.address}}</p>
               <p>{{shopinfo.phone}}</p>
             </div>
           

             <RsIcon :rsicon="shopinfo.rsicon" />

        
        </div>
          

        <div class="qrcode">
        <QrCode :qrValue="urltosend" />

        <p><small>Scan this <b>QR code</b> with the mobile app to view it on your device.</small>
        </p>
        </div>
        
        </div>


        <div class="info_head">

        
        </div>
       

          
            


        </div>

</template>

<script>


import { computed,ref } from "@vue/reactivity"
import QrCode from '@/Components/Front/Shop/QrCode'

import RsIcon from '@/Components/Front/Shop/resIcon.vue'
export default {
    props:{
        shopinfo:Object
    },

     components:{
        QrCode,RsIcon
    },

    setup(props) {

        let urltosend = ref();

        urltosend.value= route('_shop_index',{id:props.shopinfo.id,slug:props.shopinfo.slug})



        return {
            urltosend
        }
        
    }


    


}
</script>
