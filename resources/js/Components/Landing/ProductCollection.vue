<script setup lang="ts">
import { Button } from '@/ShadComponents/ui/button';
import { Link } from '@inertiajs/vue3';
import GlowBorder from '../Inspira/GlowBorder.vue';
defineProps<{
  products: { id: number; imgs: string[]; name: string; price: number; offer_price: number }[];
}>();
</script>
<template>
  <GlowBorder
    :color="['#A07CFE', '#FE8FB5', '#FFBE7B']"
    class="mx-14 rounded-lg px-4 py-8 sm:px-6 sm:py-12 lg:px-8"
  >
    <header>
      <h2 class="text-xl font-bold text-gray-900 dark:text-slate-200 sm:text-3xl">
        Our Premium Products
        <Link href="/products" class="text-sm hover:underline" variant="link">View More</Link>
      </h2>

      <p class="mt-4 max-w-md text-gray-500 dark:text-slate-300">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque praesentium cumque iure
        dicta incidunt est ipsam, officia dolor fugit natus?
      </p>
    </header>

    <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <li v-for="(p, i) in products" :key="i">
        <Link :href="`/product/${p.id}`" class="group relative block overflow-hidden rounded-lg">
          <img
            :src="p.imgs[0]"
            class="h-[350px] w-full object-cover transition duration-500 group-hover:scale-105 sm:h-[450px]"
          />

          <div
            class="absolute bottom-0 flex h-0 w-full flex-col gap-4 overflow-hidden bg-white px-3 transition-all group-hover:h-14 group-hover:pt-2 dark:text-neutral-800"
          >
            <h3
              class="h-0 text-xs text-gray-700 group-hover:underline group-hover:underline-offset-4 dark:text-neutral-800"
            >
              {{ p.name }}
            </h3>

            <p class="h-0">
              <span class="sr-only"> Price </span>

              <span class="tracking-wider text-gray-900 dark:text-neutral-800">
                ${{ (!p.offer_price ? p.price : p.offer_price).toLocaleString() }}
              </span>
            </p>
          </div>
        </Link>
      </li>
    </ul>
  </GlowBorder>
</template>
