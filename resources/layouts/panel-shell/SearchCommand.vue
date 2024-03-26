<script setup lang="ts">
import { FilePlusIcon, GraduationCapIcon, HomeIcon, LogOutIcon, SearchIcon, UserIcon } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Kbd } from '@/components/ui/kbd'
import {
  CommandDialog,
  CommandEmpty,
  CommandGroup,
  CommandInput,
  CommandItem,
  CommandList,
  CommandSeparator,
} from '@/components/ui/command'
import { DialogDescription, DialogTitle, DialogTrigger } from '@/components/ui/dialog'

const isOpen = ref(false)
const { ctrl_k } = useMagicKeys({
  passive: false,
  onEventFired: (event) => {
    if (event.ctrlKey && event.key.toLowerCase() === 'k' && event.type === 'keydown')
      event.preventDefault()
  },
})

whenever(ctrl_k, () => isOpen.value = !isOpen.value)

function closeCommandDialog() {
  isOpen.value = false
}
</script>

<template>
  <CommandDialog v-model:open="isOpen">
    <DialogTitle class="sr-only">
      Search Command
    </DialogTitle>
    <DialogDescription class="sr-only">
      Search for a command or navigate using the keyboard.
    </DialogDescription>
    <template #trigger>
      <DialogTrigger class="w-full flex-auto sm:flex-1">
        <Button
          variant="outline"
          class="relative h-8 w-full justify-start rounded-[0.5rem] bg-background pl-8 text-sm font-normal text-muted-foreground shadow-none sm:pr-12 md:w-48 lg:w-64"
          as="span"
        >
          <SearchIcon class="absolute left-2.5 size-4 text-gray-500 dark:text-gray-400" />
          <span class="inline-flex">Search...</span>
          <Kbd class="pointer-events-none absolute right-[0.3rem] hidden h-5 select-none items-center gap-1 rounded border bg-muted px-1.5 font-mono text-[10px] font-medium opacity-100 md:flex">
            <span class="text-xs">⌘</span>K
          </Kbd>
        </Button>
      </DialogTrigger>
    </template>
    <CommandInput placeholder="Type a command or search..." />
    <CommandList>
      <CommandEmpty>No results found.</CommandEmpty>
      <CommandItem value="home" as-child @select="closeCommandDialog">
        <router-link :href="route('home')">
          <HomeIcon class="mr-2 size-4" />
          <span>Home</span>
        </router-link>
      </CommandItem>
      <CommandGroup heading="Course">
        <CommandItem value="course-list" as-child @select="closeCommandDialog">
          <router-link :href="route('courses.index')">
            <GraduationCapIcon class="mr-2 size-4" />
            <span>Lists Courses</span>
          </router-link>
        </CommandItem>
        <CommandItem value="course-create" as-child @select="closeCommandDialog">
          <router-link :href="`${route('courses.index')}#create`">
            <FilePlusIcon class="mr-2 size-4" />
            <span>Create New Course</span>
          </router-link>
        </CommandItem>
      </CommandGroup>
      <CommandSeparator />
      <CommandGroup heading="User">
        <CommandItem value="user-settings" disabled>
          <UserIcon class="mr-2 size-4" />
          <span>User Settings</span>
        </CommandItem>
        <CommandItem value="user-logout" as-child @select="closeCommandDialog">
          <router-link
            :href="route('auth.logout')"
            method="POST"
            value="user-logout"
          >
            <LogOutIcon class="mr-2 size-4" />
            <span>Logout</span>
          </router-link>
        </CommandItem>
      </CommandGroup>
    </CommandList>
  </CommandDialog>
</template>
