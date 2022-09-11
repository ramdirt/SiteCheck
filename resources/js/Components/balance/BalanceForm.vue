<template lang='pug'>
Card.sc__card
  h3.sc__title Пополнение баланса
  Form(ref="MakePayment", :model="form", :rules="rules")
    FormItem(label="Сумма платежа")
      Input(placeholder="Введите сумму", v-model="form.payment")
    .flex.justify-end
      Button(type="primary", @click="submit") Пополнить
</template>

<script setup>
import balanceFormMixin from "@/Mixins/balance/balanceFormMixin";
const { form, rules, submit } = balanceFormMixin();
</script>

<style>
</style>