<template>
    <div>
        <h1>Create Farmer</h1>
        <form action="">

          <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" v-model="farmer.stakeholder.name">
          </div>
          <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" v-model="farmer.stakeholder.phone">
          </div>
          <div>
            <label for="land_area">Land Area:</label>
            <input type="text" id="land_area" name="land_area" v-model="farmer.land_area">
          </div>

            <div>
                <label for="crop_history">Crop History:</label>
                <input type="text" id="crop_history" name="crop_history" v-model="farmer.crop_history">
            </div>
            <br>
            <div>
                <label for="farmer_card_no">Farmer Card No:</label>
                <input type="text" id="farmer_card_no" name="farmer_card_no" v-model="farmer.farmer_card_no">
            </div>
             <div> <button type="submit" @click.prevent="handleCreate">Submit</button></div>

        </form>
    </div>
</template>

<script setup>
import axios from 'axios';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';

const baseUrl = import.meta.env.VITE_API_BASE_URL;
const router= useRouter()
let farmer= reactive({
   crop_history:"",
   farmer_card_no:""
})

function handleCreate(){
   axios.post(`${baseUrl}/farmers`,{
     farmer
   })
   .then(res=>{
     console.log(res);
     router.push("/farmers")
     
   })
   .catch(err=>{
     console.log(err)
   })
}
</script>

<style></style>