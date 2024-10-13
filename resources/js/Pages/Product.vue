<script setup lang="ts">
import Footer from '@/Components/Footer.vue';
import BentoCard from '@/Components/Inspira/BentoGrid/BentoCard.vue';
import BentoGrid from '@/Components/Inspira/BentoGrid/BentoGrid.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useAddToCart } from '@/query/cart';
import { Product } from '@/types';
import { Icon } from '@iconify/vue';
import { ref } from 'vue';

const props = defineProps<{
  product?: Product;
  related?: Product[];
}>();

const changeImage = (src: string) => {
  if (document.getElementById('mainImage'))
    (document.getElementById('mainImage')! as HTMLImageElement).src = src;
};
const quantity = ref(1);

const { mutate: addToCart } = useAddToCart();
</script>
<template>
  <AuthenticatedLayout>
    <div class="p-10 dark:text-white">
      <div class="container mx-auto px-4 py-8">
        <div class="-mx-4 flex flex-wrap">
          <div class="mb-8 w-full px-4 md:w-1/2">
            <img
              :src="product?.imgs[0]"
              alt="Product"
              class="mb-4 h-auto max-h-[500px] w-full rounded-lg object-contain shadow-md"
              id="mainImage"
            />
            <div class="flex justify-center gap-4 overflow-x-auto py-4">
              <img
                v-for="(img, i) in product?.imgs"
                :key="i"
                :src="img"
                class="size-16 cursor-pointer rounded-md object-cover opacity-60 transition duration-300 hover:opacity-100 sm:size-20"
                @click="changeImage(img)"
              />
            </div>
          </div>

          <!-- Product Details -->
          <div class="flex w-full flex-col justify-center px-4 md:w-1/2">
            <h2 class="mb-2 text-3xl font-bold">{{ product?.name }}</h2>
            <p class="mb-4 text-gray-600">SKU: {{ product?.id }}</p>
            <div class="mb-4">
              <span class="mr-2 text-2xl font-bold" v-if="product?.offer_price">
                ${{ product?.offer_price.toLocaleString() }}
              </span>
              <span class="text-gray-500" :class="product?.offer_price ? 'line-through' : ''">
                ${{ product?.price.toLocaleString() }}
              </span>
            </div>
            <div class="mb-4 flex items-center">
              <Icon
                icon="weui:star-filled"
                width="1.5rem"
                height="1.5rem"
                v-for="i in 4"
                :key="i"
              />
              <Icon icon="weui:star-outlined" width="1.5rem" height="1.5rem" />
              <span class="ml-2 text-gray-600 dark:text-gray-300">4.5 (120 reviews)</span>
            </div>
            <p class="mb-6 text-gray-700 dark:text-gray-300">
              {{ product?.description }}
            </p>

            <div class="mb-6">
              <label
                for="quantity"
                class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300"
              >
                Quantity
              </label>
              <input
                type="number"
                id="quantity"
                name="quantity"
                min="1"
                v-model="quantity"
                class="w-32 rounded-md border-gray-300 text-center shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-slate-800 dark:bg-slate-900"
              />
            </div>

            <div class="mb-6 flex space-x-4">
              <button
                @click="product && addToCart({ product: product.id, quantity })"
                class="flex items-center gap-2 rounded-md bg-amber-600 px-6 py-2 text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
              >
                <Icon icon="f7:cart" width="1.5rem" height="1.5rem" />
                Add to Cart
              </button>
              <button
                class="flex items-center gap-2 rounded-md bg-gray-200 px-6 py-2 text-gray-800 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-gray-900"
              >
                <Icon icon="f7:heart" width="1.5rem" height="1.5rem" />
                Wishlist
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="my-6 pl-20 text-2xl dark:text-white">More products like this:</div>
    <BentoGrid class="grid w-full gap-4 px-8 md:grid-cols-4">
      <BentoCard
        v-for="(p, index) in related"
        :href="`/product/${p.id}`"
        :key="index"
        :description="p.description"
        cta="Learn more"
        :name="p.name"
        class="col-span-1 w-full"
      >
        <template #background>
          <img
            class="absolute inset-0 h-full w-full object-cover dark:opacity-50"
            :src="p.imgs[0]"
          />
        </template>
      </BentoCard>
    </BentoGrid>
  </AuthenticatedLayout>
</template>
