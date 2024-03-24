<script setup lang="ts">
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { Button } from '@/components/ui/button'
import { Avatar, AvatarFallback } from '@/components/ui/avatar'
import { useLoggedUser } from '@/composables/useLoggedUser'

const user = useLoggedUser()
const userNameInitials = computed(() => {
  return user.name
    .split(' ')
    .map(n => n[0])
    .slice(0, 2)
    .join('')
})
</script>

<template>
  <DropdownMenu>
    <DropdownMenuTrigger as-child>
      <Button
        class="size-8 rounded-full border border-gray-200 dark:border-gray-800"
        size="icon"
        variant="ghost"
      >
        <Avatar class="hover:bg-accent/80">
          <!-- <AvatarImage :src="user.avatar_url" :alt="user avatar" /> -->
          <AvatarFallback>{{ userNameInitials }}</AvatarFallback>
        </Avatar>
        <span class="sr-only">Toggle user menu</span>
      </Button>
    </DropdownMenuTrigger>
    <DropdownMenuContent align="end">
      <DropdownMenuLabel>{{ user.email }}</DropdownMenuLabel>
      <DropdownMenuSeparator />
      <DropdownMenuItem>
        Settings
      </DropdownMenuItem>
      <DropdownMenuSeparator />
      <router-link
        :href="route('auth.logout')"
        :as="DropdownMenuItem"
        method="POST"
      >
        Logout
      </router-link>
    </DropdownMenuContent>
  </DropdownMenu>
</template>
