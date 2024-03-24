<script setup lang="ts">
import { AppLogo, DarkThemeSwitch, MobileNav, NavMenu, UserContextMenu } from '@/layouts/panel-shell'
import { Separator } from '@/components/ui/separator'
import SearchCommand from '@/layouts/panel-shell/SearchCommand.vue'

useHead({
  title: 'Home',
})
</script>

<template>
  <div
    class="min-h-screen w-full bg-background md:grid md:grid-cols-[220px_minmax(0,1fr)] lg:grid-cols-[240px_minmax(0,1fr)]"
  >
    <aside class="sticky top-0 hidden h-screen overflow-y-auto border-r border-border bg-background md:block">
      <div class="flex h-full max-h-screen flex-col gap-2">
        <div class="flex h-14 items-center justify-center border-b border-border px-4">
          <AppLogo />
        </div>
        <NavMenu />
      </div>
    </aside>

    <div class="flex w-full flex-col">
      <header
        class="sticky top-0 flex h-14 items-center gap-6 border-b border-border bg-background/80 px-4 backdrop-blur-lg md:px-8"
      >
        <MobileNav />

        <div class="flex flex-1 items-center justify-between space-x-2 md:justify-end">
          <div class="w-full flex-1 md:w-auto md:flex-none">
            <SearchCommand />
          </div>

          <DarkThemeSwitch />

          <UserContextMenu />
        </div>
      </header>

      <main class="flex-1 bg-background p-4 md:p-6">
        <slot />
      </main>

      <footer class="relative flex h-10 items-center justify-center bg-background/80">
        <Separator class="absolute top-0 w-3/5 sm:w-1/3" />
        <p class="text-muted-foreground">
          © 2024 @extendslcc
        </p>
      </footer>
    </div>
  </div>
</template>
