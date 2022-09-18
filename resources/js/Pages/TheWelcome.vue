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
      Link(:to="route('sites.index')")
        img(src="/images/sitecheck.svg", alt="SiteCheck")
    .flex.gap-8.py-6.justify-end
      div(v-if="canLogin", class="sm:block")
        Link.text-sm.text-gray-700.underline(
          v-if="$page.props.auth.user",
          :href="route('sites.index')"
        ) Личный кабинет
        div(v-else)
          Link.text-sm.text-gray-700.underline(:href="route('login')") Авторизоваться
          Link.ml-4.text-sm.text-gray-700.underline(
            v-if="canRegister",
            :href="route('register')"
          ) Зарегистрироваться

main.container.px-12.max-w-6xl
  .relative.overflow-hidden.bg-white
    .pb-80.sm__pt-24.sm__pb-40.lg__pt-40.lg__pb-48
      .relative.mx-auto.max-w-7xl.sm__static.flex.flex-row.flex-nowrap
        .sm__max-w-lg.px-0.md__px-4.flex.flex-col.justify-center
          h1.font.text-4xl.font-bold.tracking0tight.text-gray-900.sm__text-5xl Сервис мониторинга работы сайтов
          p.mt-4.text-xl.text-gray-500 В сервисе SiteCheck вы сможете настроить получение отчетов о доступности вашего сайта
          a.mt-4.inline-block.text-white.rounded-md.border.border-transparent.bg-blue-500.font-bold.py-4.px-10.text-center.hover__text-white.hover__bg-blue-600(
            :href="route('login')"
          ) Начать пользоваться
</template>