<template>
  <div>
     <p>{{ farmer }}</p>
        <form @submit.prevent="handleUpdate">
       <div>
        <label for="name">Name</label>
        <input type="text" name="name" v-model="farmer.name">
       </div>
       <div>
        <label for="phone">Phone</label>
        <input type="text" name="phone"  v-model="farmer.phone">
       </div>
       <div>
        <label for="land_area">Land Area</label>
        <input type="text" name="land_area"  v-model="farmer.land_area">
       </div>
       <div>
        <label for="crop_history">Crop History</label>
        <input type="text" name="crop_history"  v-model="farmer.crop_history">
       </div>
       <div>
        <label for="farmer_card_no">Farmer Card No</label>
        <input type="text" name="farmer_card_no"  v-model="farmer.farmer_card_no">
       </div>
       <div> <button type="submit">Submit</button></div>
   </form> 
  </div>
</template>

<script  setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

  let farmerId= useRoute().params.id
  
  console.log(farmerId);
  
  
  let farmer=ref({
    name:"",
    phone:"",   
    land_area:"",
    crop_history:"",
    farmer_card_no:""
    
  })
  const baseUrl = import.meta.env.VITE_API_BASE_URL;


  const fetchFarmer=()=>{
     axios.get(`${baseUrl}/farmers/${farmerId}`)
     .then(res=>{
         console.log(res);
         farmer.value.name= res.data.farmer.stakeholder.name;
         farmer.value.phone= res.data.farmer.stakeholder.phone;
         farmer.value.land_area= res.data.farmer.land_area;
         farmer.value.crop_history= res.data.farmer.crop_history;
         farmer.value.farmer_card_no= res.data.farmer.farmer_card_no;
     })
     .catch(err=>{
        console.log(err);
     })
  }

  onMounted(()=>{
    fetchFarmer()
  })
  // console.log(farmerId);
  
 const handleUpdate = ()=>{

    axios.put(`${baseUrl}/farmers/${farmerId}`,{
       farmer:farmer.value
    })
   .then(res=>{
         console.log(res);
     })
     .catch(err=>{
        console.log(err);
     })
 }





</script>

<style>

</style>