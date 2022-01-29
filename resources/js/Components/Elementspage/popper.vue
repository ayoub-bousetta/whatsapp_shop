<template>
  <Popper class="infobubble"  placement="bottom" arrow  offsetDistance="5">
    <i class="material-icons-outlined">info</i>
    
    <template #content>
      <p>{{texttoshow}}</p>
      
    </template>
  </Popper>
</template>
<script>
 
  import Popper from "vue3-popper";

 export default {

     props:{
         texttoshow:''
     },
    components:{
        Popper
    }
}
</script>

