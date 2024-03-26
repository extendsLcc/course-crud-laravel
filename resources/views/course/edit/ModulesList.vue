<script setup lang="ts">
import { ChevronDown } from 'lucide-vue-next'
import { AccordionTrigger } from 'radix-vue'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Separator } from '@/components/ui/separator'
import { Tooltip, TooltipContent, TooltipProvider, TooltipTrigger } from '@/components/ui/tooltip'

import { Accordion, AccordionContent, AccordionItem } from '@/components/ui/accordion'
import ModuleForm from '@/views/course/edit/ModuleForm.vue'
import ModuleDeleteActionButton from '@/views/course/edit/ModuleDeleteActionButton.vue'
import LessonForm from '@/views/course/edit/LessonForm.vue'
import LessonsList from '@/views/course/edit/LessonsList.vue'

const props = defineProps<{
  editingCourse: App.Data.EditCourseOutputData
}>()
</script>

<template>
  <Card>
    <CardHeader class="flex-row flex-wrap gap-x-2 p-4">
      <div class="flex flex-1 flex-col gap-2 gap-y-1.5">
        <CardTitle>Course Modules</CardTitle>
        <CardDescription>
          Manage the modules and lessons for the course.
        </CardDescription>
      </div>
      <ModuleForm :for-course="props.editingCourse" />
    </CardHeader>
    <CardContent class="p-4 pt-0">
      <TooltipProvider>
        <Accordion class="w-full [&_>div:last-child]:border-0" type="multiple">
          <div v-if="!props.editingCourse.modules.length" class="flex justify-center text-muted-foreground">
            No modules for this course.
          </div>
          <AccordionItem
            v-for="module in props.editingCourse.modules"
            :key="module.id"
            class="p-2 hover:bg-accent/50 dark:hover:bg-accent/25"
            :value="module.id"
          >
            <div class="flex w-full flex-wrap items-center justify-center ">
              <div class="flex flex-1 items-center gap-1">
                <!-- <Tooltip>
                  <TooltipTrigger as-child>
                    <Button
                      variant="ghost"
                      class="drag-handle cursor-grab p-2 active:cursor-grabbing"
                    >
                      <DragHandleDots2Icon class="size-5 " />
                      <span class="sr-only">Drag to reorder modules</span>
                    </Button>
                  </TooltipTrigger>
                  <TooltipContent>
                    Drag to reorder modules
                  </TooltipContent>
                </Tooltip> -->
                <span class="text-lg font-medium">{{ module.title }}</span>
              </div>
              <div class="flex gap-1">
                <ModuleForm :for-course="props.editingCourse" :editing-module="module" />

                <!-- Delete Module -->
                <ModuleDeleteActionButton :for-module="module" />
                <!-- /Delete Module -->

                <Separator orientation="vertical" class="h-[unset] grow" />

                <LessonForm :for-module="module" />

                <Tooltip>
                  <AccordionTrigger
                    as="span"
                    class="[&[data-state=open]_.collapse-icon]:rotate-180"
                  >
                    <TooltipTrigger as-child>
                      <Button
                        variant="ghost"
                        class="p-2"
                        type="button"
                      >
                        <ChevronDown class="collapse-icon size-5 shrink-0 rotate-0 transition-transform duration-200" />
                        <span class="sr-only">Collapse module lessons</span>
                      </Button>
                    </TooltipTrigger>
                    <TooltipContent>
                      Expand/Collapse Module lessons
                    </TooltipContent>
                  </AccordionTrigger>
                </Tooltip>
              </div>
            </div>
            <AccordionContent>
              <div v-auto-animate>
                <!-- ↑ fix animation -->
                <LessonsList v-if="module.lessons.length" :for-module="module" />
                <div v-else class="flex justify-center text-muted-foreground">
                  No lessons for this module.
                </div>
              </div>
            </AccordionContent>
          </AccordionItem>
        </Accordion>
      </TooltipProvider>
    </CardContent>
  </Card>
</template>
