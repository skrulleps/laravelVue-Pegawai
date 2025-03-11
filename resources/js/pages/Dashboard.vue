<template>
  <AppLayout>
    <Head title="Dashboard" />
    <div class="p-6 bg-white shadow-md rounded-lg">
      <h2 class="text-2xl font-semibold">Selamat Datang, {{ user?.name }}!</h2>
      <p class="text-gray-700 mb-6">Ini adalah halaman utama setelah login.</p>

      <!-- Card Jumlah Pegawai -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md">
          <h3 class="text-lg font-semibold">Total Pegawai</h3>
          <p class="text-3xl font-bold">{{ jumlahPegawai }}</p>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { onMounted, ref } from "vue";
// import { router } from "@inertiajs/vue3";
import axios from "axios";
import AppLayout from "@/layouts/AppLayout.vue";
import { Head } from "@inertiajs/vue3";

const user = ref<{ name: string } | null>(null);
const jumlahPegawai = ref<number>(0);

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

const fetchJumlahPegawai = async () => {
  try {
    const response = await axios.get("/api/pegawai/count");
    jumlahPegawai.value = response.data.jumlah;
  } catch (error) {
    console.error("Gagal mengambil jumlah pegawai:", error);
  }
};

onMounted(() => {
  fetchUser();
  fetchJumlahPegawai();
});
</script>
