<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
      <h2 class="text-2xl font-bold text-center mb-4">Login</h2>
      <form @submit.prevent="login">
        <div class="mb-4">
          <label class="block text-sm font-medium">Email</label>
          <input v-model="email" type="email" class="w-full p-2 border rounded-md">
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium">Password</label>
          <input v-model="password" type="password" class="w-full p-2 border rounded-md">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md">Login</button>
      </form>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import axios from "axios";

const email = ref("");
const password = ref("");

const login = async () => {
  try {
    const response = await axios.post("/login", { email: email.value, password: password.value });
    localStorage.setItem("token", response.data.access_token);
    router.visit("/dashboard"); // ✅ Pindah ke dashboard pakai Inertia
  } catch (error) {
    console.error("Login gagal:", error);
  }
};
</script>
