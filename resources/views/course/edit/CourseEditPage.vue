<script setup lang="ts">
import { ArrowLeftIcon, ImageIcon } from 'lucide-vue-next'
import ContentShell from '@/layouts/ContentShell.vue'
import { Button, SaveButton } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Textarea } from '@/components/ui/textarea'
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { Label } from '@/components/ui/label'
import { InputError } from '@/components/ui/input-error'
import ModulesList from '@/views/course/edit/ModulesList.vue'

const editingCourse = defineProps<App.Data.EditCourseOutputData>()

useHead({
  title: 'Edit Course',
  meta: [{
    name: 'description',
    content: 'Edit course settings, modules and lessons.',
  }],
})

const courseForm = useForm<Omit<App.Data.EditCourseOutputData, 'modules' | 'id'>>({
  method: 'PUT',
  url: route('courses.update', { course: editingCourse.id }),
  updateInitials: true,
  preserveScroll: true,
  fields: {
    name: editingCourse.name,
    description: editingCourse.description,
    cover_url: editingCourse.cover_url,
  },
})

function resetCourseForm() {
  courseForm.clearErrors()
  courseForm.reset()
}
</script>

<template layout="panel-shell">
  <ContentShell
    title="Course" :breadcrumb="{
      currentPage: 'Edit',
      items: [{ text: 'Courses', href: route('courses.index') }],
    }"
  >
    <template #head-actions>
      <router-link :href="route('courses.index')">
        <Button size="sm" variant="secondary" class="gap-1">
          <ArrowLeftIcon class="size-4" />
          Back
        </Button>
      </router-link>
    </template>

    <div class="grid gap-6 pt-4">
      <!-- Edit Course Form -->
      <Card>
        <CardHeader class="p-4">
          <CardTitle>Edit Course</CardTitle>
          <CardDescription>
            Change the course attributes on the form bellow you wants to change.
          </CardDescription>
        </CardHeader>
        <CardContent class="p-4 pt-0">
          <form
            id="course-form"
            class="space-y-4"
            @submit.prevent="courseForm.submit"
            @reset.prevent="resetCourseForm"
          >
            <div class="flex flex-col space-y-2">
              <Label html-for="name">Name</Label>
              <div class="space-y-1">
                <Input
                  id="name"
                  v-model="courseForm.fields.name"
                  type="text"
                  required
                  :aria-invalid="courseForm.errors.name"
                  aria-errormessage="name-error"
                  placeholder="Enter name for the course"
                />
                <InputError
                  v-if="courseForm.errors.name"
                  id="name-error"
                >
                  {{ courseForm.errors.name }}
                </InputError>
              </div>
            </div>

            <div class="flex flex-col space-y-2">
              <Label html-for="description">Description</Label>
              <div class="space-y-1">
                <Textarea
                  id="description"
                  v-model="courseForm.fields.description"
                  :default-value="courseForm.fields.description"
                  type="text"
                  required
                  :aria-invalid="courseForm.errors.description"
                  aria-errormessage="description-error"
                  placeholder="Enter description for the course"
                />
                <InputError
                  v-if="courseForm.errors.description"
                  id="description-error"
                >
                  {{ courseForm.errors.description }}
                </InputError>
              </div>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-4">
              <Avatar class="size-32 self-center" shape="square">
                <AvatarImage :src="courseForm.fields.cover_url" alt="cover image preview" />
                <AvatarFallback>
                  <ImageIcon class="size-14 text-foreground/80" />
                </AvatarFallback>
              </Avatar>
              <div class="flex flex-auto flex-col space-y-2">
                <Label html-for="cover_url">Cover Image Url</Label>
                <div class="space-y-1">
                  <Input
                    id="cover_url"
                    v-model="courseForm.fields.cover_url"
                    :default-value="courseForm.fields.cover_url"
                    type="text"
                    required
                    :aria-invalid="courseForm.errors.cover_url"
                    aria-errormessage="cover_url-error"
                    placeholder="Enter cover image url for the course"
                  />
                  <InputError
                    v-if="courseForm.errors.cover_url"
                    id="cover_url-error"
                  >
                    {{ courseForm.errors.cover_url }}
                  </InputError>
                </div>
              </div>
            </div>
          </form>
        </CardContent>
        <CardFooter class="flex-wrap-reverse justify-end gap-2 border-t p-4">
          <Button form="course-form" variant="destructive" type="reset">
            Reset
          </Button>
          <SaveButton form="course-form" :is-saving="courseForm.processing" />
        </CardFooter>
      </Card>
      <!-- /Edit Course Form -->

      <!-- Course Modules -->
      <ModulesList :editing-course="editingCourse" />
      <!-- /Course Modules -->
    </div>
  </ContentShell>
</template>
