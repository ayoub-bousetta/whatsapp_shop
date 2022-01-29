<template>



    <ul v-if="messages" class="errors">


        <li v-for="message in messages" :key="message" >
        
        
        <p class="text-sm text-red-600"> {{message}}</p>
       </li>
       
    </ul>
</template>

<script>
export default {
    props: {
        messages:''
    
    },



    setup(props) {
        console.log(props.messages.length)
    }

}
</script>
