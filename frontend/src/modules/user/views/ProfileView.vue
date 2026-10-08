<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import { getProfileAction } from '../actions/read'
import type { ProfileDto } from '../dto/read'

const router = useRouter()
const profile = ref<ProfileDto | null>(null)
const error = ref('')
const loading = ref(true)

onMounted(async () => {
  if (!localStorage.getItem('auth_token')) {
    await router.replace({ name: 'registration' })
    return
  }

  try {
    profile.value = await getProfileAction()
  } catch (err: unknown) {
    const e = err as { response?: { status?: number; data?: { message?: string } }; message?: string }
    if (e.response?.status === 401) {
      localStorage.removeItem('auth_token')
      await router.replace({ name: 'registration' })
      return
    }
    error.value = e.response?.data?.message || e.message || 'Failed to load profile'
  } finally {
    loading.value = false
  }
})
</script>

<template>
  <main class="page">
    <section class="card">
      <h1>User profile</h1>
      <p v-if="loading">Loading…</p>
      <p v-else-if="error" class="error">{{ error }}</p>
      <div v-else-if="profile" class="data">
        <p><strong>ID:</strong> {{ profile.id }}</p>
        <p><strong>Email:</strong> {{ profile.email }}</p>
        <p><strong>Gender:</strong> {{ profile.gender }}</p>
        <p><strong>Created at:</strong> {{ profile.created_at }}</p>
      </div>
    </section>
  </main>
</template>

<style scoped>
.page {
  min-height: 100vh;
  display: grid;
  place-items: center;
  padding: 2rem 1rem;
  background:
    radial-gradient(circle at top right, rgba(14, 165, 233, 0.16), transparent 40%),
    #f8fafc;
}

.card {
  width: min(100%, 480px);
  padding: 2rem;
  border-radius: 12px;
  border: 1px solid #d8dee9;
  background: #fff;
  box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
}

h1 {
  margin-top: 0;
  color: #0f172a;
}

.data p {
  margin: 0.75rem 0;
  color: #334155;
  font-size: 1.05rem;
}

.error {
  color: #dc2626;
}
</style>
