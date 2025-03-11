<template>
    <AuthBase title="Log in to your account" description="Enter your email and password below to log in">
      <form @submit.prevent="submit">
        <div class="mb-4">
          <label class="block text-sm font-medium">Email</label>
          <input v-model="form.email" type="email" class="w-full p-2 border rounded-md text-black">
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium">Password</label>
          <input v-model="form.password" type="password" class="w-full p-2 border rounded-md text-black focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md">Login</button>
      </form>
    </AuthBase>
  </template>
  
  <script setup lang="ts">
  import AuthBase from '@/layouts/AuthLayout.vue';
  import { useForm } from "@inertiajs/vue3";
  
  const form = useForm({
    email: "",
    password: "",
  });
  
  const submit = () => {
    form.post("/login", {
      onFinish: () => form.reset("password"),
    });
  };
  </script>
  