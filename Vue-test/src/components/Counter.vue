<template>
    <div>
        <button @click="decrease">-</button>
        <p>{{ count }}</p>
        <button @click="increase">+</button>
    </div>
</template>


<script setup>
import { ref } from 'vue';

let count = ref (0);

function increase(){
    count.value+=1;
}
function decrease(){
    count.value-=1;
}
</script>

<style>

</style>