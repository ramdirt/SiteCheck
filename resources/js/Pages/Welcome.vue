<script setup>
defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>

<template lang="pug">
Head(title="Welcome")
header.container.max-w-6xl.px-12
  .div.flex.justify-between
    .flex.items-center.justify-start
      Link.text-sm.text-gray-700.underline(href="/") SiteCheck
    .flex.gap-8.py-6.justify-end
      div(v-if="canLogin", class="sm:block")
        Link.text-sm.text-gray-700.underline(
          v-if="$page.props.auth.user",
          :href="route('sites')"
        ) Личный кабинет
        div(v-else)
          Link.text-sm.text-gray-700.underline(:href="route('login')") Авторизоваться
          Link.ml-4.text-sm.text-gray-700.underline(
            v-if="canRegister",
            :href="route('register')"
          ) Зарегистрироваться

main.container.px-12.max-w-6xl
  .mt-2.flex.justify-between.flex-col-reverse.sm_flex-col-reverse.md_flex-row.bg-gray-900.rounded-lg.py-12
    .items-center.flex.ml-12
      .md_mr-4.w-96
        h1.text-4xl.mt-4.text-white Сервис мониторинга работы сайтов
        p.text-bg.text-gray-200.mt-4 В этом сервисе вы сможете настроить проверку на работоспособность страниц сайтов
        Button.mt-4(:to="route('login')", type="primary") Начать пользоваться
</template>

<style scoped>
</style>
