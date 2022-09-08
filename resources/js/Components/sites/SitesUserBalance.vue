<template lang="pug">
Card.relative.mb-4.rounded-xl
  h3.mb-2.text-lg.font-semibold Баланс
  h1.text-2xl {{ wallet }} рублей
  p.mt-2 Стоимость проверки 1 сайта: {{ prices[0].price }} рублей
  p.mt-2 Баланса хватит на {{ getNumberOfChecksDependingOnTheWallet }} проверок
  p.mt-2 {{ numberOfChecksPerDayToInterval }} проверок будет еще за сегодня
</template>

<script setup>
import { computed } from "vue";

import { usePage } from "@inertiajs/inertia-vue3";

const getNumberOfChecksDependingOnTheWallet = computed(() => {
  return wallet / prices[0].price;
});

const numberOfChecksPerDayToInterval = computed(() => {
  return Math.ceil(remainingTime / userInterval);
});

const props = usePage().props.value;
const wallet = props.auth.user.wallet;
const prices = props.price;
const user = props.auth.user;
const userInterval = user.interval;

const now = new Date();
const remainingTime = (24 - now.getHours()) * 60 + now.getMinutes();
</script>