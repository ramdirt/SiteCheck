<template lang="pug">
Head(title="Оплата")

BreezeAuthenticatedLayout
  .container.mt-4.flex.justify-center
    .flex.flex-col.md__flex-row.gap-4
      BalanceUser 
      BalanceForm
</template>

<script setup>
import BalanceUser from "@/Components/balance/BalanceUser.vue";
import BalanceForm from "@/Components/balance/BalanceForm.vue";
</script>