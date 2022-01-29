<template>
    <div class="header_shop_dashboard">

        <div class="boxs">
                <div class="box">
                    <h2 class="">Total Revenue</h2>
                    <span >{{summaryShop.symbole}} {{summaryShop.totalRev.toFixed(2)}}</span>
                </div>

                <div class="box">
                    <h2 class="">Products</h2>
                    <span >{{summaryShop.totalProduct}}</span>
                </div>

                <div class="box">
                    <h2 class="">Total Orders</h2>
                    <span >{{summaryShop.totalOrders}}</span>
                </div>

        </div>
    </div>
    
</template>



<script>





export default {

props:{
    

    summaryShop:Object
    
    
  
},
   components: {
 
  },



 
  setup(props) {


      

  }




}
</script>

