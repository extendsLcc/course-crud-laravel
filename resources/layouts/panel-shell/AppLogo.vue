<script setup lang="ts">
import { GraduationCap } from 'lucide-vue-next'
</script>

<template>
  <router-link class="flex items-center gap-2 font-semibold hover:text-foreground/90" :href="route('home')">
    <div class="relative z-20 flex items-center text-lg font-medium">
      <GraduationCap
        class="mr-2 size-6"
      />
      <span>Courses Crud</span>
    </div>
  </router-link>
</template>
