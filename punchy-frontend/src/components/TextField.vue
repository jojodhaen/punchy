<script lang="ts" setup>
defineProps(['name', 'type'])

const model = defineModel()
</script>

<template>
  <label :for="type">{{ name.charAt(0).toUpperCase() + name.slice(1) }}</label>
  <input :id="type" v-model="model" :type="type" required />
</template>

<style scoped>
label {
  font-family: 'Bodoni Moda SC', serif;
  font-size: 1.2rem;
  font-weight: 400;
  padding-left: 0.5rem;
}

input {
  font-family: 'Bodoni Moda SC', serif;
  font-size: 1rem;
  font-weight: 400;
  padding: 0.5rem;
  margin-bottom: 1rem;
  border: none;
  border-radius: 0.5rem;
  background-color: #a87676;
  color: white;
}
</style>
