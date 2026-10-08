<script setup lang="ts">
import RegistrationForm from '../components/RegistrationForm.vue'
</script>

<template>
  <main class="page">
    <RegistrationForm />
  </main>
</template>

<style scoped>
.page {
  min-height: 100vh;
  display: grid;
  place-items: center;
  padding: 2rem 1rem;
  background:
    radial-gradient(circle at top left, rgba(14, 165, 233, 0.18), transparent 40%),
    radial-gradient(circle at bottom right, rgba(56, 189, 248, 0.15), transparent 35%),
    #f8fafc;
}
</style>
