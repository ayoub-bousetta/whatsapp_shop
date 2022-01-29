<template>
    <Head title="Welcome" />
<Layout>


            <template  v-slot:headerhome>
        <headHome />
            
        </template>

            
    <section class="features">

                    <div class="title">
                      <h2> What is This ?</h2>

                      <span>This is a Whatsapp-powered ordering tool for your Shop.
                       It is built together with multiple Shop owners and 
                        designed to solve the following problems:</span>
                    </div>


                    <div class="boxes">


                        <div class="box">
                            <div class="img">  <img src="/storage/media/assets/img/icons/shop.png" alt=""></div>

                          

                            <div class="box-inside">
                                <span class="box_title">Create your store</span> 
                                <p>Create your shop/menu directly on our platform. Update anytime. 
                                    Easy And Simple.</p>


                            </div>

  

                        </div>



                        <div class="box">
                           
                            <div class="img"> <img src="/storage/media/assets/img/icons/buy.png" alt=""></div>


                            <div class="box-inside">
                                <span class="box_title">Ordering via WhatsApp</span> 
                                <p>You will receive the order on your WhatsApp. Continue the chat and finalize order</p>


                            </div>

  

                        </div>


                        
                        <div class="box">
                            <div class="img"> <img src="/storage/media/assets/img/icons/0com.png" alt=""></div>

                            <div class="box-inside">
                                <span class="box_title">0% commission</span> 
                                <p>Delivery apps on average charge a 20% 
                                    commission. As a result store owners have 3 options: to increase the prices, to cut the cost, or to be left with 0 margins</p>


                            </div>

  

                        </div>


                        <div class="box">
                            <div class="img">
                            <img src="/storage/media/assets/img/icons/easy.png" alt=""></div>

                            <div class="box-inside">
                                <span class="box_title">Easy to use</span> 
                                <p>Just create your menu, and next thing you know, is receiving orders on your phone via WhatsApp.</p>


                            </div>

  

                        </div>

  <div class="box">
      <div class="img">
        <img src="/storage/media/assets/img/icons/via_phone.png" alt="">
      </div>
                            

                            <div class="box-inside">
                                <span class="box_title">Know your customers</span> 
                                <p>When an order from delivery app comes, you only talk to a courier. Did you customers enjoy your food or not? Are they going to order again?  Who are they, and how can you make them happier? You have no idea.</p>


                            </div>

  

                        </div>
                    </div>


                </section>
    
    
</Layout>
  
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Layout from '@/Layouts/Front/Home'
import headHome from '@/Components/Front/home/header'

export default {
    components: {
      Head,
      Link,Layout,headHome
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
}
</script>
