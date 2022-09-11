<template lang="pug">
Card.relative.rounded-xl
  h3.mb-2.text-lg.font-semibold Баланс
  h1.text-2xl {{ wallet }} рублей
  p.mt-2 Стоимость проверки 1 сайта: {{ prices[0].price }} рублей
  p.mt-2 Баланса хватит на {{ getNumberOfChecksDependingOnTheWallet }} проверок
  p.mt-2 Баланса хватит на: ~{{ remainingDays }} дней
  p.mt-2 {{ numberOfChecksPerDayToInterval }} проверок будет еще за сегодня
</template>

<script setup>
import GlobalMixin from "../../Mixins/GlobalMixin";

const { user, props_page } = GlobalMixin();

const wallet = props_page.auth.user.wallet;
const prices = props_page.price;
const userInterval = user.interval;

const getNumberOfChecksDependingOnTheWallet = Math.ceil(
  wallet / prices[0].price
);

const now = new Date();
const remainingTime = (24 - now.getHours()) * 60 + (60 - now.getMinutes());

const numberOfChecksPerDayToInterval = Math.ceil(remainingTime / userInterval);

const remainingDays = Math.ceil(
  getNumberOfChecksDependingOnTheWallet / (1440 / userInterval)
);
</script>