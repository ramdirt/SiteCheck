<template lang="pug">
Head(title="Оплата")

BreezeAuthenticatedLayout
  .container.mt-4
    Card.relative.mb-4.rounded-xl(class="w-[25rem]")
      h3.mb-2.text-xl.font-semibold PRO
      List(border, size="small")
        ListItem Нет ограничения на количество сайтов
        ListItem Интервал проверок до 5 минут
        ListItem Все доступные виды проверок
      .flex.justify-end.mt-4.flex-col
        h2.mb-4.text-lg Стоимость: 99 рублей в месяц
        Button(type="success") Оплатить
</template>

<script setup>
import { computed } from "vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";

const user = usePage().props.value.auth.user;
</script>