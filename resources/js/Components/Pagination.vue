<template>
  <div v-if="links.length > 3">
    <div class="pagination">
      <template v-for="(link, k) in links" :key="k">
        <span v-if="link.url === null"  class="link" v-html="link.label" ></span>
        <Link v-else class="link "  :class="{ 'active': link.active }"  
         v-html="link.label" 
        :href="link.url" 
        ></Link>
      </template>
    </div>
  </div>
</template>
  
<script>

import { Link } from '@inertiajs/inertia-vue3';
export default {
  props: {
    links: Array,
  },
  components:{
      Link
  }
}
</script> 