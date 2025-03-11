<script setup lang="ts">
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const router = useRouter();
const form = ref({
  nip: "",
  nama: "",
  tempat_lahir: "",
  tgl_lahir: "",
  id_kelamin: "",
  alamat: "",
  id_agama: "",
  id_unit: "",
  tempat_tugas: "",
  no_hp: "",
  npwp: "",
  foto: null,
});

const createPegawai = async () => {
  try {
    const formData = new FormData();
    for (const key in form.value) {
      formData.append(key, form.value[key]);
    }

    await axios.post("/api/pegawai", formData, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
        "Content-Type": "multipart/form-data",
      },
    });

    router.push("/pegawai");
  } catch (error) {
    console.error("Gagal menambahkan pegawai:", error);
  }
};
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Pegawai</h1>

    <form @submit.prevent="createPegawai" class="space-y-4">
      <input v-model="form.nip" type="text" placeholder="NIP" class="border p-2 w-full" />
      <input v-model="form.nama" type="text" placeholder="Nama" class="border p-2 w-full" />
      <input v-model="form.tempat_lahir" type="text" placeholder="Tempat Lahir" class="border p-2 w-full" />
      <input v-model="form.tgl_lahir" type="date" class="border p-2 w-full" />
      <select v-model="form.id_kelamin" class="border p-2 w-full">
        <option value="1">Laki-laki</option>
        <option value="2">Perempuan</option>
      </select>
      <input v-model="form.alamat" type="text" placeholder="Alamat" class="border p-2 w-full" />
      <input v-model="form.id_agama" type="text" placeholder="Agama (ID)" class="border p-2 w-full" />
      <input v-model="form.id_unit" type="text" placeholder="Unit Kerja (ID)" class="border p-2 w-full" />
      <input v-model="form.tempat_tugas" type="text" placeholder="Tempat Tugas" class="border p-2 w-full" />
      <input v-model="form.no_hp" type="text" placeholder="No HP" class="border p-2 w-full" />
      <input v-model="form.npwp" type="text" placeholder="NPWP" class="border p-2 w-full" />
      <input type="file" @change="(e) => (form.foto = e.target.files[0])" class="border p-2 w-full" />

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
        Simpan
      </button>
    </form>
  </div>
</template>
