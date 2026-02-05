<template>
  <div class="page-wrapper">

    <!-- Header -->
    <div class="page-header">
      <h1>Create Farmer</h1>

      <router-link to="/farmers" class="btn btn-secondary">
        ← Back to List
      </router-link>
    </div>

    <!-- Success Message -->
    <div v-if="successMessage" class="alert-success">
      {{ successMessage }}
    </div>

    <!-- Form -->
    <form class="form-card" @submit.prevent="handleCreate">

      <div class="form-group">
        <label>Name</label>
        <input type="text" v-model="farmer.name" required />
      </div>

      <div class="form-group">
        <label>Phone</label>
        <input type="text" v-model="farmer.phone" required />
      </div>

      <div class="form-group">
        <label>Land Area</label>
        <input type="text" v-model="farmer.land_area" />
      </div>

      <div class="form-group">
        <label>Crop History</label>
        <input type="text" v-model="farmer.crop_history" />
      </div>

      <div class="form-group">
        <label>Farmer Card No</label>
        <input type="text" v-model="farmer.farmer_card_no" />
      </div>

      <div class="form-group">
        <label>Photo</label>
        <input type="file" @change="handlePhoto" />
      </div>

      <div class="form-actions">
        <button class="btn btn-primary" type="submit" :disabled="loading">
          {{ loading ? 'Saving...' : 'Create Farmer' }}
        </button>
      </div>

    </form>

  </div>
</template>



<script setup>
import axios from 'axios'
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'

const baseUrl = import.meta.env.VITE_API_BASE_URL
const router = useRouter()

const farmer = reactive({
  name: '',
  phone: '',
  land_area: '',
  crop_history: '',
  farmer_card_no: '',
  photo: null
})

const successMessage = ref('')
const loading = ref(false)

const handlePhoto = (e) => {
  farmer.photo = e.target.files[0]
}

const handleCreate = () => {
  loading.value = true

  let formData = new FormData()
  formData.append('farmer[name]', farmer.name)
  formData.append('farmer[phone]', farmer.phone)
  formData.append('farmer[land_area]', farmer.land_area)
  formData.append('farmer[crop_history]', farmer.crop_history)
  formData.append('farmer[farmer_card_no]', farmer.farmer_card_no)
  if (farmer.photo) {
    formData.append('photo', farmer.photo)
  }

  axios.post(`${baseUrl}/farmers`, formData)
    .then(() => {
      successMessage.value = '✅ Farmer created successfully! Redirecting...'

      setTimeout(() => {
        router.push('/farmers')
      }, 1500)
    })
    .catch(err => {
      console.log(err)
      loading.value = false
    })
}
</script>


<style>
.page-wrapper {
  max-width: 700px;
  margin: auto;
  padding: 20px;
}

.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.form-card {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,.06);
}

.form-group {
  margin-bottom: 14px;
}

.form-group label {
  display: block;
  font-weight: 600;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 8px 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
}

.form-actions {
  margin-top: 20px;
}

.alert-success {
  background: #e6f9f0;
  color: #0f5132;
  padding: 10px 14px;
  border-radius: 6px;
  margin-bottom: 15px;
}
</style>

