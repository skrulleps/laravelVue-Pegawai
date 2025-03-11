<template>
    <header class="bg-blue-600 text-white p-4 flex justify-between items-center">
      <h1 class="text-xl font-bold">Dashboardasdasd</h1>
      <div class="flex items-center gap-4">
        <span v-if="user" class="text-sm">👤 {{ user.name }}</span>
        <button @click="logout" class="bg-red-500 px-4 py-2 rounded-md text-white hover:bg-red-600">Logout</button>
      </div>
    </header>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted } from "vue";
  import { router } from "@inertiajs/vue3";
  import axios from "axios";
  
  const user = ref<{ name: string } | null>(null);
  
  const fetchUser = async () => {
    try {
      const token = localStorage.getItem("token");
      if (!token) return;
  
      const response = await axios.get("/api/user", {
        headers: { Authorization: `Bearer ${token}` },
      });
  
      user.value = response.data;
    } catch (error) {
      console.error("Gagal mengambil data user:", error);
    }
  };
  
  const logout = async () => {
    try {
        await axios.post("/api/logout", {}, { 
        headers: { Authorization: `Bearer ${localStorage.getItem("token")}` } 
        });
    } catch (error) {
        console.error("Gagal logout:", error);
    }

    localStorage.removeItem("token");
    router.visit("/login");
    };

  
  onMounted(fetchUser);
  </script>
  