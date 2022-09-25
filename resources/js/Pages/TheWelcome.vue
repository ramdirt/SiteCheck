<script setup>
import AppHeader from "@/Components/AppHeader.vue";
</script>

<template lang="pug">
Head(title="СайтЧек")

AppHeader

main.container.px-12.max-w-6xl
  .flex.flex-col.justify-center.gap-8.mt-8.md__mt-20
    h1.text-4xl.font-bold.text-gray-900.sm__text-4xl.md__text-5xl.text-center Сервис мониторинга работы сайтов
    p.inline-block.text-xl.text-gray-500.text-center В сервисе SiteCheck вы сможете настроить получение отчетов о доступности вашего сайта на почту или в телеграмм
    .flex.justify-center
      Button.w-96(:href="route('login')", type="primary", size="large") Попробывать
  .justify-center
    img.mt-8(src="/images/sites.png")
</template>