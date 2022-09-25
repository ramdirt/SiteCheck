<template lang="pug">
header.container.max-w-6xl.px-6
  .div.flex.justify-between
    .flex.items-center.justify-start
      Link(:to="route('sites.index')")
        img(src="/images/sitecheck.svg", alt="SiteCheck")
    .flex.gap-8.py-6.justify-end
      .hidden
        div(v-if="$page.props.canLogin", class="sm:block")
          Link.text-sm.text-gray-700.underline(
            v-if="$page.props.auth.user",
            :href="route('sites.index')"
          ) Личный кабинет
          div(v-else)
          Link.text-sm.text-gray-700.underline(:href="route('login')") Авторизоваться
          Link.ml-4.text-sm.text-gray-700.underline(
            v-if="$page.props.canRegister",
            :href="route('register')"
          ) Зарегистрироваться

      Menu(
        mode="horizontal",
        width="220px",
        name="0",
        v-if="$page.props.canLogin"
      )
        Submenu(name="1")
          template(#title) Меню
          MenuItem(
            name="2",
            :to="route('sites.index')",
            v-if="$page.props.auth.user"
          ) Личный кабинет
          MenuItem(
            name="3",
            :to="route('login')",
            v-if="!$page.props.auth.user"
          ) Авторизоваться
          MenuItem(
            name="4",
            :to="route('register')",
            v-if="!$page.props.auth.user"
          ) Зарегистрироваться
          MenuItem(name="5", @click="logout", v-if="$page.props.auth.user") Выйти
</template>

<script setup>
const logout = () => {
  axios.post(route("logout"));
  location.reload();
};
</script>