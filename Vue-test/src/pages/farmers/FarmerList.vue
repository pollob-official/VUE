<template>
    <div class="page-wrapper">

        <!-- Header -->
        <div class="page-header">
            <!-- Line 1 -->
            <h1 class="page-title">Farmer List</h1>

            <!-- Line 2 -->
            <div class="header-actions-row">
                <router-link to="/farmers/create" class="btn btn-success">
                    ➕ Add New Farmer
                </router-link>

                <input type="text" class="search-input" placeholder="🔍 Search farmer by name..." v-model="search" />
            </div>
        </div>

        <!-- Table -->
        <div class="table-wrapper">
            <table class="farmer-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Land Area</th>
                        <th>Crop History</th>
                        <th>Farmer Card No</th>
                        <th width="140">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="farmer in searchFarmer" :key="farmer.id">
                        <td>{{ farmer.id }}</td>

                        <td>
                            <img class="avatar" :src="`${imgUrl}/${farmer.stakeholder?.photo ?? 'default.jpg'}`"
                                alt="photo" />
                        </td>

                        <td>{{ farmer.stakeholder?.name ?? '-' }}</td>
                        <td>{{ farmer.stakeholder?.phone ?? '-' }}</td>
                        <td>{{ farmer.land_area }}</td>
                        <td>{{ farmer.crop_history }}</td>
                        <td>{{ farmer.farmer_card_no }}</td>

                        <td class="actions">
                            <router-link :to="`/farmers/edit/${farmer.id}`" class="btn btn-sm btn-primary">
                                Edit
                            </router-link>

                            <button class="btn btn-sm btn-danger" @click="deleteFarmer(farmer.id)">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <tr v-if="searchFarmer.length === 0">
                        <td colspan="8" class="no-data">
                            No farmers found
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>


<script setup>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
const baseUrl = import.meta.env.VITE_API_BASE_URL;
const imgUrl = import.meta.env.VITE_BASE_IMG_URL;
const farmers = ref([])

let search = ref("");
const searchFarmer = computed(() => {
    let q = search.value.trim().toLowerCase();
    if (!q) return farmers.value;
    return farmers.value.filter((farmer) => {
        const name = farmer.stakeholder?.name ?? "";
        return name.trim().toLowerCase().includes(q);
    });
});

const fetchFarmers = () => {
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

function deleteFarmer(id) {
    axios.delete(`${baseUrl}/farmers/${id}`)
        .then(response => {
            console.log(response);
            fetchFarmers();
        })
        .catch(error => {
            console.log(error);
        })
}
</script>

<style>
.page-wrapper {
    padding: 20px;
}

.page-header {
    margin-bottom: 15px;
}

.page-title {
    margin-bottom: 12px;
}

.header-actions-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.search-input {
    width: 240px;
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
}


.table-wrapper {
    overflow-x: auto;
}

.farmer-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
}

.farmer-table th {
    background: #f5f7fa;
    text-align: left;
    padding: 10px;
    font-weight: 600;
    border-bottom: 2px solid #ddd;
}

.farmer-table td {
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.farmer-table tr:hover {
    background: #f9fafb;
}

.avatar {
    width: 45px;
    height: 45px;
    object-fit: cover;
    border-radius: 50%;
    border: 1px solid #ddd;
}

.actions {
    display: flex;
    gap: 6px;
}

.no-data {
    text-align: center;
    padding: 20px;
    color: #888;
}
</style>
