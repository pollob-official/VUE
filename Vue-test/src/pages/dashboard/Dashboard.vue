<script setup>
import { ref } from 'vue';
import Counter from '../../components/Counter.vue';


let Name= "Pollob";
let html = "<span style='color: blue;'>Pabna</span> <span style='color: green;'>Bangladesh</span>"

let active= ref(true);
const changeName = ()=>{
  active.value= !active.value;
}

let students= ["Rahim", "Karim", "Jabbar", "Salam"];
</script>



<template>
<h1>Hello!   <span v-text="Name"></span></h1>
<h2>Address: <span v-html="html"></span></h2>
    <Counter/>  
<h1 v-if="active">Pollob Ahmed Sagor</h1>
<h2 v-else>Full Stack Web Developer</h2>
<button style=" background: red;" v-on:click="changeName">ChangeName</button>
<ol>
    <li v-for="(student, i) in students" :key="i">{{ student }}</li>
</ol>
</template>

<style scoped>

</style>
