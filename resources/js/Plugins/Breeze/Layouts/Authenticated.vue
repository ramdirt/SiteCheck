<script setup>
import { usePage } from "@inertiajs/inertia-vue3";

const user = usePage().props.value.auth.user;

const logout = () => {
  axios.post(route("logout"));
  location.reload();
};

const paid_up_to = new Date(user.paid_up_to).toLocaleDateString();
</script>

<template>
  <div>
    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100">
        <div class="container px-5 max-w-6xl">
          <div class="flex justify-between">
            <div class="flex items-center">
              <Link to="/">
                <img src="/images/sitecheck.svg" alt="SiteCheck" />
              </Link>
            </div>
            <Menu mode="horizontal" :theme="theme" width="220px">
              <Submenu>
                <template #title>Меню</template>
                <MenuItem :to="route('sites.index')">Сайты</MenuItem>
                <MenuItem :to="route('plans.index')">Оплата</MenuItem>
                <MenuItem :to="route('settings.index')">Настройки</MenuItem>
                <MenuItem @click="logout">Выход</MenuItem>
              </Submenu>
            </Menu>
          </div>
        </div>
      </nav>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
