<script setup lang="ts">
import Categories from '@/Components/Landing/Categories.vue';
import ProductCollectionLanding from '@/Components/Landing/ProductCollection.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Carousel, CarouselContent, CarouselItem } from '@/ShadComponents/ui/carousel';
import Autoplay from 'embla-carousel-autoplay';
import Offers from '@/Components/Landing/Offers.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import RadiantText from '@/Components/Inspira/RadiantText.vue';

defineProps(['topProducts', 'topCategories', 'topOffers']);

const carouselImgs = [
  'https://images.pexels.com/photos/1090638/pexels-photo-1090638.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
  'https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
  'https://images.pexels.com/photos/245208/pexels-photo-245208.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'
];
</script>

<template>
  <div class="relative">
    <img src="@/assets/wood.png" alt="" class="absolute right-0 top-0 -z-10 w-[36rem]" />
    <AuthenticatedLayout hide-logo>
      <div class="flex h-[calc(100svh_-_64px)] flex-col justify-evenly py-10">
        <div class="mr-40 flex select-none flex-col gap-2">
          <ApplicationLogo class="mx-auto mt-32 whitespace-nowrap text-7xl" />
          <RadiantText :duration="4">
            <span class="mx-auto font-bold italic dark:text-inherit">
              Crafting Nature’s Timeless Beauty
            </span>
          </RadiantText>
        </div>
        <div class="w-full px-4">
          <div class="w-fu mx-auto mt-20 h-96 max-w-[800px] overflow-hidden rounded-2xl">
            <Carousel
              :plugins="[
                Autoplay({
                  delay: 2000
                })
              ]"
            >
              <CarouselContent>
                <CarouselItem v-for="(src, i) in carouselImgs" :key="i">
                  <img
                    class="h-96 w-[800px] rounded-2xl object-cover"
                    :src
                    :alt="`carousel-${i}`"
                  />
                </CarouselItem>
              </CarouselContent>
            </Carousel>
          </div>
        </div>
      </div>
      <ProductCollectionLanding :products="topProducts" />
      <Categories :categories="topCategories" />
      <Offers :offers="topOffers" />
      <!-- <Reviews /> -->
      <!--
TODO:
Offer
Brands
-->
    </AuthenticatedLayout>
  </div>
</template>
