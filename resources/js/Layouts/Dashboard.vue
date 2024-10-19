<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ThemeToggle from '@/Components/ThemeToggle.vue';
import { Badge } from '@/ShadComponents/ui/badge';

import { Button } from '@/ShadComponents/ui/button';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger
} from '@/ShadComponents/ui/dropdown-menu';
import { Input } from '@/ShadComponents/ui/input';
import { Sheet, SheetContent, SheetTrigger } from '@/ShadComponents/ui/sheet';
import { Link as Link } from '@inertiajs/vue3';
import {
  Bell,
  CircleUser,
  Home,
  LineChart,
  Menu,
  Package,
  Search,
  ShoppingCart,
  Users
} from 'lucide-vue-next';
</script>

<template>
  <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
    <div class="bg-muted/40 hidden border-r dark:border-slate-800 md:block">
      <div class="flex h-full max-h-screen flex-col gap-2">
        <div class="flex h-14 items-center border-b px-4 dark:border-slate-800 lg:h-[60px] lg:px-6">
          <Link href="/" class="flex items-center gap-2 font-semibold">
            <ApplicationLogo />
          </Link>
          <Button variant="outline" size="icon" class="ml-auto h-8 w-8">
            <Bell class="h-4 w-4" />
            <span class="sr-only">Toggle notifications</span>
          </Button>
        </div>
        <div class="flex-1">
          <nav class="grid items-start px-2 text-sm font-medium lg:px-4">
            <Button as-child variant="ghost">
              <Link
                href="/dashboard"
                class="text-muted-foreground hover:text-primary flex items-center !justify-start gap-3 rounded-lg px-3 py-2 !text-left transition-all"
              >
                <Home class="h-4 w-4" />
                Dashboard
              </Link>
            </Button>
            <Button as-child variant="ghost">
              <Link
                href="/dashboard/orders"
                class="text-muted-foreground hover:text-primary flex items-center !justify-start gap-3 rounded-lg px-3 py-2 transition-all"
              >
                <ShoppingCart class="h-4 w-4" />
                Orders
                <Badge
                  class="ml-auto flex h-6 w-6 shrink-0 items-center justify-center rounded-full"
                >
                  6
                </Badge>
              </Link>
            </Button>
            <Button as-child variant="ghost" class="justify-start">
              <Link
                href="/dashboard/products"
                class="bg-muted text-primary hover:text-primary flex items-center gap-3 rounded-lg px-3 py-2 transition-all"
              >
                <Package class="h-4 w-4" />
                Products
              </Link>
            </Button>
            <Button as-child variant="ghost" class="justify-start">
              <Link
                href="/dashboard/customers"
                class="text-muted-foreground hover:text-primary flex items-center gap-3 rounded-lg px-3 py-2 transition-all"
              >
                <Users class="h-4 w-4" />
                Customers
              </Link>
            </Button>
            <Button as-child variant="ghost" class="justify-start">
              <Link
                href="/dashboard/analytics"
                class="text-muted-foreground hover:text-primary flex items-center gap-3 rounded-lg px-3 py-2 transition-all"
              >
                <LineChart class="h-4 w-4" />
                Analytics
              </Link>
            </Button>
          </nav>
        </div>
      </div>
    </div>
    <div class="flex flex-col">
      <header
        class="bg-muted/40 flex h-14 items-center gap-4 border-b px-4 dark:border-slate-800 lg:h-[60px] lg:px-6"
      >
        <Sheet>
          <SheetTrigger as-child>
            <Button variant="outline" size="icon" class="shrink-0 md:hidden">
              <Menu class="h-5 w-5" />
              <span class="sr-only">Toggle navigation menu</span>
            </Button>
          </SheetTrigger>
          <SheetContent side="left" class="flex flex-col">
            <nav class="grid gap-2 text-lg font-medium">
              <Link href="/" class="flex items-center gap-2 text-lg font-semibold">
                <ApplicationLogo />
              </Link>
              <Link
                :href="route('dashboard')"
                class="text-muted-foreground hover:text-foreground mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2"
              >
                <Home class="h-5 w-5" />
                Dashboard
              </Link>
              <Link
                :href="route('dashboard.products')"
                class="text-muted-foreground hover:text-foreground mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2"
              >
                <Package class="h-5 w-5" />
                Products
              </Link>
              <Link
                :href="route('dashboard.customers')"
                class="text-muted-foreground hover:text-foreground mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2"
              >
                <Users class="h-5 w-5" />
                Customers
              </Link>
              <Link
                href="#"
                class="text-muted-foreground hover:text-foreground mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2"
              >
                <LineChart class="h-5 w-5" />
                Analytics
              </Link>
            </nav>
          </SheetContent>
        </Sheet>
        <div class="w-full flex-1">
          <form>
            <div class="relative">
              <Search class="text-muted-foreground absolute left-2.5 top-2.5 h-4 w-4" />
              <Input
                type="search"
                placeholder="Search products..."
                class="bg-background w-full appearance-none pl-8 shadow-none dark:bg-slate-800 md:w-2/3 lg:w-1/3"
              />
            </div>
          </form>
        </div>
        <ThemeToggle />
        <DropdownMenu>
          <DropdownMenuTrigger as-child>
            <Button variant="secondary" size="icon" class="rounded-full">
              <CircleUser class="h-5 w-5" />
              <span class="sr-only">Toggle user menu</span>
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuLabel>My Account</DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem>Settings</DropdownMenuItem>
            <DropdownMenuItem>Support</DropdownMenuItem>
            <DropdownMenuSeparator />
            <DropdownMenuItem>Logout</DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      </header>
      <slot />
    </div>
  </div>
</template>
