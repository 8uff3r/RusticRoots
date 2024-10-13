<script setup lang="ts">
import { Link as Link } from '@inertiajs/vue3';
import GlowBorder from '../Inspira/GlowBorder.vue';
import BentoGrid from '../Inspira/BentoGrid/BentoGrid.vue';
import BentoGridItem from '../Inspira/BentoGrid/BentoGridItem.vue';
import { Button } from '@/ShadComponents/ui/button';

defineProps<{
  offers: {
    name: string;
    imgs: string[];
    id: number;
    price: number;
    offer_price: number;
    description: string;
  }[];
}>();
</script>
<template>
  <div class="mx-16 mb-4 mt-8 flex items-end text-left text-4xl font-bold dark:text-white">
    <span>Special Offers</span>
  </div>
  <BentoGrid class="mx-auto max-w-4xl p-4">
    <template v-for="(o, index) in offers" :key="index">
      <BentoGridItem
        :href="`/product/${o.id}`"
        :class="index === 3 || index === 6 ? 'md:col-span-2' : ''"
        class="group relative"
      >
        <template #header>
          <img
            :src="o.imgs[0]"
            class="h-full w-full rounded object-cover transition group-hover:scale-[.98]"
          />
          <div
            class="lef absolute top-0 rounded-br-lg rounded-tl bg-amber-600 px-2 py-1 text-white"
          >
            {{ Math.floor(((o.price - o.offer_price) / o.price) * 100) }}%
            <span class="font-bold italic">OFF!</span>
          </div>
        </template>

        <template #title>
          <strong>{{ o.name }}</strong>
        </template>

        <template #description>
          <p>{{ o.description }}</p>
        </template>
      </BentoGridItem>
    </template>
  </BentoGrid>
</template>
