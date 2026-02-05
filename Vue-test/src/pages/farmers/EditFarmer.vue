<template>
  <div>
    <h2>Edit Farmer</h2>

    <form @submit.prevent="handleUpdate">

      <div>
        <label>Name</label>
        <input type="text" v-model="farmer.name">
      </div>

      <div>
        <label>Phone</label>
        <input type="text" v-model="farmer.phone">
      </div>

      <div>
        <label>Land Area</label>
        <input type="text" v-model="farmer.land_area">
      </div>

      <div>
        <label>Crop History</label>
        <input type="text" v-model="farmer.crop_history">
      </div>

      <div>
        <label>Farmer Card No</label>
        <input type="text" v-model="farmer.farmer_card_no">
      </div>

      <!-- Existing Photo Preview -->
      <div v-if="farmer.photo">
        <p>Current Photo:</p>
        <img 
          :src="`${baseUrl}/storage/photo/stakeholders/${farmer.photo}`"
          width="120"
        />
      </div>

      <!-- Photo Update -->
      <div>
        <label>Change Photo</label>
        <input type="file" @change="handlePhoto">
      </div>

      <br>
      <button type="submit">Update</button>

    </form>
  </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()
const farmerId = route.params.id
const baseUrl = import.meta.env.VITE_API_BASE_URL

const farmer = ref({
  name: '',
  phone: '',
  land_area: '',
  crop_history: '',
  farmer_card_no: '',
  photo: null
})

let newPhoto = null

const handlePhoto = (e) => {
  newPhoto = e.target.files[0]
}

const fetchFarmer = () => {
  axios.get(`${baseUrl}/farmers/${farmerId}`)
    .then(res => {
      const f = res.data.farmer
      farmer.value.name = f.stakeholder.name
      farmer.value.phone = f.stakeholder.phone
      farmer.value.land_area = f.land_area
      farmer.value.crop_history = f.crop_history
      farmer.value.farmer_card_no = f.farmer_card_no
      farmer.value.photo = f.stakeholder.photo
    })
}

const handleUpdate = () => {
  let formData = new FormData()

  formData.append('_method', 'PUT')
  formData.append('farmer[name]', farmer.value.name)
  formData.append('farmer[phone]', farmer.value.phone)
  formData.append('farmer[land_area]', farmer.value.land_area)
  formData.append('farmer[crop_history]', farmer.value.crop_history)
  formData.append('farmer[farmer_card_no]', farmer.value.farmer_card_no)

  if (newPhoto) {
    formData.append('photo', newPhoto)
  }

  axios.post(`${baseUrl}/farmers/${farmerId}`, formData)
    .then(res => {
      console.log(res)
      // router.push('/farmers')
    })
}

onMounted(fetchFarmer)
</script>

<style>
</style>