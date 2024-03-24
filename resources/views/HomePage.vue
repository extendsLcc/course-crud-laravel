<script setup lang="ts">
import { FileVideoIcon, GraduationCapIcon, ImageIcon, LayoutListIcon, UserIcon } from 'lucide-vue-next'
import { truncateString } from '@/lib/utils'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'

const props = defineProps<App.Data.HomePageOutputData>()
</script>

<template layout="panel-shell">
  <div class="space-y-4 p-8 pt-4">
    <div class="flex flex-col">
      <div class="flex-1 space-y-4">
        <div class="flex items-center justify-between space-y-2">
          <h2 class="text-3xl font-bold tracking-tight">
            Dashboard
          </h2>
        </div>
      </div>
    </div>
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
      <Card>
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
          <CardTitle class="text-sm font-medium">
            Courses count
          </CardTitle>
          <GraduationCapIcon class="size-6" />
        </CardHeader>
        <CardContent>
          <div class="text-2xl font-bold">
            {{ props.coursesCount }}
          </div>
        </CardContent>
      </Card>
      <Card>
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
          <CardTitle class="text-sm font-medium">
            Modules count
          </CardTitle>
          <LayoutListIcon class="size-6" />
        </CardHeader>
        <CardContent>
          <div class="text-2xl font-bold">
            {{ props.modulesCount }}
          </div>
        </CardContent>
      </Card>
      <Card>
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
          <CardTitle class="text-sm font-medium">
            Lessons count
          </CardTitle>
          <FileVideoIcon class="size-6" />
        </CardHeader>
        <CardContent>
          <div class="text-2xl font-bold">
            {{ props.lessonsCount }}
          </div>
        </CardContent>
      </Card>
      <Card>
        <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
          <CardTitle class="text-sm font-medium">
            Users count
          </CardTitle>
          <UserIcon class="size-6" />
        </CardHeader>
        <CardContent>
          <div class="text-2xl font-bold">
            {{ props.usersCount }}
          </div>
        </CardContent>
      </Card>
    </div>
    <div class="grid grid-cols-1 gap-4 ">
      <Card class="col-span-3">
        <CardHeader>
          <CardTitle>Recently Updated Courses</CardTitle>
          <CardDescription>
            Last recent updated courses
          </CardDescription>
        </CardHeader>
        <CardContent>
          <div class="space-y-2 [&_>.flex:last-child]:border-0 [&_>.flex]:border-b">
            <div v-for="course in props.recentlyUpdatedCourses" :key="course.id" class="flex flex-wrap items-center border-border pb-2 hover:bg-muted/50">
              <router-link :href="route('courses.edit', { course: course.id })">
                <Avatar class="size-24" shape="square">
                  <AvatarImage :src="course.cover_url" alt="course cover" />
                  <AvatarFallback>
                    <ImageIcon class="size-4 text-foreground/80" />
                  </AvatarFallback>
                </Avatar>
              </router-link>
              <div class="ml-4 space-y-1">
                <router-link :href="route('courses.edit', { course: course.id })">
                  <p class="text-sm font-medium leading-none">
                    {{ course.name }}
                  </p>
                </router-link>
                <p class="text-sm text-muted-foreground">
                  {{ truncateString(course.description, 100) }}
                </p>
              </div>
              <div class="ml-auto font-medium">
                <div class="flex flex-col">
                  <span class="text-sm text-muted-foreground">
                    {{ course.modules_count }} module(s)
                  </span>
                  <span class="text-sm text-muted-foreground">
                    {{ course.lessons_count }} lesson(s)
                  </span>
                </div>
              </div>
            </div>
          </div>
        </CardContent>
      </Card>
    </div>
  </div>
</template>
