<script setup lang="ts">
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { registerUserAction } from '../actions/create'
import type { CreateUserDto, Gender } from '../dto/create'
import { validateCreateUserDto } from '../dto/create'

const router = useRouter()

const form = reactive<CreateUserDto>({
  email: '',
  password: '',
  gender: '' as Gender,
})

const errors = reactive<Record<string, string>>({})
const showPassword = ref(false)
const loading = ref(false)
const serverError = ref('')

const genderOptions: { value: Gender; label: string }[] = [
  { value: 'male', label: 'Male' },
  { value: 'female', label: 'Female' },
  { value: 'other', label: 'Other' },
]

async function onSubmit() {
  serverError.value = ''
  Object.keys(errors).forEach((key) => delete errors[key])

  const validation = validateCreateUserDto(form)
  Object.assign(errors, validation)
  if (Object.keys(validation).length > 0) {
    return
  }

  loading.value = true
  try {
    await registerUserAction({ ...form })
    await router.push({ name: 'profile' })
  } catch (error: unknown) {
    const err = error as {
      validation?: Record<string, string>
      response?: { data?: { message?: string; errors?: Record<string, string[]> } }
      message?: string
    }

    if (err.validation) {
      Object.assign(errors, err.validation)
    } else if (err.response?.data?.errors) {
      Object.entries(err.response.data.errors).forEach(([key, messages]) => {
        errors[key] = messages[0]
      })
      serverError.value = err.response.data.message || 'Validation failed'
    } else {
      serverError.value = err.response?.data?.message || err.message || 'Registration failed'
    }
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <form class="registration-form" @submit.prevent="onSubmit">
    <h1>Registration</h1>
    <p class="subtitle">Create an account to view your profile</p>

    <label class="field">
      <span>Email</span>
      <input v-model="form.email" type="email" autocomplete="email" placeholder="user@example.com" />
      <small v-if="errors.email" class="error">{{ errors.email }}</small>
    </label>

    <label class="field">
      <span>Password</span>
      <div class="password-row">
        <input
          v-model="form.password"
          :type="showPassword ? 'text' : 'password'"
          autocomplete="new-password"
          placeholder="Min. 8 characters"
        />
        <button type="button" class="toggle" @click="showPassword = !showPassword">
          {{ showPassword ? 'Hide' : 'Show' }}
        </button>
      </div>
      <small v-if="errors.password" class="error">{{ errors.password }}</small>
    </label>

    <label class="field">
      <span>Gender</span>
      <select v-model="form.gender">
        <option disabled value="">Select gender</option>
        <option v-for="option in genderOptions" :key="option.value" :value="option.value">
          {{ option.label }}
        </option>
      </select>
      <small v-if="errors.gender" class="error">{{ errors.gender }}</small>
    </label>

    <p v-if="serverError" class="error server">{{ serverError }}</p>

    <button class="submit" type="submit" :disabled="loading">
      {{ loading ? 'Sending…' : 'Register' }}
    </button>
  </form>
</template>

<style scoped>
.registration-form {
  width: min(100%, 420px);
  margin: 0 auto;
  display: grid;
  gap: 1rem;
  padding: 2rem;
  border: 1px solid #d8dee9;
  border-radius: 12px;
  background: #fff;
  box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
}

h1 {
  margin: 0;
  font-size: 1.75rem;
  color: #0f172a;
}

.subtitle {
  margin: -0.5rem 0 0.5rem;
  color: #64748b;
}

.field {
  display: grid;
  gap: 0.4rem;
  font-size: 0.95rem;
  color: #334155;
}

input,
select {
  width: 100%;
  box-sizing: border-box;
  padding: 0.7rem 0.85rem;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  font: inherit;
  background: #fff;
}

input:focus,
select:focus {
  outline: 2px solid #38bdf8;
  border-color: transparent;
}

.password-row {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: 0.5rem;
}

.toggle,
.submit {
  border: 0;
  border-radius: 8px;
  cursor: pointer;
  font: inherit;
}

.toggle {
  padding: 0 0.9rem;
  background: #e2e8f0;
  color: #0f172a;
}

.submit {
  margin-top: 0.5rem;
  padding: 0.85rem 1rem;
  background: #0ea5e9;
  color: #fff;
  font-weight: 600;
}

.submit:disabled {
  opacity: 0.65;
  cursor: not-allowed;
}

.error {
  color: #dc2626;
}

.server {
  margin: 0;
}
</style>
