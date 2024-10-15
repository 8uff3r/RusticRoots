<script setup lang="ts">
import ProductsTable from '@/Components/Dashboard/ProductsTable.vue';
import Dashboard from '@/Layouts/Dashboard.vue';
import { Button } from '@/ShadComponents/ui/button';
import { Product } from '@/types';

defineProps<{
  products: Product[];
}>();
</script>

<template>
  <Dashboard>
    <main class="flex flex-1 flex-col items-center gap-4 p-4 lg:gap-6 lg:p-6">
      <div class="flex items-center">
        <h1 class="text-lg font-semibold md:text-2xl">Inventory</h1>
      </div>
      <template v-if="(products?.length ?? 0) === 0">
        <div
          class="flex flex-1 items-center justify-center rounded-lg border border-dashed shadow-sm"
        >
          <div class="flex flex-col items-center gap-1 text-center">
            <h3 class="text-2xl font-bold tracking-tight">You have no products</h3>
            <p class="text-muted-foreground text-sm">
              You can start selling as soon as you add a product.
            </p>
            <Button class="mt-4"> Add Product </Button>
          </div>
        </div>
      </template>
      <template v-else>
        <div class="mx-8 flex w-full flex-col items-center justify-start">
          <ProductsTable :products />
        </div>
      </template>
    </main>
  </Dashboard>
</template>
