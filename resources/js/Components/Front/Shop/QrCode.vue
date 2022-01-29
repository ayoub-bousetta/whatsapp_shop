<template>
  <div>
  
   <QRCodeVue3 v-if="qrValue != '' "
          :width="200"
          :height="200"
          :value="qrValue"
       
          :imageOptions="{ hideBackgroundDots: true, 
          imageSize: 0.4, margin: 0 }"
                :dotsOptions="{
            type: 'square',
            color: '#000000',
            gradient: {
              type: 'linear',
              rotation: 0,
              colorStops: [
                { offset: 0, color: '#000000' },
                { offset: 1, color: '#000000' },
              ],
            },
          }"
          :backgroundOptions="{ color: '#ffffff' }"
          :cornersSquareOptions="{ type: 'square', color: '#000000' }"
          :cornersDotOptions="{ type: 'square', color: '#000000' }"
          fileExt="png"
          :download="false"
          myclass="my-qur"
          imgclass="img-qr"
          downloadButton="my-button"
          :downloadOptions="{ name: 'vqr', extension: 'png' }"
        />
  </div>
</template>

<script>
import QRCodeVue3 from "qrcode-vue3";

export default {
  props:{
      qrValue:null

  },
  components: {
    QRCodeVue3
  },
}
</script>