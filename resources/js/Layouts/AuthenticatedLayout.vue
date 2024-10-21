<script setup lang="ts">
import {
  NavigationMenu,
  NavigationMenuContent,
  NavigationMenuItem,
  NavigationMenuLink,
  NavigationMenuList,
  NavigationMenuTrigger,
  navigationMenuTriggerStyle
} from '@/ShadComponents/ui/navigation-menu';
import ThemeToggle from '@/Components/ThemeToggle.vue';
import CartSheet from '@/Components/Cart/CartSheet.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/ShadComponents/ui/button';
import Footer from '@/Components/Footer.vue';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger
} from '@/ShadComponents/ui/dropdown-menu';
import { CircleUser } from 'lucide-vue-next';

defineProps<{ hideLogo?: boolean }>();
const components: any[] = [];
</script>

<template>
  <header class="bg-transparent">
    <div class="flex h-16 items-center justify-between px-8">
      <Link href="/" class="md:flex md:items-center md:gap-12" :class="hideLogo ? 'invisible' : ''">
        <span class="sr-only">Home</span>
        <ApplicationLogo />
      </Link>

      <NavigationMenu class="dark:text-white">
        <NavigationMenuList>
          <NavigationMenuItem>
            <NavigationMenuTrigger>Categories</NavigationMenuTrigger>
            <NavigationMenuContent>
              <ul class="grid w-[400px] gap-3 p-4 md:w-[500px] md:grid-cols-2 lg:w-[600px]">
                <li v-for="component in components" :key="component.title">
                  <NavigationMenuLink as-child>
                    <Link
                      :href="component.href"
                      class="hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors"
                    >
                      <div class="text-sm font-medium leading-none">{{ component.title }}</div>
                      <p class="text-muted-foreground line-clamp-2 text-sm leading-snug">
                        {{ component.description }}
                      </p>
                    </Link>
                  </NavigationMenuLink>
                </li>
              </ul>
            </NavigationMenuContent>
          </NavigationMenuItem>
          <NavigationMenuItem>
            <NavigationMenuLink href="/about" :class="navigationMenuTriggerStyle()">
              About
            </NavigationMenuLink>
          </NavigationMenuItem>
        </NavigationMenuList>
      </NavigationMenu>

      <div class="flex items-center gap-4">
        <ThemeToggle />
        <CartSheet :products="[]" />
        <div class="sm:flex sm:gap-4" v-if="!$page.props.auth?.user">
          <Link
            class="rounded-md bg-amber-600 px-5 py-2.5 text-sm font-medium text-white shadow dark:hover:bg-amber-500"
            href="/login"
          >
            Login
          </Link>

          <div class="hidden sm:flex">
            <Link
              class="rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-amber-600 dark:bg-gray-800 dark:text-white dark:hover:text-white/75"
              href="/register"
            >
              Register
            </Link>
          </div>
        </div>
        <!-- <Link :href="route('profile.edit')"> -->
        <!--   <Button variant="outline" class="relative"> -->
        <!--     <Icon icon="iconamoon:profile-fill" width="1.5rem" height="1.5rem" /> -->
        <!--   </Button> -->
        <!-- </Link> -->
        <DropdownMenu v-else>
          <DropdownMenuTrigger as-child>
            <Button variant="secondary" size="icon" class="rounded-full">
              <CircleUser class="h-5 w-5" />
              <span class="sr-only">Toggle user menu</span>
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuLabel>{{ $page.props.auth?.user?.name }}</DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem>Settings</DropdownMenuItem>
            <DropdownMenuSeparator />
            <DropdownMenuItem>
              <Link href="/logout" method="post">Logout </Link>
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>

        <div class="block md:hidden">
          <button
            class="rounded bg-gray-100 p-2 text-gray-600 transition hover:text-gray-600/75 dark:bg-gray-800 dark:text-white dark:hover:text-white/75"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="size-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>
  <slot />
  <Footer />
</template>
