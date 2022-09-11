<template lang='pug'>
Head(title="Сайты")

BreezeAuthenticatedLayout
  .container.mt-4.lg__flex.gap-4.justify-between.max-w-6xl
    section.w-full.sx__max-w-lg.lg__max-w-2xl.lg__w-96.flex.flex-col.gap-4.mb-4
      SitesUserBalance
      SitesForm
      SitesRunOverseer

    section.w-full.sx__max-w-lg.lg__max-w-3xl
      SitesTable
</template>

<script setup>
import SitesTable from "../Components/sites/SitesTable.vue";
import SitesForm from "../Components/sites/SitesForm.vue";
import SitesRunOverseer from "../Components/sites/SitesRunOverseer.vue";
import SitesUserBalance from "../Components/sites/SitesUserBalance.vue";
</script>
