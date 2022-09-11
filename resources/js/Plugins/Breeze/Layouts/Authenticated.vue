<script setup>
const logout = () => {
  axios.post(route("logout"));
  location.reload();
};
</script>

<template>
  <div>
    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100">
        <div class="container px-5 max-w-6xl">
          <div class="flex justify-between">
            <div class="flex items-center">
              <Link :to="route('sites.index')">
                <img src="/images/sitecheck.svg" alt="SiteCheck" />
              </Link>
            </div>
            <Menu mode="horizontal" width="220px" name="0">
              <Submenu name="5">
                <template #title>Меню</template>
                <MenuItem name="1" :to="route('sites.index')">Сайты</MenuItem>
                <MenuItem name="2" :to="route('balance.index')"
                  >Оплата</MenuItem
                >
                <MenuItem name="3" :to="route('settings.index')"
                  >Настройки</MenuItem
                >
                <MenuItem name="4" @click="logout">Выход</MenuItem>
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
