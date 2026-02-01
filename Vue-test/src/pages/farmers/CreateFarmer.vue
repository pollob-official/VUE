<template>
    <div>
        <h1>Create Farmer</h1>
        <form action="">
            <div>
                <label for="crop_history">Crop History:</label>
                <input type="text" id="crop_history" name="crop_history">
            </div>
            <br>
            <div>
                <label for="farmer_card_no">Farmer Card No:</label>
                <input type="text" id="farmer_card_no" name="farmer_card_no">
            </div>
             <div> <button type="submit">Submit</button></div>

        </form>
    </div>
</template>

<script lang="ts" setup>
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