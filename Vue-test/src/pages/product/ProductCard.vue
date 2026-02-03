<template>
  <div class="">
    <div class="card" style="width: 18rem;">
    <img :src="props.product.image" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">{{ props.product.title }}</h5>
    <p class="card-text">{{ props.product.description }}</p>
    <p class="card-text"> $ {{ props.product.price }}</p>
    <a href="#" class="btn btn-primary">Add To Cart</a>
  </div>
  </div>
  </div>
</template>

<script setup>
      let props=defineProps(["product"])
    //  console.log(product);
</script>

<style>

</style>