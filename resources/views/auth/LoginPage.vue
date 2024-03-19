<script setup lang="ts">
import { GraduationCap } from 'lucide-vue-next'
import LucideSpinner from '~icons/lucide/loader-2'

import { Button } from '@/components/ui/button'
import { Label } from '@/components/ui/label'
import { Input } from '@/components/ui/input'
import { InputError } from '@/components/ui/input-error'
import DarkThemeButton from '@/layouts/panel-layout/DarkThemeButton.vue'

useHead({
  title: 'Login - Course Crud Laravel',
})

const login = useForm({
  method: 'POST',
  url: route('auth.login'),
  fields: {
    email: '',
    password: '',
  },
  hooks: {
    fail(context) {
      console.error(context)
    },
    after(context) {
      console.warn(context)
    },
  },
})
</script>

<template>
  <div class="container relative grid h-full flex-col items-center justify-center bg-background lg:max-w-none lg:grid-cols-2 lg:px-0">
    <DarkThemeButton
      class="absolute right-4 top-4 md:right-8 md:top-8"
    >
      Login
    </DarkThemeButton>

    <div class="relative hidden h-full flex-col bg-muted p-10 text-white dark:border-r lg:flex">
      <div class="absolute inset-0 bg-zinc-900" />
      <div class="relative z-20 flex items-center text-lg font-medium">
        <GraduationCap
          class="mr-2 size-8"
        />
        Courses Crud Laravel
      </div>
      <div class="relative z-20 mt-auto">
        <blockquote class="space-y-2">
          <p class="text-lg">
            &ldquo;Hipotetic web app for managing courses for online e-learning platform.&rdquo;
          </p>
        </blockquote>
      </div>
    </div>
    <main class="lg:p-8">
      <section class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
        <div class="space-y-2">
          <h1 class="text-3xl font-bold text-foreground">
            Login to your account
          </h1>
          <p class="text-sm font-medium leading-none text-neutral-500 dark:text-neutral-400">
            Enter your email and password to access your account
          </p>
        </div>
        <form class="space-y-4" @submit.prevent="login.submit">
          <div class="space-y-2">
            <Label html-for="email">Email</Label>
            <div class="space-y-1">
              <Input
                id="email"
                v-model="login.fields.email"
                placeholder="you@example.com"
                required
                :aria-invalid="login.errors.email"
                aria-errormessage="email-error"
              />
              <InputError
                v-if="login.errors.email"
                id="email-error"
              >
                {{ login.errors.email }}
              </InputError>
            </div>
          </div>
          <div class="space-y-2">
            <Label html-for="password">Password</Label>
            <div class="space-y-1">
              <Input
                id="password"
                v-model="login.fields.password"
                type="password"
                required
                :aria-invalid="login.errors.password"
                aria-errormessage="password-error"
              />
              <InputError
                v-if="login.errors.password"
                id="password-error"
              >
                {{ login.errors.password }}
              </InputError>
            </div>
          </div>
          <div class="grid grid-cols-1 gap-4">
            <Button class="w-full">
              <LucideSpinner v-if="login.processing" class="mr-2 size-4 animate-spin" />
              Login
            </Button>
          </div>
        </form>
      </section>
    </main>
  </div>
</template>
