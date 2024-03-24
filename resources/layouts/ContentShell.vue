<script setup lang="ts">
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbPage,
  BreadcrumbSeparator,
} from '@/components/ui/breadcrumb'

const props = defineProps<{
  title: string
  breadcrumb?: {
    items: Array<{
      href: string
      text: string
    }>
    currentPage: string
  }
}>()
</script>

<template>
  <div class="flex h-full flex-col space-y-2 rounded-xl bg-card p-8 pt-4">
    <slot v-if="props.breadcrumb" name="breadcrumb">
      <Breadcrumb>
        <BreadcrumbList>
          <BreadcrumbItem>
            <BreadcrumbLink>
              <router-link :href="route('home')">
                Home
              </router-link>
            </BreadcrumbLink>
          </BreadcrumbItem>
          <BreadcrumbSeparator />
          <template v-for="item in props.breadcrumb.items" :key="item.text">
            <BreadcrumbItem>
              <BreadcrumbLink>
                <router-link :href="item.href">
                  {{ item.text }}
                </router-link>
              </BreadcrumbLink>
            </BreadcrumbItem>
            <BreadcrumbSeparator />
          </template>
          <BreadcrumbItem>
            <BreadcrumbPage>{{ props.breadcrumb.currentPage }}</BreadcrumbPage>
          </BreadcrumbItem>
        </BreadcrumbList>
      </Breadcrumb>
    </slot>
    <div class="flex flex-wrap items-center justify-between gap-2">
      <div>
        <slot name="head-title">
          <h2 class="text-2xl font-bold tracking-tight">
            {{ props.title }}
          </h2>
        <!-- <p class="text-muted-foreground">
          Page description placeholder
        </p> -->
        </slot>
      </div>
      <div class="flex items-center space-x-2">
        <slot name="head-actions" />
      </div>
    </div>
    <slot />
  </div>
</template>
