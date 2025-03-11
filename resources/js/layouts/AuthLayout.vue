<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
      <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <!-- Pastikan Title & Description Muncul -->
        <h2 class="text-xl font-bold text-center mb-4">{{ title }}</h2>
        <p class="text-sm text-center text-gray-600 mb-6">{{ description }}</p>
        
        <!-- Slot untuk konten -->
        <slot /> 
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  defineProps<{
    title: string;
    description: string;
  }>();
  </script>
  