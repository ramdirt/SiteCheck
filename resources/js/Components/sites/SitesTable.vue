<template lang='pug'>
Card.relative.mb-4.rounded-xl
  h3.mb-4.text-lg.font-semibold Добавленные сайты
  Table(:columns="table.columns", :data="table.data")
</template>

<script setup>
import sitesTableMixin from "../../Mixins/sites/sitesTableMixin";

const table = sitesTableMixin();
</script>