<template>
  <Link
    :href
    :class="
      cn(
        'group/bento shadow-input row-span-1 flex flex-col justify-between space-y-4 rounded-xl border border-transparent bg-white p-4 transition duration-200 hover:shadow-xl dark:border-white/[0.2] dark:bg-black dark:shadow-none',
        $props.class
      )
    "
  >
    <slot name="header" />
    <div class="transition duration-200 group-hover/bento:translate-x-2">
      <slot name="icon" />
      <div class="mb-2 mt-2 font-sans font-bold text-neutral-600 dark:text-neutral-200">
        <slot name="title" />
      </div>
      <div class="font-sans text-xs font-normal text-neutral-600 dark:text-neutral-300">
        <slot name="description" />
      </div>
    </div>
  </Link>
</template>

<script lang="ts" setup>
import { cn } from '@/lib/utils';
import { Link } from '@inertiajs/vue3';

defineProps<{
  class: string;
  href: string;
}>();
</script>
