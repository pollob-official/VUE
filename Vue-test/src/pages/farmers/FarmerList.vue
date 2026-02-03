<template>
  <div>
    <h1>Farmer List</h1>
    
    <input type="text" placeholder="Farmer Search" v-model="search">
<hr>
<br>
    <table>
        <thead>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Land Area</th>
            <th>Crop History</th>
            <th>Farmer Card No</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="farmer in searchFarmer" :key="farmer.id">
            <td>{{ farmer.id }}</td>
            <td>{{ farmer.stakeholder.name }}</td>
            <td>{{ farmer.stakeholder.phone }}</td>
            <td>{{ farmer.land_area }}</td>
            <td>{{ farmer.crop_history }}</td>
            <td>{{ farmer.farmer_card_no }}</td>
            <td>
                <router-link :to="`/farmers/edit/${farmer.id}`" class="btn btn-primary">Edit</router-link>
                <button class="btn btn-danger" @click="deleteFarmer(farmer.id)">Delete</button>
            </td>
            </tr>
        </tbody>
    </table>
    <br>
    <hr>
<br> <br><br>
  </div>
</template>

<script setup>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
const baseUrl = import.meta.env.VITE_API_BASE_URL;
    const farmers = ref ([])

    let search = ref("");
    const searchFarmer=computed(()=>{
        let q = search.value.trim().toLowerCase();
        if(!q) return farmers.value; 
        return farmers.value.filter((farmer) => {
            return farmer.stakeholder.name.trim().toLowerCase().includes(q) 
            
        });
    });

const fetchFarmers =()=> {
    axios.get(`${baseUrl}/farmers`)
    .then(response => {
        console.log(response.data)
        farmers.value = response.data.farmers;
    })
    .catch(error => {
        console.error("Error fetching farmers:", error);
    })
}
onMounted(() => {
    fetchFarmers();
})

function deleteFarmer(id){
    axios.delete(`${baseUrl}/farmers/${id}`)
    .then(response=>{
        console.log(response);
        fetchFarmers();
    })
    .catch(error=>{
        console.log(error);
    })
}
</script>

<style>

</style>