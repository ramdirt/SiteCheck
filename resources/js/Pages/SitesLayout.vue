<template lang='pug'>
Head(title="Сайты")

BreezeAuthenticatedLayout
  .container.mt-4.lg__flex.lg__space-x-6
    section
      Card.relative.mb-4.rounded-xl(class="w-[30rem]")
        h3.mb-4.text-lg.font-semibold Добавить сайт

        Form(ref="addForm", :model="form", :rules="rules")
          FormItem(prop="name")
            Input(placeholder="Введите название сайта", v-model="form.name")
          FormItem(prop="url")
            Input(placeholder="https://example.com", v-model="form.url")

          .flex.justify-end
            Button(type="primary", @click="addSite('addForm')") Добавить

    section.w-full
      Card.relative.mb-4.rounded-xl
        h3.mb-4.mx-4.text-lg.font-semibold Добавленные сайты

        Table(:columns="columns", :data="data", :loading="loading")
</template>

<script>
import axios from "axios";
import tableMixin from "./mixins/sitesTable";

export default {
  name: "SitesLayout",
  mixins: [tableMixin],

  data() {
    return {
      loading: false,
      data: [],

      form: {
        name: "",
        url: "",
      },
      rules: {
        name: [{ required: true }],
        url: [{ required: true }],
      },
    };
  },

  created() {
    this.loadSites();
  },

  methods: {
    loadSites() {
      this.loading = true;

      const params = {
        // TODO Pagination, filtering, sorting
      };

      axios
        .get("site", params)
        .then((response) => {
          if (response.status === 200) {
            this.data = response.data.data;
          }
        })
        .finally(() => {
          this.loading = false;
        });
    },

    addSite() {
      const body = this.form;

      axios
        .post("site/update", { body })
        .then(() => {
          this.loadSites();
        })
        .catch(() => {
          this.loading = false;
        });
    },
  },
};
</script>
