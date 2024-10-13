<script setup lang="ts">
import Footer from '@/Components/Footer.vue';
import BentoGrid from '@/Components/Inspira/BentoGrid/BentoGrid.vue';
import BentoGridItem from '@/Components/Inspira/BentoGrid/BentoGridItem.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Product } from '@/types';

defineProps<{
  products: Product[];
}>();
</script>
<template>
  <AuthenticatedLayout />
  {{ $page.props.auth }}
  <BentoGrid class="mx-auto mt-10 max-w-4xl">
    <BentoGridItem
      :href="`/product/${p.id}`"
      v-for="(p, index) in products"
      :key="index"
      :class="index === 3 || index === 6 ? 'md:col-span-2' : ''"
    >
      <template #header>
        <img
          :src="p.imgs[0]"
          class="h-full w-full rounded object-cover transition group-hover:scale-[.98]"
        />
      </template>

      <template #title>
        <strong>{{ p.name }}</strong>
      </template>

      <template #icon> </template>

      <template #description>
        <p class="flex gap-2 text-sm font-bold">
          <span :class="{ 'line-through': p.offer_price ?? 0 > 0 }">${{ p.price }}</span>
          <span v-if="p.offer_price ?? 0 > 0">${{ p.offer_price }}</span>
        </p>
        <p>{{ p.description }}</p>
      </template>
    </BentoGridItem>
  </BentoGrid>
  <Footer />
</template>
