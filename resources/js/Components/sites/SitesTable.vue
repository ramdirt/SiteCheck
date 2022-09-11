<template lang='pug'>
Card.relative.rounded-xl
  h3.mb-4.text-lg.font-semibold Ваши сайты
  Table(
    border,
    :columns="table.columns",
    :data="table.data",
    @on-row-click="handleContextMenu"
  )

  p.mt-2 Нажмите на строчку в таблице чтобы получить подробную информацию
  SitesModal(:data-modal="dataModal")
</template>

<script setup>
import SitesModal from "./SitesModal.vue";
import sitesTableMixin from "../../Mixins/sites/sitesTableMixin";
import { ref } from "vue";

const table = sitesTableMixin();

const dataModal = ref({
  open: null,
  id: null,
  title: null,
  status: null,
  url: null,
  last_check: null,
});

const handleContextMenu = (row) => {
  dataModal.value.open = true;
  dataModal.value.title = `Сайт: ${row.name}`;
  dataModal.value.url = row.url;
  dataModal.value.id = row.id;
  dataModal.value.status = row.status === 1 ? "Доступен" : "Не доступен";
  dataModal.value.last_check = `Последняя проверка: ${row.last_check}`;
};
</script>