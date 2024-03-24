<script setup lang="ts">
import { Menu } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Sheet, SheetContent, SheetHeader, SheetTitle, SheetTrigger } from '@/components/ui/sheet'
import { Separator } from '@/components/ui/separator'
import { AppLogo, NavMenu } from '@/layouts/panel-shell/'

const [isMenuOpen, toggleMenu] = useToggle(false)

registerHook('navigated', () => toggleMenu(false))
</script>

<template>
  <Sheet v-model:open="isMenuOpen">
    <SheetTrigger as-child>
      <Button
        variant="ghost"
        class="mr-2 shrink-0 px-2 text-base hover:bg-transparent focus-visible:bg-transparent focus-visible:ring-0 focus-visible:ring-offset-0 md:hidden"
      >
        <Menu class="size-6" />
        <span class="sr-only">Toggle Menu</span>
      </Button>
    </SheetTrigger>
    <SheetContent side="left" class="w-5/6 sm:w-4/5 sm:max-w-sm ">
      <SheetHeader>
        <SheetTitle>
          <AppLogo />
        </SheetTitle>
        <Separator />
        <NavMenu />
      </SheetHeader>
    </SheetContent>
  </Sheet>
</template>
