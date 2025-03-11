<script setup lang="ts">
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();
const pegawaiList = ref([]);
const loading = ref(true);

const fetchPegawai = async () => {
  try {
    const response = await axios.get("/api/pegawai", {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    });
    pegawaiList.value = response.data;
  } catch (error) {
    console.error("Gagal mengambil data pegawai:", error);
  } finally {
    loading.value = false;
  }
};

const deletePegawai = async (id) => {
  if (confirm("Yakin ingin menghapus pegawai ini?")) {
    try {
      await axios.delete(`/api/pegawai/${id}`, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      fetchPegawai();
    } catch (error) {
      console.error("Gagal menghapus pegawai:", error);
    }
  }
};

onMounted(fetchPegawai);
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Pegawai</h1>
    <button
      @click="router.push('/pegawai/create')"
      class="bg-blue-500 text-white px-4 py-2 rounded mb-4"
    >
      Tambah Pegawai
    </button>

    <table class="w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-gray-200">
          <th class="border p-2">NIP</th>
          <th class="border p-2">Nama</th>
          <th class="border p-2">Jabatan</th>
          <th class="border p-2">Aksi</th>
        </tr>
      </thead>
      <tbody v-if="!loading">
        <tr v-for="pegawai in pegawaiList" :key="pegawai.id_pegawai" class="text-center">
          <td class="border p-2">{{ pegawai.nip }}</td>
          <td class="border p-2">{{ pegawai.nama }}</td>
          <td class="border p-2">{{ pegawai.tempat_tugas }}</td>
          <td class="border p-2">
            <button
              @click="router.push(`/pegawai/edit/${pegawai.id_pegawai}`)"
              class="bg-yellow-500 text-white px-3 py-1 rounded mr-2"
            >
              Edit
            </button>
            <button
              @click="deletePegawai(pegawai.id_pegawai)"
              class="bg-red-500 text-white px-3 py-1 rounded"
            >
              Hapus
            </button>
          </td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr>
          <td colspan="4" class="text-center p-4">Loading data pegawai...</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
