<script setup lang="ts">
import { Button } from '@/ShadComponents/ui/button';
import { Link } from '@inertiajs/vue3';

defineProps<{ categories: { name: string; img: string; id: number }[] }>();
</script>
<template>
  <div class="mx-16 mb-4 mt-8 flex items-end text-left text-4xl font-bold dark:text-white">
    <span>Categories</span>
  </div>

  <div class="grid h-28 w-full grid-cols-4 gap-2 overflow-hidden px-10">
    <Link
      class="group relative overflow-hidden rounded-lg"
      v-for="(c, i) in categories"
      :key="i"
      :href="`/category/${c.name}`"
    >
      <img :src="c.img" alt="" class="h-28 w-full object-cover group-hover:blur-sm" />
      <span
        class="absolute bottom-0 left-0 -mb-[10%] -ml-[22%] flex h-1/2 w-1/2 select-none rounded-tr-lg bg-white transition-all group-hover:mb-0 group-hover:ml-0 dark:bg-slate-950"
      >
        <span
          class="absolute right-2 top-0 group-hover:right-auto group-hover:flex group-hover:h-full group-hover:w-full group-hover:items-center group-hover:justify-center group-hover:text-center"
          ><span>{{ c.name }}s</span></span
        >
      </span>
    </Link>
  </div>
</template>
