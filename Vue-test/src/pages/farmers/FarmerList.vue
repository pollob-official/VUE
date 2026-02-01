<template>
  <div>
    <h1>Farmer List</h1>
<hr>
<br>
    <table>
        <thead>
            <tr>
            <th>ID</th>
            <th>Crop History</th>
            <th>Farmer Card No</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="farmer in farmers" :key="farmer.id">
            <td>{{ farmer.id }}</td>
            <td>{{ farmer.crop_history }}</td>
            <td>{{ farmer.farmer_card_no }}</td>
            <td>
                <button>Edit</button>
                <button>Delete</button>
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
import { onMounted, ref } from 'vue';
const baseUrl = import.meta.env.VITE_API_BASE_URL;

    const farmers = ref ([])

const getFarmers = () => {
    axios.get('http://127.0.0.1:8000/api/farmers')
    .then(response => {
        console.log(response.data.farmers)
        farmers.value = response.data.farmers;
    })
    .catch(error => {
        console.error("Error fetching farmers:", error);
    })
}
onMounted(() => {
    getFarmers();
});
</script>

<style>

</style>